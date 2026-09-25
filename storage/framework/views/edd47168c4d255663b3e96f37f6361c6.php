<?php $__empty_1 = true; $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

    <?php echo $__env->make('admin.books._row',[
        'book'=>$book
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

<tr>

    <td colspan="8" class="text-center">

        لا توجد كتب

    </td>

</tr>

<?php endif; ?>
<?php /**PATH D:\falak\falak_backend\resources\views/admin/books/_rows.blade.php ENDPATH**/ ?>