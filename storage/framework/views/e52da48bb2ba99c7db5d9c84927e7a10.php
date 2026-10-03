<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    
    <url>
        <loc><?php echo e(url('/')); ?></loc>
    </url>

    
    <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <url>
            <loc><?php echo e(route('site.books.show', $book)); ?></loc>
            <?php if($book->updated_at): ?>
                <lastmod><?php echo e($book->updated_at->toAtomString()); ?></lastmod>
            <?php endif; ?>
        </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    
    <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <url>
            <loc><?php echo e(route('site.authors.show', $author)); ?></loc>
            <?php if($author->updated_at): ?>
                <lastmod><?php echo e($author->updated_at->toAtomString()); ?></lastmod>
            <?php endif; ?>
        </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    
    <?php $__currentLoopData = $translators; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $translator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <url>
            <loc><?php echo e(route('site.translators.show', $translator)); ?></loc>
            <?php if($translator->updated_at): ?>
                <lastmod><?php echo e($translator->updated_at->toAtomString()); ?></lastmod>
            <?php endif; ?>
        </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    
    <url>
        <loc><?php echo e(url('/books')); ?></loc>
    </url>

    <url>
        <loc><?php echo e(url('/authors')); ?></loc>
    </url>

    <url>
        <loc><?php echo e(url('/translators')); ?></loc>
    </url>

    <url>
        <loc><?php echo e(url('/about')); ?></loc>
    </url>

    <url>
        <loc><?php echo e(url('/contact')); ?></loc>
    </url>

</urlset><?php /**PATH D:\falakpubl\resources\views/sitemap.blade.php ENDPATH**/ ?>