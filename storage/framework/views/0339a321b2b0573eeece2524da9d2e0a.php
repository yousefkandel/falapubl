<?php $__env->startSection('title', 'إدارة المترجمين'); ?>
<?php $__env->startSection('page-title', 'إدارة المترجمين'); ?>
<?php $__env->startSection('breadcrumb', 'لوحة التحكم / المترجمين'); ?>

<?php $__env->startSection('content'); ?>


<div class="stats-grid">

    <div class="stat-card" style="--stat-glow: rgba(124,91,168,.35); --stat-icon-bg: rgba(124,91,168,.18); --stat-icon-color: #b79ee8;">
        <div class="stat-top">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 8h10"/>
                    <path d="M5 12h7"/>
                    <path d="M5 16h4"/>
                    <path d="M15 12l3 3 5-5"/>
                </svg>
            </div>
            <span class="stat-trend trend-up">+<?php echo e($total_translators ?? 0); ?></span>
        </div>
        <div class="stat-value"><?php echo e($total_translators ?? 0); ?></div>
        <div class="stat-label">إجمالي المترجمين</div>
    </div>

    <div class="stat-card" style="--stat-glow: rgba(111,191,139,.3); --stat-icon-bg: rgba(111,191,139,.15); --stat-icon-color: #6fbf8b;">
        <div class="stat-top">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    <path d="M9 12l2 2 4-4"/>
                </svg>
            </div>
            <span class="stat-trend trend-up">
                <?php echo e($total_translators > 0 ? round(($active_translators / $total_translators) * 100) : 0); ?>%
            </span>
        </div>
        <div class="stat-value"><?php echo e($active_translators ?? 0); ?></div>
        <div class="stat-label">المترجمين النشطين</div>
    </div>

    <div class="stat-card" style="--stat-glow: rgba(217,112,122,.3); --stat-icon-bg: rgba(217,112,122,.15); --stat-icon-color: #d9707a;">
        <div class="stat-top">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 8h10"/>
                    <path d="M5 12h7"/>
                    <path d="M5 16h4"/>
                    <path d="M15 12l3 3 5-5"/>
                </svg>
            </div>
            <span class="stat-trend trend-flat">-</span>
        </div>
        <div class="stat-value"><?php echo e($inactive_translators ?? 0); ?></div>
        <div class="stat-label">المترجمين غير النشطين</div>
    </div>

    <div class="stat-card" style="--stat-glow: rgba(212,175,90,.3); --stat-icon-bg: rgba(212,175,90,.15); --stat-icon-color: #e8cd8a;">
        <div class="stat-top">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                </svg>
            </div>
            <span class="stat-trend trend-up">
                <?php echo e($total_translators > 0 ? round(($translators_with_books / $total_translators) * 100) : 0); ?>%
            </span>
        </div>
        <div class="stat-value"><?php echo e($translators_with_books ?? 0); ?></div>
        <div class="stat-label">مترجمين لديهم كتب</div>
    </div>

</div>


<div class="panel">
    <div class="panel-header">
        <h3>
            قائمة المترجمين
            <span id="translators-result-count">
                (<?php echo e($translators->total()); ?> مترجم)
            </span>
        </h3>

        <div class="panel-actions">
            <button type="button" id="btn-add-translator" class="btn btn-gold btn-sm">
                إضافة مترجم
            </button>
        </div>
    </div>

    
    <form id="translators-filters-form" class="filters-bar">
        <input type="search" name="search" placeholder="ابحث عن مترجم...">
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
                    <th>الصورة</th>
                    <th>الاسم (AR)</th>
                    <th>الاسم (EN)</th>
                    <th>السيرة الذاتية</th>
                    <th>عدد الكتب</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody id="translators-table-body">
                <?php echo $__env->make('admin.translators._rows', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </tbody>
        </table>
    </div>

    <div id="translators-pagination">
        <?php echo e($translators->links()); ?>

    </div>
</div>


<div class="modal-backdrop" id="translator-modal">
    <div class="modal-box modal-lg">
        <div class="modal-title">
            <span id="translator-modal-title">إضافة مترجم</span>
            <button type="button" data-close-modal>×</button>
        </div>

        <form id="translator-form" enctype="multipart/form-data" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="_method" id="form-method" value="POST">

            <div class="row">
                <div class="col-6">
                    <h5>اللغة العربية</h5>
                    <div class="form-group">
                        <label class="form-label">الاسم</label>
                        <input type="text" name="name_ar" id="name_ar" class="form-control">
                        <span class="error-message" id="error-name_ar"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-label">السيرة الذاتية</label>
                        <textarea name="bio_ar" id="bio_ar" rows="5" class="form-control"></textarea>
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
                        <label class="form-label">Biography</label>
                        <textarea name="bio_en" id="bio_en" rows="5" class="form-control"></textarea>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="form-label">الصورة الشخصية</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        <small class="text-muted">اتركه فارغاً إن لم ترغب في التغيير (في حالة التعديل)</small>
                        <div id="current-image" style="margin-top: 10px;"></div>
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
                <button type="submit" id="submit-translator-btn" class="btn btn-gold">حفظ</button>
            </div>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('js/translators-actions.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\falak_backend\resources\views/admin/translators/index.blade.php ENDPATH**/ ?>