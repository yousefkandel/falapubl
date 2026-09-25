<?php $__env->startSection('title', 'رسالة من ' . $message->name); ?>
<?php $__env->startSection('page-title', 'تفاصيل الرسالة'); ?>
<?php $__env->startSection('breadcrumb', 'لوحة التحكم / رسائل التواصل / ' . $message->name); ?>

<?php $__env->startSection('content'); ?>

<div class="panel">
    <div class="panel-header">
        <h3>الرسالة</h3>
        <div class="panel-actions">
            <a href="<?php echo e(route('admin.contact-messages.index')); ?>" class="btn btn-ghost btn-sm">رجوع للقائمة</a>
        </div>
    </div>

    <div style="padding: 28px;">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label class="form-label">الاسم</label>
                    <div class="form-control" style="background:rgba(255,255,255,.03);"><?php echo e($message->name); ?></div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="form-label">البريد الإلكتروني</label>
                    <div class="form-control" style="background:rgba(255,255,255,.03);" dir="ltr">
                        <a href="mailto:<?php echo e($message->email); ?>" style="color:inherit;"><?php echo e($message->email); ?></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">الموضوع</label>
            <div class="form-control" style="background:rgba(255,255,255,.03);"><?php echo e($message->subject ?: '— بدون موضوع —'); ?></div>
        </div>

        <div class="form-group">
            <label class="form-label">نص الرسالة</label>
            <div class="form-control" style="background:rgba(255,255,255,.03); min-height:160px; white-space:pre-wrap; line-height:1.8;"><?php echo e($message->message); ?></div>
        </div>

        <div class="form-group">
            <label class="form-label">تاريخ الإرسال</label>
            <div class="form-control" style="background:rgba(255,255,255,.03);"><?php echo e($message->created_at->format('Y-m-d H:i')); ?></div>
        </div>

        <div class="modal-actions" style="justify-content:flex-start;">
            <a href="mailto:<?php echo e($message->email); ?>" class="btn btn-gold">الرد عبر البريد</a>
            <form method="POST" action="<?php echo e(route('admin.contact-messages.destroy', $message)); ?>" onsubmit="return confirm('هل أنت متأكد من حذف هذه الرسالة؟');">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-ghost" style="color:#d9707a;">حذف الرسالة</button>
            </form>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\falak_backend\resources\views/admin/contact-messages/show.blade.php ENDPATH**/ ?>