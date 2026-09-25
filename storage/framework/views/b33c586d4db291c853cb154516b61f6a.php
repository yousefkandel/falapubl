<tr data-id="<?php echo e($book->id); ?>">

    <td>
        <img
            src="<?php echo e($book->image_ar ? asset('storage/' . $book->image_ar) : asset('images/no-image.png')); ?>"
            alt="<?php echo e($book->title_ar); ?>"
            width="60"
            height="80"
            style="object-fit:cover;border-radius:6px;">
    </td>
    <td>
        <img
            src="<?php echo e($book->image_en ? asset('storage/' . $book->image_en) : asset('images/no-image.png')); ?>"
            alt="<?php echo e($book->title_en); ?>"
            width="60"
            height="80"
            style="object-fit:cover;border-radius:6px;">
    </td>
    <td>
        <strong><?php echo e($book->title_ar); ?></strong>

        <?php if($book->title_en): ?>
            <br>
            <strong class="text-muted">
                <?php echo e($book->title_en); ?>

            </strong>
        <?php endif; ?>
    </td>

    <td>
        <?php echo e($book->category_ar); ?>


        <?php if($book->category_en): ?>
            <br>
            <small class="text-muted">
                <?php echo e($book->category_en); ?>

            </small>
        <?php endif; ?>
    </td>

    <td>

        <?php echo e($book->author?->name_ar); ?>

        <?php if($book->author?->name_ar): ?>
            <br>
            <small class="text-muted">
                <?php echo e($book->author->name_en); ?>

            </small>
        <?php endif; ?>
    </td>

    <td>

        <?php echo e($book->publication_year); ?>


        <br>

        <small class="text-muted">

            <?php echo e($book->pages_count); ?> صفحة

        </small>

    </td>

    <td>

        <?php if($book->status): ?>

            <span class="badge badge-success">

                مفعل

            </span>

        <?php else: ?>

            <span class="badge badge-danger">

                غير مفعل

            </span>

        <?php endif; ?>

    </td>

    <td>

        <div class="row-actions">

            <button
                class="icon-btn btn-edit"
                data-id="<?php echo e($book->id); ?>"
                data-title-ar="<?php echo e($book->title_ar); ?>"
                data-title-en="<?php echo e($book->title_en); ?>"
                data-category-ar="<?php echo e($book->category_ar); ?>"
                data-category-en="<?php echo e($book->category_en); ?>"
                data-author-id="<?php echo e($book->author_id); ?>"
                data-translator-id="<?php echo e($book->translator_id); ?>"
                data-publication-year="<?php echo e($book->publication_year); ?>"
                data-pages-count="<?php echo e($book->pages_count); ?>"
                data-description-ar="<?php echo e($book->description_ar); ?>"
                data-description-en="<?php echo e($book->description_en); ?>"
                data-status="<?php echo e($book->status); ?>"
                data-image-ar="<?php echo e($book->image_ar); ?>"
                data-image-en="<?php echo e($book->image_en); ?>">
                ✏️
            </button>

            <button
                class="icon-btn danger btn-delete"
                data-id="<?php echo e($book->id); ?>"
                data-title="<?php echo e($book->title_ar); ?>">
                🗑️
            </button>

        </div>

    </td>

</tr>
<?php /**PATH D:\falak_backend\resources\views/admin/books/_row.blade.php ENDPATH**/ ?>