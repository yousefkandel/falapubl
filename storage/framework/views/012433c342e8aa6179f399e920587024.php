<?php $__env->startSection('title', ($page->title_ar ?? 'تواصل معنا') . ' — فَلَك للنشر'); ?>

<?php $__env->startSection('content'); ?>

<section class="hero-cosmic" style="min-height: 240px;">
    <div class="hero-glow g1"></div>
    <div class="hero-glow g2"></div>

    <?php echo $__env->make('site.partials.orbit-field', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="hero-mist">
        <div class="m m1"></div>
        <div class="m m2"></div>
        <div class="m m3"></div>
    </div>

    <div class="hero-content">
        <h1 style="font-size: clamp(26px,4vw,40px);"><?php echo e($page->title_ar ?? 'تواصل معنا'); ?></h1>
        <?php if($page && $page->content_ar): ?>
            <p><?php echo e($page->content_ar); ?></p>
        <?php endif; ?>
    </div>
</section>

<section class="fk-page-content">
    <div class="fk-contact-grid">

        <div class="fk-contact-info">
            <h3>بيانات التواصل</h3>
            <ul>
                <?php if($page && $page->email): ?>
                <li>
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><path d="M22 6l-10 7L2 6"/></svg>
                    <a href="mailto:<?php echo e($page->email); ?>"><?php echo e($page->email); ?></a>
                </li>
                <?php endif; ?>
                <?php if($page && $page->phone): ?>
                <li>
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.13.96.36 1.9.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0122 16.92z"/></svg>
                    <a href="tel:<?php echo e(preg_replace('/\s+/', '', $page->phone)); ?>" dir="ltr"><?php echo e($page->phone); ?></a>
                </li>
                <?php endif; ?>
                <?php if($page && $page->address_ar): ?>
                <li>
                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 22s7-7.2 7-12.5A7 7 0 005 9.5C5 14.8 12 22 12 22z"/><circle cx="12" cy="9.5" r="2.3"/></svg>
                    <span><?php echo e($page->address_ar); ?></span>
                </li>
                <?php endif; ?>
            </ul>
        </div>

        <div class="fk-contact-form-wrap">
            <?php if(session('success')): ?>
                <div class="fk-alert fk-alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="fk-alert fk-alert-error">
                    <ul style="margin:0;padding-right:18px;">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('site.contact.submit')); ?>" class="fk-contact-form">
                <?php echo csrf_field(); ?>
                <div class="fk-form-row">
                    <label for="name">الاسم</label>
                    <input type="text" id="name" name="name" value="<?php echo e(old('name')); ?>" required>
                </div>
                <div class="fk-form-row">
                    <label for="email">البريد الإلكتروني</label>
                    <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required>
                </div>
                <div class="fk-form-row">
                    <label for="subject">الموضوع (اختياري)</label>
                    <input type="text" id="subject" name="subject" value="<?php echo e(old('subject')); ?>">
                </div>
                <div class="fk-form-row">
                    <label for="message">الرسالة</label>
                    <textarea id="message" name="message" rows="5" required><?php echo e(old('message')); ?></textarea>
                </div>
                <button type="submit" class="btn-primary">إرسال الرسالة</button>
            </form>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\falak_backend\resources\views/site/contact.blade.php ENDPATH**/ ?>