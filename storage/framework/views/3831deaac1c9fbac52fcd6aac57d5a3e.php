<?php $__env->startSection('title', 'فَلَك — نسير في فلك الكتب'); ?>

<?php $__env->startSection('content'); ?>

<section class="hero-cosmic">
    <div class="hero-glow g1"></div>
    <div class="hero-glow g2"></div>

    <?php echo $__env->make('site.partials.orbit-field', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="hero-mist">
        <div class="m m1"></div>
        <div class="m m2"></div>
        <div class="m m3"></div>
    </div>

    <div class="hero-content">
        <h1>نَسِيرُ فِي فَلَكِ الْكُتُبِ، حَيْثُ لَا نِهَايَةَ لِلشَّغَفِ</h1>
        <p>فلك تُصدر وتترجم الكتب بين العربية والإنجليزية — كل كتاب هنا كون صغير، وكل قارئ يستحق خريطة واضحة فيه.</p>
        <div class="hero-ctas">
            <a href="<?php echo e(route('site.books')); ?>" class="btn-primary">تصفّح الكتب</a>
            <a href="<?php echo e(route('site.about')); ?>" class="btn-outline-dark">قصة فلك</a>
        </div>
    </div>
</section>

<section class="fk-books">
    <?php $__empty_1 = true; $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php echo $__env->make('site.partials.book-card', ['book' => $book], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div style="text-align:center; color: rgba(248,245,240,.6); padding: 60px 20px;">
            لا توجد كتب منشورة حالياً — تابعونا قريبًا.
        </div>
    <?php endif; ?>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\falak\falak_backend\resources\views/site/home.blade.php ENDPATH**/ ?>