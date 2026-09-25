<tr data-id="<?php echo e($category->id); ?>">
    <td><strong><?php echo e($category->name_ar); ?></strong></td>
    <td><?php echo e($category->name_en); ?></td>
    <td><code><?php echo e($category->slug); ?></code></td>
    <td>
        <?php echo e(Str::limit($category->description_ar, 50)); ?>

    </td>
    <td>
        <?php if($category->status): ?>
            <span class="badge badge-success">نشط</span>
        <?php else: ?>
            <span class="badge badge-danger">غير نشط</span>
        <?php endif; ?>
    </td>
    <td>
        <div class="row-actions">
            <button class="icon-btn btn-edit"
                    data-id="<?php echo e($category->id); ?>"
                    data-name-ar="<?php echo e($category->name_ar); ?>"
                    data-name-en="<?php echo e($category->name_en); ?>"
                    data-slug="<?php echo e($category->slug); ?>"
                    data-description-ar="<?php echo e($category->description_ar); ?>"
                    data-description-en="<?php echo e($category->description_en); ?>"
                    data-status="<?php echo e($category->status); ?>">
                ✏️
            </button>
            <button class="icon-btn danger btn-delete"
                    data-id="<?php echo e($category->id); ?>"
                    data-name="<?php echo e($category->name_ar); ?>">
                🗑️
            </button>
        </div>
    </td>
</tr>
<?php /**PATH D:\falak\falak_backend\resources\views/admin/categories/_row.blade.php ENDPATH**/ ?>