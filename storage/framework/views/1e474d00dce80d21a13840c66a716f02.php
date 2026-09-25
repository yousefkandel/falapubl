<?php $__env->startSection('title', ($page->title_ar ?? 'من نحن') . ' — فَلَك للنشر'); ?>

<?php $__env->startSection('content'); ?>

<section class="hero-cosmic" style="min-height: 260px;">
    <div class="hero-glow g1"></div>
    <div class="hero-glow g2"></div>

    <?php echo $__env->make('site.partials.orbit-field', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="hero-mist">
        <div class="m m1"></div>
        <div class="m m2"></div>
        <div class="m m3"></div>
    </div>

    <div class="hero-content">
        <h1 style="font-size: clamp(26px,4vw,40px);"><?php echo e($page->title_ar ?? 'من نحن'); ?></h1>
        <?php if(!empty($page->title_en)): ?>
            <p style="opacity:.7;"><?php echo e($page->title_en); ?></p>
        <?php endif; ?>
    </div>
</section>

<section class="fk-page-content">
    <div class="fk-page-inner">
        <?php if($page && $page->content_ar): ?>
            <div class="fk-prose">
                <?php echo nl2br(e($page->content_ar)); ?>

            </div>
        <?php else: ?>
            <p class="fk-empty">المحتوى قيد التحديث.</p>
        <?php endif; ?>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\falak_backend\resources\views/site/about.blade.php ENDPATH**/ ?>