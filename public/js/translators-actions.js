/**
 * فَلَك — إدارة جدول المترجمين عبر AJAX
 */

document.addEventListener('DOMContentLoaded', () => {

    const tableBody   = document.getElementById('translators-table-body');
    const resultCount = document.getElementById('translators-result-count');
    const paginationEl= document.getElementById('translators-pagination');
    const filtersForm = document.getElementById('translators-filters-form');
    const translatorForm = document.getElementById('translator-form');

    if (!tableBody) return;

    /* ============================================================
       1) حذف مترجم
       ============================================================ */
    tableBody.addEventListener('click', async (e) => {
        const btn = e.target.closest('.btn-delete');
        if (!btn) return;

        const translatorId = btn.dataset.id;
        const row    = btn.closest('tr');
        const name   = btn.dataset.name;

        const confirmed = await Falak.confirm(`هل أنت متأكد من حذف "${name}"؟ لا يمكن التراجع عن هذا الإجراء.`, { title: 'حذف المترجم' });
        if (!confirmed) return;

        btn.disabled = true;

        try {
            const response = await fetch(`/admin/translators/${translatorId}`, {
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
                    resultCount.textContent = `(${currentCount - 1} مترجم)`;
                }
            }, 300);

            Falak.toast('تم حذف المترجم بنجاح.', 'success');
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
            const response = await fetch(`/admin/translators/filter?${params.toString()}`, {
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
            if (resultCount) resultCount.textContent = `(${data.count} مترجم)`;
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
        const link = e.target.closest('#translators-pagination a');
        if (!link) return;
        e.preventDefault();
        const page = new URL(link.href).searchParams.get('page') || 1;
        runFilter(page);
    });

    /* ============================================================
       3) إضافة / تعديل
       ============================================================ */
    if (translatorForm) {

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
            translatorForm.reset();
            clearErrors();
            clearImagePreview();
            translatorForm.dataset.mode = 'create';
            translatorForm.dataset.translatorId = '';
            document.getElementById('form-method').value = 'POST';
            document.getElementById('translator-modal-title').textContent = 'إضافة مترجم';
            document.getElementById('submit-translator-btn').textContent = 'حفظ';
            translatorForm.action = '/admin/translators';
        }

        // فتح المودال إضافة
        document.getElementById('btn-add-translator')?.addEventListener('click', () => {
            resetForm();
            Falak.openModal('translator-modal');
        });

        // فتح المودال تعديل
        tableBody.addEventListener('click', (e) => {
            const btn = e.target.closest('.btn-edit');
            if (!btn) return;

            resetForm();

            const translatorId = btn.dataset.id;
            translatorForm.dataset.mode = 'edit';
            translatorForm.dataset.translatorId = translatorId;
            document.getElementById('form-method').value = 'PUT';
            document.getElementById('translator-modal-title').textContent = 'تعديل مترجم';
            document.getElementById('submit-translator-btn').textContent = 'تحديث';
            translatorForm.action = `/admin/translators/${translatorId}`;

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

            Falak.openModal('translator-modal');
        });

        // إرسال الفورم
        translatorForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const submitBtn = document.getElementById('submit-translator-btn');
            const isEdit = translatorForm.dataset.mode === 'edit';

            submitBtn.disabled = true;
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'جاري الحفظ...';

            const formData = new FormData(translatorForm);
            if (isEdit) {
                formData.append('_method', 'PUT');
            }

            try {
                const response = await fetch(translatorForm.action, {
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
                    const oldRow = document.querySelector(`tr[data-id="${translatorForm.dataset.translatorId}"]`);
                    if (oldRow) {
                        oldRow.outerHTML = data.row_html;
                    }
                    Falak.toast('تم تحديث المترجم بنجاح.', 'success');
                } else {
                    tableBody.insertAdjacentHTML('afterbegin', data.row_html);
                    if (resultCount) {
                        const currentCount = parseInt(resultCount.textContent.match(/\d+/)?.[0] || 0);
                        resultCount.textContent = `(${currentCount + 1} مترجم)`;
                    }
                    Falak.toast('تم إضافة المترجم بنجاح.', 'success');
                }

                await updateStats();
                Falak.closeModal('translator-modal');
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
                Falak.closeModal('translator-modal');
                resetForm();
            });
        });

        document.getElementById('translator-modal')?.addEventListener('click', (e) => {
            if (e.target === e.currentTarget) {
                Falak.closeModal('translator-modal');
                resetForm();
            }
        });

    }

    /* ============================================================
       4) تحديث الإحصائيات
       ============================================================ */
    async function updateStats() {
        try {
            const response = await fetch('/admin/translators/stats', {
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
                cards[0].textContent = data.total_translators;
                cards[1].textContent = data.active_translators;
                cards[2].textContent = data.inactive_translators;
                cards[3].textContent = data.translators_with_books;
            }

            // تحديث النسب المئوية
            const trends = document.querySelectorAll('.stat-trend');
            if (trends.length >= 4 && data.total_translators > 0) {
                const activePercentage = Math.round((data.active_translators / data.total_translators) * 100);
                const booksPercentage = Math.round((data.translators_with_books / data.total_translators) * 100);
                trends[0].textContent = `+${data.total_translators}`;
                trends[1].textContent = `${activePercentage}%`;
                trends[2].textContent = '-';
                trends[3].textContent = `${booksPercentage}%`;
            }

        } catch (err) {
            console.error('Error updating stats:', err);
        }
    }

});
