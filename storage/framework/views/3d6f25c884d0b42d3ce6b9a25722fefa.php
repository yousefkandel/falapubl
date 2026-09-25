<?php $__env->startSection('page-title', 'إدارة المحتوى'); ?>
<?php $__env->startSection('breadcrumb', 'لوحة التحكم / إدارة المحتوى'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header" style="margin-bottom:24px;">
    <h3 style="margin:0;color:var(--gold-light,#C9A063);">إدارة صفحات الموقع</h3>
    <p style="margin:6px 0 0;opacity:.7;font-size:14px;">تعديل محتوى «من نحن» و«تواصل معنا» الظاهر في الواجهة العامة.</p>
</div>

<div class="row" style="display:grid;grid-template-columns:1fr 1fr;gap:24px;">

    
    <div class="card" style="background:var(--surface,#2B2240);border:1px solid rgba(201,160,99,.2);border-radius:16px;padding:24px;">
        <h4 style="margin:0 0 16px;color:var(--gold,#C9A063);display:flex;align-items:center;gap:8px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
            من نحن
        </h4>
        <form method="POST" action="<?php echo e(route('admin.content.update', $about)); ?>" id="about-form">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="form-group" style="margin-bottom:14px;">
                <label class="form-label">العنوان (عربي)</label>
                <input type="text" name="title_ar" class="form-control" value="<?php echo e(old('title_ar', $about->title_ar)); ?>" required>
            </div>
            <div class="form-group" style="margin-bottom:14px;">
                <label class="form-label">العنوان (إنجليزي)</label>
                <input type="text" name="title_en" class="form-control" value="<?php echo e(old('title_en', $about->title_en)); ?>">
            </div>
            <div class="form-group" style="margin-bottom:14px;">
                <label class="form-label">المحتوى (عربي)</label>
                <textarea name="content_ar" class="form-control" rows="8"><?php echo e(old('content_ar', $about->content_ar)); ?></textarea>
            </div>
            <div class="form-group" style="margin-bottom:14px;">
                <label class="form-label">المحتوى (إنجليزي)</label>
                <textarea name="content_en" class="form-control" rows="6"><?php echo e(old('content_en', $about->content_en)); ?></textarea>
            </div>
            <div class="form-group" style="margin-bottom:18px;">
                <label class="form-label">الحالة</label>
                <select name="status" class="form-control">
                    <option value="1" <?php echo e($about->status ? 'selected' : ''); ?>>نشط</option>
                    <option value="0" <?php echo e(!$about->status ? 'selected' : ''); ?>>غير نشط</option>
                </select>
            </div>
            <button type="submit" class="btn btn-gold">حفظ من نحن</button>
        </form>
    </div>

    
    <div class="card" style="background:var(--surface,#2B2240);border:1px solid rgba(201,160,99,.2);border-radius:16px;padding:24px;">
        <h4 style="margin:0 0 16px;color:var(--gold,#C9A063);display:flex;align-items:center;gap:8px;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><path d="M22 6l-10 7L2 6"/></svg>
            تواصل معنا
        </h4>
        <form method="POST" action="<?php echo e(route('admin.content.update', $contact)); ?>" id="contact-form">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="form-group" style="margin-bottom:14px;">
                <label class="form-label">العنوان (عربي)</label>
                <input type="text" name="title_ar" class="form-control" value="<?php echo e(old('title_ar', $contact->title_ar)); ?>" required>
            </div>
            <div class="form-group" style="margin-bottom:14px;">
                <label class="form-label">العنوان (إنجليزي)</label>
                <input type="text" name="title_en" class="form-control" value="<?php echo e(old('title_en', $contact->title_en)); ?>">
            </div>
            <div class="form-group" style="margin-bottom:14px;">
                <label class="form-label">نص تعريفي (عربي)</label>
                <textarea name="content_ar" class="form-control" rows="3"><?php echo e(old('content_ar', $contact->content_ar)); ?></textarea>
            </div>
            <div class="form-group" style="margin-bottom:14px;">
                <label class="form-label">نص تعريفي (إنجليزي)</label>
                <textarea name="content_en" class="form-control" rows="3"><?php echo e(old('content_en', $contact->content_en)); ?></textarea>
            </div>
            <div class="form-group" style="margin-bottom:14px;">
                <label class="form-label">البريد الإلكتروني</label>
                <input type="email" name="email" class="form-control" value="<?php echo e(old('email', $contact->email)); ?>">
            </div>
            <div class="form-group" style="margin-bottom:14px;">
                <label class="form-label">الهاتف</label>
                <input type="text" name="phone" class="form-control" value="<?php echo e(old('phone', $contact->phone)); ?>">
            </div>
            <div class="form-group" style="margin-bottom:14px;">
                <label class="form-label">العنوان (عربي)</label>
                <input type="text" name="address_ar" class="form-control" value="<?php echo e(old('address_ar', $contact->address_ar)); ?>">
            </div>
            <div class="form-group" style="margin-bottom:14px;">
                <label class="form-label">العنوان (إنجليزي)</label>
                <input type="text" name="address_en" class="form-control" value="<?php echo e(old('address_en', $contact->address_en)); ?>">
            </div>
            <div class="form-group" style="margin-bottom:18px;">
                <label class="form-label">الحالة</label>
                <select name="status" class="form-control">
                    <option value="1" <?php echo e($contact->status ? 'selected' : ''); ?>>نشط</option>
                    <option value="0" <?php echo e(!$contact->status ? 'selected' : ''); ?>>غير نشط</option>
                </select>
            </div>
            <button type="submit" class="btn btn-gold">حفظ تواصل معنا</button>
        </form>
    </div>
</div>

<style>
@media (max-width: 900px) {
    .row { grid-template-columns: 1fr !important; }
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\falak_backend\resources\views/admin/content/index.blade.php ENDPATH**/ ?>