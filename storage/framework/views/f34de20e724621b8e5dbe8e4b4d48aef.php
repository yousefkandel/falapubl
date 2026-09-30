<?php $__env->startSection('title', $book->title_ar . ' — فَلَك للنشر'); ?>

<?php $__env->startSection('content'); ?>

<section class="fk-books" style="min-height: auto; padding-top: 40px;">
    <?php echo $__env->make('site.partials.book-show', ['book' => $book], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php if($related->isNotEmpty()): ?>
        <div style="max-width:1180px; margin: 40px auto 0;">
            <h2 style="color: var(--gold-light); font-size: 20px; margin-bottom: 20px;">قد يعجبك أيضاً</h2>
        </div>
        <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedBook): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('site.partials.book-show', ['book' => $relatedBook], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\falakpubl\resources\views/site/show.blade.php ENDPATH**/ ?>