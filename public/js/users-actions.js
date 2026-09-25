/**
 * فَلَك — إدارة جدول المستخدمين عبر AJAX
 */

document.addEventListener('DOMContentLoaded', () => {

    const tableBody    = document.getElementById('users-table-body');
    const resultCount  = document.getElementById('users-result-count');
    const paginationEl = document.getElementById('users-pagination');
    const filtersForm  = document.getElementById('users-filters-form');
    const userForm     = document.getElementById('user-form');

    if (!tableBody) return;

    /* ============================================================
       1) حذف مستخدم
       ============================================================ */
    tableBody.addEventListener('click', async (e) => {
        const btn = e.target.closest('.btn-delete');
        if (!btn) return;

        const userId = btn.dataset.id;
        const row  = btn.closest('tr');
        const name = btn.dataset.name;

        const confirmed = await Falak.confirm(`هل أنت متأكد من حذف "${name}"؟ لا يمكن التراجع عن هذا الإجراء.`, { title: 'حذف المستخدم' });
        if (!confirmed) return;

        btn.disabled = true;

        try {
            const response = await fetch(`/admin/users/${userId}`, {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                }
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || 'حدث خطأ أثناء الحذف');
            }

            row.classList.add('row-removing');
            setTimeout(() => {
                row.remove();
                updateStats();
                if (resultCount) {
                    const currentCount = parseInt(resultCount.textContent.match(/\d+/)?.[0] || 0);
                    resultCount.textContent = `(${currentCount - 1} مستخدم)`;
                }
            }, 300);

            Falak.toast('تم حذف المستخدم بنجاح.', 'success');
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
            const response = await fetch(`/admin/users/filter?${params.toString()}`, {
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
            if (resultCount) resultCount.textContent = `(${data.count} مستخدم)`;
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
        const link = e.target.closest('#users-pagination a');
        if (!link) return;
        e.preventDefault();
        const page = new URL(link.href).searchParams.get('page') || 1;
        runFilter(page);
    });

    /* ============================================================
       3) إضافة / تعديل
       ============================================================ */
    if (userForm) {

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

        function resetForm() {
            userForm.reset();
            clearErrors();
            userForm.dataset.mode = 'create';
            userForm.dataset.userId = '';
            document.getElementById('form-method').value = 'POST';
            document.getElementById('user-modal-title').textContent = 'إضافة مستخدم';
            document.getElementById('submit-user-btn').textContent = 'حفظ';
            document.getElementById('password').required = true;
            userForm.action = '/admin/users';
        }

        document.getElementById('btn-add-user')?.addEventListener('click', () => {
            resetForm();
            Falak.openModal('user-modal');
        });

        tableBody.addEventListener('click', (e) => {
            const btn = e.target.closest('.btn-edit');
            if (!btn) return;

            resetForm();

            const userId = btn.dataset.id;
            userForm.dataset.mode = 'edit';
            userForm.dataset.userId = userId;
            document.getElementById('form-method').value = 'PUT';
            document.getElementById('user-modal-title').textContent = 'تعديل مستخدم';
            document.getElementById('submit-user-btn').textContent = 'تحديث';
            document.getElementById('password').required = false;
            userForm.action = `/admin/users/${userId}`;

            document.getElementById('name').value = btn.dataset.name || '';
            document.getElementById('email').value = btn.dataset.email || '';
            document.getElementById('status').value = btn.dataset.status || '1';

            Falak.openModal('user-modal');
        });

        userForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const submitBtn = document.getElementById('submit-user-btn');
            const isEdit = userForm.dataset.mode === 'edit';

            submitBtn.disabled = true;
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'جاري الحفظ...';

            const formData = new FormData(userForm);
            if (isEdit) {
                formData.append('_method', 'PUT');
            }

            try {
                const response = await fetch(userForm.action, {
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
                    const oldRow = document.querySelector(`tr[data-id="${userForm.dataset.userId}"]`);
                    if (oldRow) {
                        oldRow.outerHTML = data.row_html;
                    }
                    Falak.toast('تم تحديث المستخدم بنجاح.', 'success');
                } else {
                    tableBody.insertAdjacentHTML('afterbegin', data.row_html);
                    if (resultCount) {
                        const currentCount = parseInt(resultCount.textContent.match(/\d+/)?.[0] || 0);
                        resultCount.textContent = `(${currentCount + 1} مستخدم)`;
                    }
                    Falak.toast('تمت إضافة المستخدم بنجاح.', 'success');
                }

                await updateStats();
                Falak.closeModal('user-modal');
                resetForm();

            } catch (err) {
                Falak.toast(err.message, 'danger');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            }
        });

        document.querySelectorAll('[data-close-modal]').forEach(btn => {
            btn.addEventListener('click', () => {
                Falak.closeModal('user-modal');
                resetForm();
            });
        });

        document.getElementById('user-modal')?.addEventListener('click', (e) => {
            if (e.target === e.currentTarget) {
                Falak.closeModal('user-modal');
                resetForm();
            }
        });
    }

    /* ============================================================
       4) تحديث الإحصائيات
       ============================================================ */
    async function updateStats() {
        try {
            const response = await fetch('/admin/users/stats', {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            });

            if (!response.ok) throw new Error('حدث خطأ أثناء تحديث الإحصائيات');

            const data = await response.json();

            const cards = document.querySelectorAll('.stat-value');
            if (cards.length >= 3) {
                cards[0].textContent = data.total_users;
                cards[1].textContent = data.active_users;
                cards[2].textContent = data.inactive_users;
            }
        } catch (err) {
            console.error('Error updating stats:', err);
        }
    }

});
