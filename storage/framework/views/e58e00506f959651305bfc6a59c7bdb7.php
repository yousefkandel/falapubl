<?php $__env->startSection('title', 'الرئيسية'); ?>
<?php $__env->startSection('page-title'); ?>
    مرحباً، <?php echo e(auth()->user()->name ?? 'مدير المكتبة'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb', 'لوحة التحكم'); ?>

<?php $__env->startSection('content'); ?>

<div class="stats-grid">

    <div class="stat-card" style="--stat-glow: rgba(124,91,168,.35); --stat-icon-bg: rgba(124,91,168,.18); --stat-icon-color: #b79ee8;">
        <div class="stat-top">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 5a2 2 0 012-2h11v18H6a2 2 0 01-2-2V5z"/><path d="M17 3v18"/>
                </svg>
            </div>
        </div>
        <div class="stat-value"><?php echo e($stats['total_books']); ?></div>
        <div class="stat-label">إجمالي الكتب</div>
    </div>

    <div class="stat-card" style="--stat-glow: rgba(111,191,139,.3); --stat-icon-bg: rgba(111,191,139,.15); --stat-icon-color: #6fbf8b;">
        <div class="stat-top">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/>
                </svg>
            </div>
        </div>
        <div class="stat-value"><?php echo e($stats['active_books']); ?></div>
        <div class="stat-label">كتب منشورة</div>
    </div>

    <div class="stat-card" style="--stat-glow: rgba(212,175,90,.3); --stat-icon-bg: rgba(212,175,90,.15); --stat-icon-color: #e8cd8a;">
        <div class="stat-top">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 4-6 8-6s8 2 8 6"/>
                </svg>
            </div>
        </div>
        <div class="stat-value"><?php echo e($stats['total_authors']); ?></div>
        <div class="stat-label">المؤلفون</div>
    </div>

    <div class="stat-card" style="--stat-glow: rgba(217,112,122,.3); --stat-icon-bg: rgba(217,112,122,.15); --stat-icon-color: #d9707a;">
        <div class="stat-top">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M8 4l8 4-8 4M8 12l8 4-8 4"/>
                </svg>
            </div>
        </div>
        <div class="stat-value"><?php echo e($stats['total_translators']); ?></div>
        <div class="stat-label">المترجمون</div>
    </div>

    <div class="stat-card" style="--stat-glow: rgba(111,191,139,.3); --stat-icon-bg: rgba(111,191,139,.15); --stat-icon-color: #6fbf8b;">
        <div class="stat-top">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                </svg>
            </div>
        </div>
        <div class="stat-value"><?php echo e($stats['total_users']); ?></div>
        <div class="stat-label">المستخدمون</div>
    </div>

</div>

<div class="row">
    <div class="col-8">
        <div class="panel">
            <div class="panel-header">
                <h3>أحدث الكتب المضافة</h3>
                <div class="panel-actions">
                    <a href="<?php echo e(route('admin.books.index')); ?>" class="btn btn-ghost btn-sm">عرض الكل</a>
                </div>
            </div>
            <div class="table-wrap">
                <table class="falak-table">
                    <thead>
                        <tr>
                            <th>العنوان</th>
                            <th>المؤلف</th>
                            <th>سنة النشر</th>
                            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $recentBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><strong><?php echo e($book->title_ar); ?></strong></td>
                                <td><?php echo e($book->author->name_ar ?? '—'); ?></td>
                                <td><?php echo e($book->publication_year ?? '—'); ?></td>
                                <td>
                                    <?php if($book->status): ?>
                                        <span class="badge badge-success">منشور</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger">غير منشور</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="4" class="text-center">لا توجد كتب بعد</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-4">
        <div class="panel">
            <div class="panel-header">
                <h3>أحدث المستخدمين</h3>
                <div class="panel-actions">
                    <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-ghost btn-sm">عرض الكل</a>
                </div>
            </div>
            <div style="padding: 8px 20px 20px;">
                <?php $__empty_1 = true; $__currentLoopData = $latestUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="sidebar-user" style="padding: 10px 0; border-bottom: 1px solid rgba(201,160,99,.12);">
                        <div class="avatar"><?php echo e(mb_substr($user->name, 0, 1)); ?></div>
                        <div>
                            <div class="name"><?php echo e($user->name); ?></div>
                            <div class="role"><?php echo e($user->email); ?></div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-muted">لا يوجد مستخدمون بعد</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\falakpubl\resources\views/admin/dashboard/index.blade.php ENDPATH**/ ?>