<?php $__env->startSection('title', 'المؤلفون — فَلَك للنشر'); ?>

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
        <h1 style="font-size: clamp(26px,4vw,40px);">المؤلفون</h1>
        <p>تعرّف على كُتّاب إصدارات فَلَك وأعمالهم.</p>

        <form method="GET" action="<?php echo e(route('site.authors')); ?>" class="fk-search-form">
            <input type="search" name="search" value="<?php echo e(request('search')); ?>" placeholder="ابحث باسم المؤلف...">
            <button type="submit">
                <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
            </button>
        </form>
    </div>
</section>

<section class="fk-people">
    <?php if(request('search')): ?>
        <div style="max-width:1180px; margin: 0 auto 20px; color: rgba(248,245,240,.75);">
            نتائج البحث عن: «<?php echo e(request('search')); ?>» (<?php echo e($authors->total()); ?> نتيجة)
            <a href="<?php echo e(route('site.authors')); ?>" class="fk-link" style="margin-inline-start:10px;">إلغاء البحث</a>
        </div>
    <?php endif; ?>

    <div class="fk-people-grid">
        <?php $__empty_1 = true; $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(route('site.authors.show', $author)); ?>" class="fk-person-card">
                <div class="fk-person-avatar">
                    <img src="<?php echo e($author->avatar); ?>" alt="<?php echo e($author->name_ar); ?>">
                </div>
                <div class="fk-person-body">
                    <h3 class="fk-person-name"><?php echo e($author->name_ar); ?></h3>
                    <span class="fk-person-name-en"><?php echo e($author->name_en); ?></span>
                    <?php if($author->bio_ar): ?>
                        <p class="fk-person-bio"><?php echo e(Str::limit($author->bio_ar, 90)); ?></p>
                    <?php endif; ?>
                    <span class="fk-person-count"><?php echo e($author->books_count); ?> كتاب</span>
                </div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="fk-empty">لا يوجد مؤلفون حالياً.</div>
        <?php endif; ?>
    </div>

    <div class="fk-pagination">
        <?php echo e($authors->links()); ?>

    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\falak_backend\resources\views/site/authors.blade.php ENDPATH**/ ?>