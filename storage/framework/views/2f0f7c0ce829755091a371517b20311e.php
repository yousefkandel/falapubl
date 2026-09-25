<?php $__empty_1 = true; $__currentLoopData = $translators; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $translator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php echo $__env->make('admin.translators._row', ['translator' => $translator], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <tr>
        <td colspan="7" class="text-center">لا توجد مترجمين</td>
    </tr>
<?php endif; ?>
<?php /**PATH D:\falak_backend\resources\views/admin/translators/_rows.blade.php ENDPATH**/ ?>