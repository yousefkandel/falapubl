/**
 * فَلَك — إدارة جدول المؤلفين عبر AJAX
 */

document.addEventListener('DOMContentLoaded', () => {

    const tableBody   = document.getElementById('authors-table-body');
    const resultCount = document.getElementById('authors-result-count');
    const paginationEl= document.getElementById('authors-pagination');
    const filtersForm = document.getElementById('authors-filters-form');
    const authorForm  = document.getElementById('author-form');

    if (!tableBody) return;

    /* ============================================================
       1) حذف مؤلف
       ============================================================ */
    tableBody.addEventListener('click', async (e) => {
        const btn = e.target.closest('.btn-delete');
        if (!btn) return;

        const authorId = btn.dataset.id;
        const row    = btn.closest('tr');
        const name   = btn.dataset.name;

        const confirmed = await Falak.confirm(`هل أنت متأكد من حذف "${name}"؟ لا يمكن التراجع عن هذا الإجراء.`, { title: 'حذف المؤلف' });
        if (!confirmed) return;

        btn.disabled = true;

        try {
            const response = await fetch(`/admin/authors/${authorId}`, {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                }
            });

            if (!response.ok) {
                const data = await response.json();
                throw new Error(data.message || 'حدث خطأ أثناء الحذف');
            }

            row.classList.add('row-removing');
            setTimeout(() => {
                row.remove();
                updateStats();
                if (resultCount) {
                    const currentCount = parseInt(resultCount.textContent.match(/\d+/)?.[0] || 0);
                    resultCount.textContent = `(${currentCount - 1} مؤلف)`;
                }
            }, 300);

            Falak.toast('تم حذف المؤلف بنجاح.', 'success');
        } catch (err) {
            Falak.toast(err.message, 'danger');
            btn.disabled = false;
        }
    });

    /* ============================================================
       2) الفلترة
       ============================================================ */
    let searchDebounce;

    async function runFilter(page = 1) {
        const params = new URLSearchParams(new FormData(filtersForm));
        params.set('page', page);

        try {
            const response = await fetch(`/admin/authors/filter?${params.toString()}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            });

            if (!response.ok) throw new Error('حدث خطأ أثناء جلب البيانات');

            const data = await response.json();
            tableBody.innerHTML = data.rows_html;
            if (paginationEl) paginationEl.innerHTML = data.pagination || '';
            if (resultCount) resultCount.textContent = `(${data.count} مؤلف)`;
        } catch (err) {
            Falak.toast(err.message, 'danger');
        }
    }

    if (filtersForm) {
        filtersForm.addEventListener('change', (e) => {
            if (e.target.matches('select')) runFilter(1);
        });

        filtersForm.addEventListener('input', (e) => {
            if (e.target.matches('input[type="search"]')) {
                clearTimeout(searchDebounce);
                searchDebounce = setTimeout(() => runFilter(1), 400);
            }
        });

        filtersForm.addEventListener('reset', () => {
            setTimeout(() => runFilter(1), 100);
        });
    }

    document.addEventListener('click', (e) => {
        const link = e.target.closest('#authors-pagination a');
        if (!link) return;
        e.preventDefault();
        const page = new URL(link.href).searchParams.get('page') || 1;
        runFilter(page);
    });

    /* ============================================================
       3) إضافة / تعديل
       ============================================================ */
    if (authorForm) {

        function displayErrors(errors) {
            clearErrors();
            for (const [field, messages] of Object.entries(errors)) {
                const errorElement = document.getElementById(`error-${field}`);
                if (errorElement) {
                    errorElement.textContent = messages[0];
                    errorElement.style.color = '#dc3545';
                    errorElement.style.display = 'block';
                    errorElement.style.fontSize = '0.875rem';
                    errorElement.style.marginTop = '0.25rem';

                    const inputElement = document.getElementById(field);
                    if (inputElement) {
                        inputElement.style.borderColor = '#dc3545';
                    }
                }
            }
        }

        function clearErrors() {
            document.querySelectorAll('.error-message').forEach(el => {
                el.textContent = '';
                el.style.display = 'none';
            });
            document.querySelectorAll('.form-control').forEach(el => {
                el.style.borderColor = '';
            });
        }

        function clearImagePreview() {
            const currentImageDiv = document.getElementById('current-image');
            if (currentImageDiv) currentImageDiv.innerHTML = '';
        }

        function resetForm() {
            authorForm.reset();
            clearErrors();
            clearImagePreview();
            authorForm.dataset.mode = 'create';
            authorForm.dataset.authorId = '';
            document.getElementById('form-method').value = 'POST';
            document.getElementById('author-modal-title').textContent = 'إضافة مؤلف';
            document.getElementById('submit-author-btn').textContent = 'حفظ';
            authorForm.action = '/admin/authors';
        }

        // فتح المودال إضافة
        document.getElementById('btn-add-author')?.addEventListener('click', () => {
            resetForm();
            Falak.openModal('author-modal');
        });

        // فتح المودال تعديل
        tableBody.addEventListener('click', (e) => {
            const btn = e.target.closest('.btn-edit');
            if (!btn) return;

            resetForm();

            const authorId = btn.dataset.id;
            authorForm.dataset.mode = 'edit';
            authorForm.dataset.authorId = authorId;
            document.getElementById('form-method').value = 'PUT';
            document.getElementById('author-modal-title').textContent = 'تعديل مؤلف';
            document.getElementById('submit-author-btn').textContent = 'تحديث';
            authorForm.action = `/admin/authors/${authorId}`;

            document.getElementById('name_ar').value = btn.dataset.nameAr || '';
            document.getElementById('name_en').value = btn.dataset.nameEn || '';
            document.getElementById('bio_ar').value = btn.dataset.bioAr || '';
            document.getElementById('bio_en').value = btn.dataset.bioEn || '';
            document.getElementById('status').value = btn.dataset.status || '1';

            // عرض الصورة الحالية
            const image = btn.dataset.image;
            const currentImageDiv = document.getElementById('current-image');
            if (currentImageDiv && image) {
                currentImageDiv.innerHTML = `
                    <img src="/storage/${image}" alt="Current Avatar"
                         width="80" height="80"
                         style="object-fit:cover;border-radius:50%;border:2px solid var(--falak-border);margin-top:5px;">
                    <br><small class="text-muted">الصورة الحالية</small>
                    <input type="hidden" name="current_image" value="${image}">
                `;
            }

            Falak.openModal('author-modal');
        });

        // إرسال الفورم
        authorForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const submitBtn = document.getElementById('submit-author-btn');
            const isEdit = authorForm.dataset.mode === 'edit';

            submitBtn.disabled = true;
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'جاري الحفظ...';

            const formData = new FormData(authorForm);
            if (isEdit) {
                formData.append('_method', 'PUT');
            }

            try {
                const response = await fetch(authorForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                    }
                });

                let data;
                const contentType = response.headers.get('content-type');

                if (contentType && contentType.includes('application/json')) {
                    data = await response.json();
                } else {
                    throw new Error('حدث خطأ في الخادم');
                }

                if (response.status === 422 && data.errors) {
                    displayErrors(data.errors);
                    throw new Error('يرجى تصحيح الأخطاء في النموذج.');
                }

                if (!response.ok) {
                    throw new Error(data.message || 'حدث خطأ ما.');
                }

                if (isEdit) {
                    const oldRow = document.querySelector(`tr[data-id="${authorForm.dataset.authorId}"]`);
                    if (oldRow) {
                        oldRow.outerHTML = data.row_html;
                    }
                    Falak.toast('تم تحديث المؤلف بنجاح.', 'success');
                } else {
                    tableBody.insertAdjacentHTML('afterbegin', data.row_html);
                    if (resultCount) {
                        const currentCount = parseInt(resultCount.textContent.match(/\d+/)?.[0] || 0);
                        resultCount.textContent = `(${currentCount + 1} مؤلف)`;
                    }
                    Falak.toast('تم إضافة المؤلف بنجاح.', 'success');
                }

                await updateStats();
                Falak.closeModal('author-modal');
                resetForm();

            } catch (err) {
                Falak.toast(err.message, 'danger');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            }
        });

        // إغلاق المودال
        document.querySelectorAll('[data-close-modal]').forEach(btn => {
            btn.addEventListener('click', () => {
                Falak.closeModal('author-modal');
                resetForm();
            });
        });

        document.getElementById('author-modal')?.addEventListener('click', (e) => {
            if (e.target === e.currentTarget) {
                Falak.closeModal('author-modal');
                resetForm();
            }
        });

    }

    /* ============================================================
       4) تحديث الإحصائيات
       ============================================================ */
    async function updateStats() {
        try {
            const response = await fetch('/admin/authors/stats', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            });

            if (!response.ok) throw new Error('حدث خطأ أثناء تحديث الإحصائيات');

            const data = await response.json();

            const cards = document.querySelectorAll('.stat-value');
            if (cards.length >= 4) {
                cards[0].textContent = data.total_authors;
                cards[1].textContent = data.active_authors;
                cards[2].textContent = data.inactive_authors;
                cards[3].textContent = data.authors_with_books;
            }

            // تحديث النسب المئوية
            const trends = document.querySelectorAll('.stat-trend');
            if (trends.length >= 4 && data.total_authors > 0) {
                const activePercentage = Math.round((data.active_authors / data.total_authors) * 100);
                const booksPercentage = Math.round((data.authors_with_books / data.total_authors) * 100);
                trends[0].textContent = `+${data.total_authors}`;
                trends[1].textContent = `${activePercentage}%`;
                trends[2].textContent = '-';
                trends[3].textContent = `${booksPercentage}%`;
            }

        } catch (err) {
            console.error('Error updating stats:', err);
        }
    }

});
