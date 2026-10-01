```blade
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    
    <title><?php echo $__env->yieldContent('title', 'فَلَك للنشر والترجمة | كتب وترجمات'); ?></title>

    <meta
        name="description"
        content="<?php echo $__env->yieldContent('meta_description', 'فَلَك للنشر والترجمة — نشر وترجمة الكتب بين العربية والإنجليزية، واكتشاف إصدارات وكتب مميزة لكل قارئ.'); ?>"
    >

    <meta name="robots" content="<?php echo $__env->yieldContent('meta_robots', 'index, follow'); ?>">

    <meta name="author" content="فَلَك للنشر والترجمة">

    
    <link rel="canonical" href="<?php echo e(url()->current()); ?>">

    
    <link
        rel="icon"
        href="<?php echo e(asset('images/site/logo.svg')); ?>"
        type="image/svg+xml"
    >

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    
    <link
        rel="stylesheet"
        href="<?php echo e(asset('css/site.css')); ?>"
    >

    
    <meta property="og:type" content="<?php echo $__env->yieldContent('og_type', 'website'); ?>">
    <meta property="og:title" content="<?php echo $__env->yieldContent('og_title', 'فَلَك للنشر والترجمة'); ?>">

    <meta
        property="og:description"
        content="<?php echo $__env->yieldContent('og_description', 'فَلَك للنشر والترجمة — كتب وإصدارات وترجمات بين العربية والإنجليزية.'); ?>"
    >

    <meta property="og:url" content="<?php echo e(url()->current()); ?>">

    <meta
        property="og:image"
        content="<?php echo $__env->yieldContent('og_image', asset('images/site/logo.svg')); ?>"
    >

    <meta property="og:locale" content="ar_AR">
    <meta property="og:site_name" content="فَلَك للنشر والترجمة">

    
    <meta name="twitter:card" content="summary_large_image">

    <meta
        name="twitter:title"
        content="<?php echo $__env->yieldContent('twitter_title', 'فَلَك للنشر والترجمة'); ?>"
    >

    <meta
        name="twitter:description"
        content="<?php echo $__env->yieldContent('twitter_description', 'فَلَك للنشر والترجمة — كتب وإصدارات وترجمات بين العربية والإنجليزية.'); ?>"
    >

    <meta
        name="twitter:image"
        content="<?php echo $__env->yieldContent('twitter_image', asset('images/site/logo.svg')); ?>"
    >

    
    <?php
        $organizationSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            '@id' => url('/') . '#organization',
            'name' => 'فَلَك للنشر والترجمة',
            'alternateName' => 'فلك',
            'url' => url('/'),
            'logo' => asset('images/site/logo.svg'),
            'description' => 'فَلَك للنشر والترجمة — دار نشر وترجمة بين العربية والإنجليزية.',
        ];
    ?>

    <script type="application/ld+json">
        <?php echo json_encode($organizationSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>

    </script>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="cosmic-canvas">

    
    <?php echo $__env->make('site.partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo $__env->yieldContent('content'); ?>

    
    <?php echo $__env->make('site.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    
    <?php echo $__env->yieldPushContent('scripts'); ?>

</body>
</html>
```
<?php /**PATH D:\falakpubl\resources\views/site/layout.blade.php ENDPATH**/ ?>