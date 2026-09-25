<?php $__env->startSection('title', 'رسائل التواصل'); ?>
<?php $__env->startSection('page-title', 'رسائل التواصل'); ?>
<?php $__env->startSection('breadcrumb', 'لوحة التحكم / رسائل التواصل'); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
    <div class="alert alert-success" style="background:rgba(111,191,139,.15); border:1px solid rgba(111,191,139,.4); color:#6fbf8b; padding:12px 18px; border-radius:10px; margin-bottom:20px;">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<div class="stats-grid">
    <div class="stat-card" style="--stat-glow: rgba(124,91,168,.35); --stat-icon-bg: rgba(124,91,168,.18); --stat-icon-color: #b79ee8;">
        <div class="stat-top">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><path d="M22 6l-10 7L2 6"/></svg>
            </div>
        </div>
        <div class="stat-value"><?php echo e($total_messages); ?></div>
        <div class="stat-label">إجمالي الرسائل</div>
    </div>

    <div class="stat-card" style="--stat-glow: rgba(217,112,122,.3); --stat-icon-bg: rgba(217,112,122,.15); --stat-icon-color: #d9707a;">
        <div class="stat-top">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v5"/><circle cx="12" cy="16" r="0.6" fill="currentColor"/></svg>
            </div>
        </div>
        <div class="stat-value"><?php echo e($unread_messages); ?></div>
        <div class="stat-label">رسائل غير مقروءة</div>
    </div>
</div>

<div class="panel">
    <div class="panel-header">
        <h3>كل الرسائل <span>(<?php echo e($messages->total()); ?> رسالة)</span></h3>
    </div>

    <div class="table-wrap">
        <table class="falak-table">
            <thead>
                <tr>
                    <th></th>
                    <th>الاسم</th>
                    <th>البريد الإلكتروني</th>
                    <th>الموضوع</th>
                    <th>التاريخ</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr style="<?php echo e($message->is_read ? '' : 'font-weight:700;'); ?>">
                        <td>
                            <?php if(!$message->is_read): ?>
                                <span class="badge badge-danger" style="padding:3px 8px;">جديد</span>
                            <?php else: ?>
                                <span class="badge" style="background:rgba(255,255,255,.08); color:rgba(248,245,240,.6);">مقروءة</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo e($message->name); ?></td>
                        <td dir="ltr"><?php echo e($message->email); ?></td>
                        <td><?php echo e($message->subject ?: '—'); ?></td>
                        <td><?php echo e($message->created_at->format('Y-m-d H:i')); ?></td>
                        <td>
                            <div class="row-actions">
                                <a href="<?php echo e(route('admin.contact-messages.show', $message)); ?>" class="icon-btn" title="عرض الرسالة">👁️</a>
                                <form method="POST" action="<?php echo e(route('admin.contact-messages.destroy', $message)); ?>" onsubmit="return confirm('هل أنت متأكد من حذف هذه الرسالة؟');" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="icon-btn danger" title="حذف">🗑️</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="6" class="text-center">لا توجد رسائل بعد</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div><?php echo e($messages->links()); ?></div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\falak_backend\resources\views/admin/contact-messages/index.blade.php ENDPATH**/ ?>