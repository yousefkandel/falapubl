/**
 * فَلَك — سكربت عام للوحة التحكم
 * يحتوي على: نظام Toast، فتح/غلق المودال، إعداد CSRF لكل طلبات fetch
 */

window.Falak = (function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

    /** إظهار رسالة توست بسيطة (نجاح / خطأ) */
    function toast(message, type = 'success', duration = 3200) {
        const el = document.getElementById('toast');
        if (!el) return;
        el.textContent = message;
        el.className = `toast show toast-${type}`;
        clearTimeout(el._timer);
        el._timer = setTimeout(() => el.classList.remove('show'), duration);
    }

    /** فتح مودال بواسطة الـ id */
    function openModal(id) {
        document.getElementById(id)?.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    /** غلق مودال بواسطة الـ id */
    function closeModal(id) {
        document.getElementById(id)?.classList.remove('open');
        document.body.style.overflow = '';
    }

    /** غلاف موحّد فوق fetch يضيف هيدرز الـ AJAX/CSRF تلقائيًا */
    async function request(url, options = {}) {
        const headers = Object.assign(
            {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken,
                Accept: 'application/json',
            },
            options.headers || {}
        );

        const res = await fetch(url, { ...options, headers });
        let data = null;
        try { data = await res.json(); } catch (_) { /* استجابة بدون JSON */ }

        if (!res.ok) {
            const message = data?.message || 'حدث خطأ غير متوقع، حاول مرة أخرى.';
            throw new Error(message);
        }
        return data;
    }

    /* ============================================================
       نافذة تأكيد أنيقة (بديل عن confirm() الافتراضية في المتصفح)
       الاستخدام: const ok = await Falak.confirm('نص السؤال', { danger: true });
       ============================================================ */
    let confirmBox = null;

    function buildConfirmBox() {
        const el = document.createElement('div');
        el.className = 'falak-confirm-backdrop';
        el.id = 'falak-confirm-backdrop';
        el.innerHTML = `
            <div class="falak-confirm-box" role="alertdialog" aria-modal="true">
                <div class="falak-confirm-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 9v4"/>
                        <path d="M12 17h.01"/>
                        <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                    </svg>
                </div>
                <h4 class="falak-confirm-title"></h4>
                <p class="falak-confirm-message"></p>
                <div class="falak-confirm-actions">
                    <button type="button" class="btn btn-ghost" data-confirm-cancel>إلغاء</button>
                    <button type="button" class="btn btn-danger" data-confirm-ok>تأكيد الحذف</button>
                </div>
            </div>
        `;
        document.body.appendChild(el);
        return el;
    }

    function confirmDialog(message, opts = {}) {
        const { title = 'تأكيد الحذف', okText = 'تأكيد الحذف', cancelText = 'إلغاء' } = opts;

        if (!confirmBox) confirmBox = buildConfirmBox();

        confirmBox.querySelector('.falak-confirm-title').textContent = title;
        confirmBox.querySelector('.falak-confirm-message').textContent = message;
        confirmBox.querySelector('[data-confirm-ok]').textContent = okText;
        confirmBox.querySelector('[data-confirm-cancel]').textContent = cancelText;

        confirmBox.classList.add('open');
        document.body.style.overflow = 'hidden';

        const okBtn = confirmBox.querySelector('[data-confirm-ok]');
        const cancelBtn = confirmBox.querySelector('[data-confirm-cancel]');

        return new Promise((resolve) => {
            const cleanup = (result) => {
                confirmBox.classList.remove('open');
                document.body.style.overflow = '';
                okBtn.removeEventListener('click', onOk);
                cancelBtn.removeEventListener('click', onCancel);
                confirmBox.removeEventListener('click', onBackdrop);
                document.removeEventListener('keydown', onKey);
                resolve(result);
            };
            const onOk = () => cleanup(true);
            const onCancel = () => cleanup(false);
            const onBackdrop = (e) => { if (e.target === confirmBox) cleanup(false); };
            const onKey = (e) => {
                if (e.key === 'Escape') cleanup(false);
                if (e.key === 'Enter') cleanup(true);
            };

            okBtn.addEventListener('click', onOk);
            cancelBtn.addEventListener('click', onCancel);
            confirmBox.addEventListener('click', onBackdrop);
            document.addEventListener('keydown', onKey);
            okBtn.focus();
        });
    }

    // غلق أي مودال مفتوح عند الضغط على الخلفية أو زر الإغلاق [data-close-modal]
    document.addEventListener('click', (e) => {
        const backdrop = e.target.closest('.modal-backdrop');
        const closeBtn = e.target.closest('[data-close-modal]');
        if (closeBtn) {
            closeModal(closeBtn.closest('.modal-backdrop').id);
        } else if (backdrop && e.target === backdrop) {
            closeModal(backdrop.id);
        }
    });

    // فتح مودال بواسطة [data-open-modal="modal-id"]
    document.addEventListener('click', (e) => {
        const trigger = e.target.closest('[data-open-modal]');
        if (trigger) openModal(trigger.dataset.openModal);
    });

    /* ============================================================
       القائمة الجانبية (Sidebar) على شاشات الموبايل — فتح/غلق
       ============================================================ */
    function initSidebarToggle() {
        const sidebar = document.getElementById('app-sidebar');
        const toggleBtn = document.getElementById('sidebar-toggle');
        const overlay = document.getElementById('sidebar-overlay');
        if (!sidebar || !toggleBtn || !overlay) return;

        const openSidebar = () => {
            sidebar.classList.add('open');
            overlay.classList.add('open');
            document.body.style.overflow = 'hidden';
        };
        const closeSidebar = () => {
            sidebar.classList.remove('open');
            overlay.classList.remove('open');
            document.body.style.overflow = '';
        };

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
        });
        overlay.addEventListener('click', closeSidebar);

        // غلق القائمة تلقائياً عند اختيار رابط (تنقّل) في وضع الموبايل
        sidebar.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 860) closeSidebar();
            });
        });

        // غلق القائمة عند تغيير حجم الشاشة إلى وضع سطح المكتب
        window.addEventListener('resize', () => {
            if (window.innerWidth > 860) closeSidebar();
        });
    }

    document.addEventListener('DOMContentLoaded', initSidebarToggle);

    return { toast, openModal, closeModal, request, confirm: confirmDialog };
})();
