<tr data-id="<?php echo e($translator->id); ?>">
    <td>
        <?php if($translator->image): ?>
            <img src="<?php echo e(asset('storage/' . $translator->image)); ?>"
                 alt="<?php echo e($translator->name_ar); ?>"
                 width="50" height="50"
                 style="object-fit:cover;border-radius:50%;border:2px solid var(--falak-border);">
        <?php else: ?>
            <div style="width:50px;height:50px;border-radius:50%;background:var(--falak-purple-700);display:flex;align-items:center;justify-content:center;color:var(--falak-gold-light);font-weight:bold;font-size:20px;border:2px solid var(--falak-border);">
                <?php echo e(substr($translator->name_ar, 0, 1)); ?>

            </div>
        <?php endif; ?>
    </td>
    <td>
        <strong><?php echo e($translator->name_ar); ?></strong>
    </td>
    <td>
        <?php echo e($translator->name_en); ?>

    </td>
    <td>
        <?php echo e(Str::limit($translator->bio_ar, 50)); ?>

        <?php if($translator->bio_en): ?>
            <br><small class="text-muted"><?php echo e(Str::limit($translator->bio_en, 50)); ?></small>
        <?php endif; ?>
    </td>
    <td>
        <span class="badge badge-info"><?php echo e($translator->books_count ?? $translator->books->count()); ?></span>
    </td>
    <td>
        <?php if($translator->status): ?>
            <span class="badge badge-success">نشط</span>
        <?php else: ?>
            <span class="badge badge-danger">غير نشط</span>
        <?php endif; ?>
    </td>
    <td>
        <div class="row-actions">
            <button class="icon-btn btn-edit"
                    data-id="<?php echo e($translator->id); ?>"
                    data-name-ar="<?php echo e($translator->name_ar); ?>"
                    data-name-en="<?php echo e($translator->name_en); ?>"
                    data-bio-ar="<?php echo e($translator->bio_ar); ?>"
                    data-bio-en="<?php echo e($translator->bio_en); ?>"
                    data-image="<?php echo e($translator->image); ?>"
                    data-status="<?php echo e($translator->status); ?>">
                ✏️
            </button>
            <button class="icon-btn danger btn-delete"
                    data-id="<?php echo e($translator->id); ?>"
                    data-name="<?php echo e($translator->name_ar); ?>">
                🗑️
            </button>
        </div>
    </td>
</tr>
<?php /**PATH D:\falak\falak_backend\resources\views/admin/translators/_row.blade.php ENDPATH**/ ?>