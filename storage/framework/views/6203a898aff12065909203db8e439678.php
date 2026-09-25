<?php $__empty_1 = true; $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php echo $__env->make('admin.authors._row', ['author' => $author], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <tr>
        <td colspan="7" class="text-center">لا توجد مؤلفين</td>
    </tr>
<?php endif; ?>
<?php /**PATH D:\falak_backend\resources\views/admin/authors/_rows.blade.php ENDPATH**/ ?>