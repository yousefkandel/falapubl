<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'فَلَك للنشر والترجمة'); ?></title>
    <meta name="description" content="فلك تُصدر وتترجم الكتب بين العربية والإنجليزية — كل كتاب هنا كون صغير، وكل قارئ يستحق خريطة واضحة فيه.">

    <link rel="icon" href="<?php echo e(asset('images/site/logo.svg')); ?>" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo e(asset('css/site.css')); ?>">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="cosmic-canvas">

    <?php echo $__env->make('site.partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make('site.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\falak\falak_backend\resources\views/site/layout.blade.php ENDPATH**/ ?>