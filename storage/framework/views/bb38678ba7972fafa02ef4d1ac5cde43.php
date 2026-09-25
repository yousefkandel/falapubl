<?php $__env->startSection('title', 'المترجمون — فَلَك للنشر'); ?>

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
        <h1 style="font-size: clamp(26px,4vw,40px);">المترجمون</h1>
        <p>المترجمون الذين نقلوا أعمال فَلَك بين العربية والإنجليزية.</p>

        <form method="GET" action="<?php echo e(route('site.translators')); ?>" class="fk-search-form">
            <input type="search" name="search" value="<?php echo e(request('search')); ?>" placeholder="ابحث باسم المترجم...">
            <button type="submit">
                <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
            </button>
        </form>
    </div>
</section>

<section class="fk-people">
    <?php if(request('search')): ?>
        <div style="max-width:1180px; margin: 0 auto 20px; color: rgba(248,245,240,.75);">
            نتائج البحث عن: «<?php echo e(request('search')); ?>» (<?php echo e($translators->total()); ?> نتيجة)
            <a href="<?php echo e(route('site.translators')); ?>" class="fk-link" style="margin-inline-start:10px;">إلغاء البحث</a>
        </div>
    <?php endif; ?>

    <div class="fk-people-grid">
        <?php $__empty_1 = true; $__currentLoopData = $translators; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $translator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(route('site.translators.show', $translator)); ?>" class="fk-person-card">
                <div class="fk-person-avatar">
                    <img src="<?php echo e($translator->avatar); ?>" alt="<?php echo e($translator->name_ar); ?>">
                </div>
                <div class="fk-person-body">
                    <h3 class="fk-person-name"><?php echo e($translator->name_ar); ?></h3>
                    <span class="fk-person-name-en"><?php echo e($translator->name_en); ?></span>
                    <?php if($translator->bio_ar): ?>
                        <p class="fk-person-bio"><?php echo e(Str::limit($translator->bio_ar, 90)); ?></p>
                    <?php endif; ?>
                    <span class="fk-person-count"><?php echo e($translator->books_count); ?> ترجمة</span>
                </div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="fk-empty">لا يوجد مترجمون حالياً.</div>
        <?php endif; ?>
    </div>

    <div class="fk-pagination">
        <?php echo e($translators->links()); ?>

    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\falak_backend\resources\views/site/translators.blade.php ENDPATH**/ ?>