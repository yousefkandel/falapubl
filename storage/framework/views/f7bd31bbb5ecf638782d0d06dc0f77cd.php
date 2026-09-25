<?php $__env->startSection('title', 'إدارة التصنيفات'); ?>
<?php $__env->startSection('page-title', 'إدارة التصنيفات'); ?>
<?php $__env->startSection('breadcrumb', 'لوحة التحكم / الأقسام'); ?>

<?php $__env->startSection('content'); ?>


<div class="stats-grid">

    <div class="stat-card" style="--stat-glow: rgba(124,91,168,.35); --stat-icon-bg: rgba(124,91,168,.18); --stat-icon-color: #b79ee8;">
        <div class="stat-top">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="4" rx="1"/><rect x="3" y="11" width="18" height="4" rx="1"/><rect x="3" y="18" width="18" height="2" rx="1"/>
                </svg>
            </div>
            <span class="stat-trend trend-up">+<?php echo e($total_categories ?? 0); ?></span>
        </div>
        <div class="stat-value"><?php echo e($total_categories ?? 0); ?></div>
        <div class="stat-label">إجمالي الأقسام</div>
    </div>

    <div class="stat-card" style="--stat-glow: rgba(111,191,139,.3); --stat-icon-bg: rgba(111,191,139,.15); --stat-icon-color: #6fbf8b;">
        <div class="stat-top">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/>
                </svg>
            </div>
            <span class="stat-trend trend-up">
                <?php echo e($total_categories > 0 ? round(($active_categories / $total_categories) * 100) : 0); ?>%
            </span>
        </div>
        <div class="stat-value"><?php echo e($active_categories ?? 0); ?></div>
        <div class="stat-label">أقسام نشطة</div>
    </div>

    <div class="stat-card" style="--stat-glow: rgba(217,112,122,.3); --stat-icon-bg: rgba(217,112,122,.15); --stat-icon-color: #d9707a;">
        <div class="stat-top">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><path d="M15 9l-6 6M9 9l6 6"/>
                </svg>
            </div>
            <span class="stat-trend trend-flat">-</span>
        </div>
        <div class="stat-value"><?php echo e($inactive_categories ?? 0); ?></div>
        <div class="stat-label">أقسام غير نشطة</div>
    </div>

</div>


<div class="panel">
    <div class="panel-header">
        <h3>
            قائمة الأقسام
            <span id="categories-result-count">
                (<?php echo e($categories->total()); ?> قسم)
            </span>
        </h3>

        <div class="panel-actions">
            <button type="button" id="btn-add-category" class="btn btn-gold btn-sm">
                إضافة قسم
            </button>
        </div>
    </div>

    
    <form id="categories-filters-form" class="filters-bar">
        <input type="search" name="search" placeholder="ابحث عن قسم...">
        <select name="status">
            <option value="">كل الحالات</option>
            <option value="1">نشط</option>
            <option value="0">غير نشط</option>
        </select>
        <button type="reset" class="btn btn-ghost btn-sm">إعادة تعيين</button>
    </form>

    
    <div class="table-wrap">
        <table class="falak-table">
            <thead>
                <tr>
                    <th>الاسم (AR)</th>
                    <th>الاسم (EN)</th>
                    <th>الرابط المختصر</th>
                    <th>الوصف</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody id="categories-table-body">
                <?php echo $__env->make('admin.categories._rows', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </tbody>
        </table>
    </div>

    <div id="categories-pagination">
        <?php echo e($categories->links()); ?>

    </div>
</div>


<div class="modal-backdrop" id="category-modal">
    <div class="modal-box modal-lg">
        <div class="modal-title">
            <span id="category-modal-title">إضافة قسم</span>
            <button type="button" data-close-modal>×</button>
        </div>

        <form id="category-form" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="_method" id="form-method" value="POST">

            <div class="row">
                <div class="col-6">
                    <h5>اللغة العربية</h5>
                    <div class="form-group">
                        <label class="form-label">اسم القسم</label>
                        <input type="text" name="name_ar" id="name_ar" class="form-control">
                        <span class="error-message" id="error-name_ar"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-label">الوصف</label>
                        <textarea name="description_ar" id="description_ar" rows="4" class="form-control"></textarea>
                    </div>
                </div>

                <div class="col-6">
                    <h5>English</h5>
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input type="text" name="name_en" id="name_en" class="form-control">
                        <span class="error-message" id="error-name_en"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="description_en" id="description_en" rows="4" class="form-control"></textarea>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="form-label">الرابط المختصر (اختياري)</label>
                        <input type="text" name="slug" id="slug" class="form-control" placeholder="سيُنشأ تلقائياً إن تُرك فارغاً" dir="ltr">
                        <span class="error-message" id="error-slug"></span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="form-label">الحالة</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">نشط</option>
                            <option value="0">غير نشط</option>
                        </select>
                        <span class="error-message" id="error-status"></span>
                    </div>
                </div>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn btn-ghost" data-close-modal>إلغاء</button>
                <button type="submit" id="submit-category-btn" class="btn btn-gold">حفظ</button>
            </div>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('js/categories-actions.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\falak\falak_backend\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>