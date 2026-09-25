<tr data-id="<?php echo e($user->id); ?>">
    <td>
        <div class="avatar" style="width:36px;height:36px;font-size:14px;"><?php echo e(mb_substr($user->name, 0, 1)); ?></div>
    </td>
    <td><strong><?php echo e($user->name); ?></strong></td>
    <td dir="ltr"><?php echo e($user->email); ?></td>
    <td><?php echo e($user->created_at->format('Y-m-d')); ?></td>
    <td>
        <?php if($user->status): ?>
            <span class="badge badge-success">نشط</span>
        <?php else: ?>
            <span class="badge badge-danger">غير نشط</span>
        <?php endif; ?>
    </td>
    <td>
        <div class="row-actions">
            <button class="icon-btn btn-edit"
                    data-id="<?php echo e($user->id); ?>"
                    data-name="<?php echo e($user->name); ?>"
                    data-email="<?php echo e($user->email); ?>"
                    data-status="<?php echo e($user->status); ?>">
                ✏️
            </button>
            <?php if($user->id !== auth()->id()): ?>
            <button class="icon-btn danger btn-delete"
                    data-id="<?php echo e($user->id); ?>"
                    data-name="<?php echo e($user->name); ?>">
                🗑️
            </button>
            <?php endif; ?>
        </div>
    </td>
</tr>
<?php /**PATH D:\falak_backend\resources\views/admin/users/_row.blade.php ENDPATH**/ ?>