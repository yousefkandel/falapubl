<?php $__env->startSection('title', 'الكتب — فَلَك للنشر'); ?>

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

    <div class="hero-content">
        <h1 style="font-size: clamp(26px,4vw,40px);">مكتبة فَلَك</h1>
        <p>تصفّح كل الإصدارات — عربي وإنجليزي جنبًا إلى جنب.</p>

        <form method="GET" action="<?php echo e(route('site.books')); ?>" class="fk-search-form">
            <input type="search" name="search" value="<?php echo e(request('search')); ?>" placeholder="ابحث بعنوان الكتاب...">
            <button type="submit">
                <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
            </button>
        </form>
    </div>
</section>

<section class="fk-books">
    <?php if(request('search')): ?>
        <div style="max-width:1180px; margin: 0 auto 20px; color: rgba(248,245,240,.75);">
            نتائج البحث عن: «<?php echo e(request('search')); ?>» (<?php echo e($books->total()); ?> نتيجة)
            <a href="<?php echo e(route('site.books')); ?>" class="fk-link" style="margin-inline-start:10px;">إلغاء البحث</a>
        </div>
    <?php endif; ?>

    <?php $__empty_1 = true; $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php echo $__env->make('site.partials.book-card', ['book' => $book], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div style="text-align:center; color: rgba(248,245,240,.6); padding: 60px 20px;">
            لا توجد كتب منشورة حالياً.
        </div>
    <?php endif; ?>

    <div style="max-width:1180px; margin: 20px auto 0; color: rgba(248,245,240,.8);">
        <?php echo e($books->links()); ?>

    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\falak_backend\resources\views/site/books.blade.php ENDPATH**/ ?>