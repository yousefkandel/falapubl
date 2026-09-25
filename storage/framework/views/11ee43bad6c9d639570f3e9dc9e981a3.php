<?php $__env->startSection('title', $author->name_ar . ' — فَلَك للنشر'); ?>

<?php $__env->startSection('content'); ?>

<section class="hero-cosmic" style="min-height: 280px;">
    <div class="hero-glow g1"></div>
    <div class="hero-glow g2"></div>

    <?php echo $__env->make('site.partials.orbit-field', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="hero-mist">
        <div class="m m1"></div>
        <div class="m m2"></div>
        <div class="m m3"></div>
    </div>

    <div class="hero-content fk-profile-hero">
        <div class="fk-profile-avatar">
            <img src="<?php echo e($author->avatar); ?>" alt="<?php echo e($author->name_ar); ?>">
        </div>
        <div>
            <h1 style="font-size: clamp(24px,3.5vw,36px); margin-bottom: 6px;"><?php echo e($author->name_ar); ?></h1>
            <p style="opacity:.75; margin-bottom: 10px;"><?php echo e($author->name_en); ?></p>
            <?php if($author->bio_ar): ?>
                <p style="max-width:560px; opacity:.9;"><?php echo e($author->bio_ar); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="fk-books">
    <div style="max-width:1180px; margin: 0 auto 16px;">
        <h2 style="color: var(--gold-light); font-size: 20px;">كتب المؤلف</h2>
    </div>

    <?php $__empty_1 = true; $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php echo $__env->make('site.partials.book-card', ['book' => $book], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="fk-empty">لا توجد كتب منشورة لهذا المؤلف حالياً.</div>
    <?php endif; ?>

    <div class="fk-pagination">
        <?php echo e($books->links()); ?>

    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\falak_backend\resources\views/site/author-show.blade.php ENDPATH**/ ?>