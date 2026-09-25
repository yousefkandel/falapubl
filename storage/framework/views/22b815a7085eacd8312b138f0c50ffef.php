<?php $__env->startSection('title', 'إدارة المستخدمين'); ?>
<?php $__env->startSection('page-title', 'إدارة المستخدمين'); ?>
<?php $__env->startSection('breadcrumb', 'لوحة التحكم / المستخدمون'); ?>

<?php $__env->startSection('content'); ?>


<div class="stats-grid">

    <div class="stat-card" style="--stat-glow: rgba(124,91,168,.35); --stat-icon-bg: rgba(124,91,168,.18); --stat-icon-color: #b79ee8;">
        <div class="stat-top">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                </svg>
            </div>
            <span class="stat-trend trend-up">+<?php echo e($total_users ?? 0); ?></span>
        </div>
        <div class="stat-value"><?php echo e($total_users ?? 0); ?></div>
        <div class="stat-label">إجمالي المستخدمين</div>
    </div>

    <div class="stat-card" style="--stat-glow: rgba(111,191,139,.3); --stat-icon-bg: rgba(111,191,139,.15); --stat-icon-color: #6fbf8b;">
        <div class="stat-top">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/>
                </svg>
            </div>
            <span class="stat-trend trend-up">
                <?php echo e($total_users > 0 ? round(($active_users / $total_users) * 100) : 0); ?>%
            </span>
        </div>
        <div class="stat-value"><?php echo e($active_users ?? 0); ?></div>
        <div class="stat-label">مستخدمون نشطون</div>
    </div>

    <div class="stat-card" style="--stat-glow: rgba(217,112,122,.3); --stat-icon-bg: rgba(217,112,122,.15); --stat-icon-color: #d9707a;">
        <div class="stat-top">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><path d="M15 9l-6 6M9 9l6 6"/>
                </svg>
            </div>
            <span class="stat-trend trend-flat">-</span>
        </div>
        <div class="stat-value"><?php echo e($inactive_users ?? 0); ?></div>
        <div class="stat-label">مستخدمون غير نشطين</div>
    </div>

</div>


<div class="panel">
    <div class="panel-header">
        <h3>
            قائمة المستخدمين
            <span id="users-result-count">
                (<?php echo e($users->total()); ?> مستخدم)
            </span>
        </h3>

        <div class="panel-actions">
            <button type="button" id="btn-add-user" class="btn btn-gold btn-sm">
                إضافة مستخدم
            </button>
        </div>
    </div>

    
    <form id="users-filters-form" class="filters-bar">
        <input type="search" name="search" placeholder="ابحث بالاسم أو البريد...">
        <select name="status">
            <option value="">كل الحالات</option>
            <option value="1">نشط</option>
            <option value="0">غير نشط</option>
        </select>
        <button type="reset" class="btn btn-ghost btn-sm">إعادة تعيين</button>
    </form>

    
    <div class="table-wrap">
        <table class="falak-table">
            <thead>
                <tr>
                    <th></th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>تاريخ الإنشاء</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody id="users-table-body">
                <?php echo $__env->make('admin.users._rows', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </tbody>
        </table>
    </div>

    <div id="users-pagination">
        <?php echo e($users->links()); ?>

    </div>
</div>


<div class="modal-backdrop" id="user-modal">
    <div class="modal-box">
        <div class="modal-title">
            <span id="user-modal-title">إضافة مستخدم</span>
            <button type="button" data-close-modal>×</button>
        </div>

        <form id="user-form" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="_method" id="form-method" value="POST">

            <div class="form-group">
                <label class="form-label">الاسم</label>
                <input type="text" name="name" id="name" class="form-control">
                <span class="error-message" id="error-name"></span>
            </div>

            <div class="form-group">
                <label class="form-label">البريد الإلكتروني</label>
                <input type="email" name="email" id="email" class="form-control" dir="ltr">
                <span class="error-message" id="error-email"></span>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="form-label">كلمة المرور</label>
                        <input type="password" name="password" id="password" class="form-control" dir="ltr">
                        <small class="text-muted">اتركها فارغة إن لم ترغب في تغييرها (عند التعديل)</small>
                        <span class="error-message" id="error-password"></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="form-label">تأكيد كلمة المرور</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" dir="ltr">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">الحالة</label>
                <select name="status" id="status" class="form-control">
                    <option value="1">نشط</option>
                    <option value="0">غير نشط</option>
                </select>
                <span class="error-message" id="error-status"></span>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn btn-ghost" data-close-modal>إلغاء</button>
                <button type="submit" id="submit-user-btn" class="btn btn-gold">حفظ</button>
            </div>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('js/users-actions.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\falak\falak_backend\resources\views/admin/users/index.blade.php ENDPATH**/ ?>