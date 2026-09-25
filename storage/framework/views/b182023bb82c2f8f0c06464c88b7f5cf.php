<?php
    // منفذ مطابق لخوارزمية mulberry32 المستخدمة في نسخة React الأصلية
    // بس بنوقف عند نصف قطر خارج حدود الـ viewBox (1200×660) توفيرًا للأداء،
    // لأن أي حلقة أبعد من كده مش هتكون ظاهرة أصلاً.
    function fk_mulberry32(&$seed) {
        $seed = ($seed + 0x6D2B79F5) & 0xFFFFFFFF;
        $t = $seed;
        $t = fk_imul($t ^ ($t >> 15), 1 | $t);
        $t = ($t + fk_imul($t ^ ($t >> 7), 61 | $t)) ^ $t;
        return (($t ^ ($t >> 14)) & 0xFFFFFFFF) / 4294967296;
    }
    function fk_imul($a, $b) {
        return (int)(($a * $b) & 0xFFFFFFFF);
    }

    $centerX = 600; $centerY = 330;
    $maxVisibleRadius = 620; // أبعد نقطة ممكن تظهر داخل الإطار
    $rings = [];
    $r = 90;
    while ($r <= $maxVisibleRadius) { $rings[] = $r; $r += 30; }

    $seed = 42;
    $dots = [];
    foreach ($rings as $ringR) {
        $dotsOnRing = 5 + (int) floor(fk_mulberry32($seed) * 3);
        for ($i = 0; $i < $dotsOnRing; $i++) {
            $angle  = fk_mulberry32($seed) * M_PI * 2;
            $jitter = (fk_mulberry32($seed) - 0.5) * 6;
            $sizeRand = fk_mulberry32($seed);
            $size = $sizeRand < 0.15 ? 4.5 + fk_mulberry32($seed) * 2 : 1.2 + fk_mulberry32($seed) * 2.4;
            $gold = fk_mulberry32($seed) < 0.25;

            $dots[] = [
                'cx' => $centerX + cos($angle) * ($ringR + $jitter),
                'cy' => $centerY + sin($angle) * ($ringR + $jitter),
                'r'  => $size,
                'gold' => $gold,
            ];
        }
    }
?>
<svg class="hero-orbits" viewBox="0 0 1200 660" preserveAspectRatio="xMidYMid slice">
    <?php $__currentLoopData = $rings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ringR): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <circle class="ring" cx="<?php echo e($centerX); ?>" cy="<?php echo e($centerY); ?>" r="<?php echo e($ringR); ?>" />
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php $__currentLoopData = $dots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <circle class="dot <?php echo e($dot['gold'] ? 'gold' : ''); ?>" cx="<?php echo e($dot['cx']); ?>" cy="<?php echo e($dot['cy']); ?>" r="<?php echo e($dot['r']); ?>" />
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</svg>
<?php /**PATH D:\falak_backend\resources\views/site/partials/orbit-field.blade.php ENDPATH**/ ?>