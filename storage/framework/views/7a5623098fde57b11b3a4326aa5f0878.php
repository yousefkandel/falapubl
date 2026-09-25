<tr data-id="<?php echo e($author->id); ?>">
    <td>
        <img src="<?php echo e($author->avatar); ?>"
             alt="<?php echo e($author->name_ar); ?>"
             width="50" height="50"
             style="object-fit:cover;border-radius:50%;border:2px solid var(--falak-border);">
    </td>
    <td>
        <strong><?php echo e($author->name_ar); ?></strong>
    </td>
    <td>
        <?php echo e($author->name_en); ?>

    </td>
    <td>
        <?php echo e(Str::limit($author->bio_ar, 50)); ?>

        <?php if($author->bio_en): ?>
            <br><small class="text-muted"><?php echo e(Str::limit($author->bio_en, 50)); ?></small>
        <?php endif; ?>
    </td>
    <td>
        <span class="badge badge-info"><?php echo e($author->books_count ?? $author->books->count()); ?></span>
    </td>
    <td>
        <?php if($author->status): ?>
            <span class="badge badge-success">نشط</span>
        <?php else: ?>
            <span class="badge badge-danger">غير نشط</span>
        <?php endif; ?>
    </td>
    <td>
        <div class="row-actions">
            <button class="icon-btn btn-edit"
                    data-id="<?php echo e($author->id); ?>"
                    data-name-ar="<?php echo e($author->name_ar); ?>"
                    data-name-en="<?php echo e($author->name_en); ?>"
                    data-bio-ar="<?php echo e($author->bio_ar); ?>"
                    data-bio-en="<?php echo e($author->bio_en); ?>"
                    data-image="<?php echo e($author->image); ?>"
                    data-status="<?php echo e($author->status); ?>">
                ✏️
            </button>
            <button class="icon-btn danger btn-delete"
                    data-id="<?php echo e($author->id); ?>"
                    data-name="<?php echo e($author->name_ar); ?>">
                🗑️
            </button>
        </div>
    </td>
</tr>
<?php /**PATH D:\falak\falak_backend\resources\views/admin/authors/_row.blade.php ENDPATH**/ ?>