/**
 * فَلَك — إدارة جدول الكتب عبر AJAX
 * الوظائف: حذف صف / فلترة حسب الحالة والقسم والبحث / إضافة وتعديل عبر المودال
 * يعتمد على window.Falak (dashboard.js) للـ toast والـ modal ولطلبات fetch
 */

document.addEventListener('DOMContentLoaded', () => {

    const tableBody   = document.getElementById('books-table-body');
    const resultCount = document.getElementById('books-result-count');
    const paginationEl= document.getElementById('books-pagination');
    const filtersForm = document.getElementById('books-filters-form');
    const bookForm    = document.getElementById('book-form');

    if (!tableBody) return; // مش في صفحة الكتب، اخرج بدون تنفيذ شيء

    /* ============================================================
       1) حذف كتاب عبر AJAX (بدون إعادة تحميل الصفحة)
       ============================================================ */
    tableBody.addEventListener('click', async (e) => {
        const btn = e.target.closest('.btn-delete');
        if (!btn) return;

        const bookId = btn.dataset.id;
        const row    = btn.closest('tr');
        const title  = btn.dataset.title;

        const confirmed = await Falak.confirm(`هل أنت متأكد من حذف "${title}"؟ لا يمكن التراجع عن هذا الإجراء.`, { title: 'حذف الكتاب' });
        if (!confirmed) return;

        btn.disabled = true;

        try {
            await Falak.request(`/admin/books/${bookId}`, { method: 'DELETE' });

            row.classList.add('row-removing');
            setTimeout(() => {
                row.remove();
                // تحديث العداد
                if (resultCount) {
                    const currentCount = parseInt(resultCount.textContent.match(/\d+/)?.[0] || 0);
                    const newCount = currentCount - 1;
                    resultCount.textContent = `(${newCount} كتاب)`;

                    // إذا أصبح الجدول فارغاً
                    if (newCount === 0) {
                        location.reload();
                    }
                }
            }, 220);

            Falak.toast('تم حذف الكتاب بنجاح.', 'success');
        } catch (err) {
            Falak.toast(err.message, 'danger');
            btn.disabled = false;
        }
    });

    /* ============================================================
       2) الفلترة الحيّة: الحالة + القسم + البحث (كلها AJAX)
       ============================================================ */
    let searchDebounce;

    async function runFilter(page = 1) {
        const params = new URLSearchParams(new FormData(filtersForm));
        params.set('page', page);

        try {
            const data = await Falak.request(`/admin/books/filter?${params.toString()}`, { method: 'GET' });
            tableBody.innerHTML = data.rows_html;
            if (paginationEl) paginationEl.innerHTML = data.pagination;
            if (resultCount) resultCount.textContent = `(${data.count} كتاب)`;
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
            setTimeout(() => runFilter(1), 0);
        });
    }

    // دعم التنقل بين صفحات الـ pagination عبر AJAX أيضًا
    document.addEventListener('click', (e) => {
        const link = e.target.closest('#books-pagination a');
        if (!link) return;
        e.preventDefault();
        const page = new URL(link.href).searchParams.get('page') || 1;
        runFilter(page);
    });

    /* ============================================================
       3) إضافة / تعديل كتاب عبر المودال (نفس الفورم لكلا الحالتين)
       ============================================================ */
    if (bookForm) {

        // ====== دوال مساعدة ======
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
                }
            }
        }

        function clearErrors() {
            document.querySelectorAll('.error-message').forEach(el => {
                el.textContent = '';
                el.style.display = 'none';
            });
        }

        function clearImagePreviews() {
            const currentImageArDiv = document.getElementById('current-image-ar');
            const currentImageEnDiv = document.getElementById('current-image-en');
            if (currentImageArDiv) currentImageArDiv.innerHTML = '';
            if (currentImageEnDiv) currentImageEnDiv.innerHTML = '';
        }

        function resetForm() {
            bookForm.reset();
            clearErrors();
            clearImagePreviews();
            bookForm.dataset.mode = 'create';
            bookForm.dataset.bookId = '';
            document.getElementById('form-method').value = 'POST';
        }

        // ====== فتح المودال في وضع "إضافة" ======
        document.getElementById('btn-add-book')?.addEventListener('click', () => {
            resetForm();
            document.getElementById('book-modal-title').textContent = 'إضافة كتاب جديد';
            document.getElementById('submit-book-btn').textContent = 'حفظ';
            // تعيين action للإضافة
            bookForm.action = '/admin/books';
            Falak.openModal('book-modal');
        });

        // ====== فتح المودال في وضع "تعديل" ======
        tableBody.addEventListener('click', (e) => {
            const btn = e.target.closest('.btn-edit');
            if (!btn) return;

            // تنظيف الفورم
            resetForm();

            // تعبئة البيانات
            const bookId = btn.dataset.id;

            // تعيين وضع التعديل
            bookForm.dataset.mode = 'edit';
            bookForm.dataset.bookId = bookId;
            document.getElementById('form-method').value = 'PUT';
            document.getElementById('book-modal-title').textContent = 'تعديل كتاب';
            document.getElementById('submit-book-btn').textContent = 'تحديث';
            // تعيين action للتعديل
            bookForm.action = `/admin/books/${bookId}`;

            // تعبئة الحقول النصية
            const fields = {
                'title_ar': 'titleAr',
                'title_en': 'titleEn',
                'category_ar': 'categoryAr',
                'category_en': 'categoryEn',
                'description_ar': 'descriptionAr',
                'description_en': 'descriptionEn',
                'publication_year': 'publicationYear',
                'pages_count': 'pagesCount',
                'english_publication_year': 'englishPublicationYear',
                'english_pages': 'englishPages',
                'status': 'status'
            };

            for (const [elementId, datasetKey] of Object.entries(fields)) {
                const element = document.getElementById(elementId);
                if (element) {
                    element.value = btn.dataset[datasetKey] || '';
                }
            }

            // تعبئة الـ selects
            const authorSelect = document.getElementById('author_id');
            if (authorSelect) {
                authorSelect.value = btn.dataset.authorId || '';
            }

            const translatorSelect = document.getElementById('translator_id');
            if (translatorSelect) {
                translatorSelect.value = btn.dataset.translatorId || '';
            }

            // عرض الصور الحالية
            const imageAr = btn.dataset.imageAr;
            const imageEn = btn.dataset.imageEn;

            const currentImageArDiv = document.getElementById('current-image-ar');
            const currentImageEnDiv = document.getElementById('current-image-en');

            if (currentImageArDiv) {
                if (imageAr) {
                    currentImageArDiv.innerHTML = `
                        <img src="/storage/${imageAr}" alt="Current Arabic Cover" width="80" height="100" style="object-fit:cover;border-radius:6px;border:1px solid #ddd;padding:5px;margin-top:5px;">
                        <br><small class="text-muted">الغلاف الحالي</small>
                        <input type="hidden" name="current_image_ar" value="${imageAr}">
                    `;
                } else {
                    currentImageArDiv.innerHTML = '';
                }
            }

            if (currentImageEnDiv) {
                if (imageEn) {
                    currentImageEnDiv.innerHTML = `
                        <img src="/storage/${imageEn}" alt="Current English Cover" width="80" height="100" style="object-fit:cover;border-radius:6px;border:1px solid #ddd;padding:5px;margin-top:5px;">
                        <br><small class="text-muted">Current cover</small>
                        <input type="hidden" name="current_image_en" value="${imageEn}">
                    `;
                } else {
                    currentImageEnDiv.innerHTML = '';
                }
            }

            // فتح المودال
            Falak.openModal('book-modal');
        });

        // ====== إرسال الفورم (مع دعم PUT) ======
        bookForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const submitBtn = document.getElementById('submit-book-btn');
            const isEdit = bookForm.dataset.mode === 'edit';

            // تعطيل الزر وتغيير النص
            submitBtn.disabled = true;
            submitBtn.textContent = 'جاري الحفظ...';

            // إنشاء FormData
            const formData = new FormData(bookForm);

            // إذا كان تعديل، نضيف _method=PUT
            if (isEdit) {
                formData.append('_method', 'PUT');
            }

            try {
                // إرسال الطلب
                const response = await fetch(bookForm.action, {
                    method: 'POST', // دائماً نستخدم POST مع _method
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                });

                // قراءة الـ response
                const contentType = response.headers.get('content-type');
                let data;

                if (contentType && contentType.includes('application/json')) {
                    data = await response.json();
                } else {
                    const text = await response.text();
                    console.error('Server response:', text);
                    throw new Error('حدث خطأ في الخادم. الرجاء المحاولة مرة أخرى.');
                }

                // التعامل مع الأخطاء
                if (!response.ok) {
                    if (response.status === 422 && data.errors) {
                        displayErrors(data.errors);
                        throw new Error('يرجى تصحيح الأخطاء في النموذج.');
                    }
                    throw new Error(data.message || 'حدث خطأ ما.');
                }

                // ====== نجاح العملية ======
                if (isEdit) {
                    // تحديث الصف الموجود
                    const oldRow = document.querySelector(`tr[data-id="${bookForm.dataset.bookId}"]`);
                    if (oldRow) {
                        oldRow.outerHTML = data.row_html;
                    }
                    Falak.toast('تم تحديث الكتاب بنجاح.', 'success');
                } else {
                    // إضافة صف جديد
                    tableBody.insertAdjacentHTML('afterbegin', data.row_html);

                    // تحديث العداد
                    if (resultCount) {
                        const currentCount = parseInt(resultCount.textContent.match(/\d+/)?.[0] || 0);
                        resultCount.textContent = `(${currentCount + 1} كتاب)`;
                    }
                    Falak.toast('تم إضافة الكتاب بنجاح.', 'success');
                }

                // إغلاق المودال وتنظيف الفورم
                Falak.closeModal('book-modal');
                resetForm();

                // إعادة تعيين الـ buttons
                document.getElementById('book-modal-title').textContent = 'إضافة كتاب جديد';
                document.getElementById('submit-book-btn').textContent = 'حفظ';
                bookForm.action = '/admin/books';

            } catch (err) {
                // عرض رسالة الخطأ
                Falak.toast(err.message, 'danger');
            } finally {
                // إعادة تفعيل الزر
                submitBtn.disabled = false;
                submitBtn.textContent = isEdit ? 'تحديث' : 'حفظ';
            }
        });

        // ====== إغلاق المودال عند الضغط على زر الإلغاء ======
        document.querySelectorAll('[data-close-modal]').forEach(btn => {
            btn.addEventListener('click', () => {
                Falak.closeModal('book-modal');
                resetForm();
            });
        });

        // ====== إغلاق المودال عند الضغط على خلفية المودال ======
        document.getElementById('book-modal')?.addEventListener('click', (e) => {
            if (e.target === e.currentTarget) {
                Falak.closeModal('book-modal');
                resetForm();
            }
        });

    } // end if bookForm

}); // end DOMContentLoaded
