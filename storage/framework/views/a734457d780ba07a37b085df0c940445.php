<?php $__env->startSection('title', 'إدارة الكتب'); ?>
<?php $__env->startSection('page-title', 'إدارة الكتب'); ?>
<?php $__env->startSection('breadcrumb', 'لوحة التحكم / الكتب'); ?>

<?php $__env->startSection('content'); ?>


<div class="stats-grid">

    
    <div class="stat-card" style="--stat-glow: rgba(124,91,168,.35); --stat-icon-bg: rgba(124,91,168,.18); --stat-icon-color: #b79ee8;">
        <div class="stat-top">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                </svg>
            </div>
            <span class="stat-trend trend-up">+<?php echo e($total_books ?? 0); ?></span>
        </div>
        <div class="stat-value"><?php echo e($total_books ?? 0); ?></div>
        <div class="stat-label">إجمالي الكتب</div>
    </div>

    
    <div class="stat-card" style="--stat-glow: rgba(212,175,90,.3); --stat-icon-bg: rgba(212,175,90,.15); --stat-icon-color: #e8cd8a;">
        <div class="stat-top">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
            </div>
            <span class="stat-trend trend-up">+<?php echo e($total_authors ?? 0); ?></span>
        </div>
        <div class="stat-value"><?php echo e($total_authors ?? 0); ?></div>
        <div class="stat-label">إجمالي المؤلفين</div>
    </div>

    
    <div class="stat-card" style="--stat-glow: rgba(122,184,217,.3); --stat-icon-bg: rgba(122,184,217,.15); --stat-icon-color: #7ab8d9;">
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
                <?php echo e($total_books > 0 ? round(($active_books / $total_books) * 100) : 0); ?>%
            </span>
        </div>
        <div class="stat-value"><?php echo e($active_books ?? 0); ?></div>
        <div class="stat-label">الكتب النشطة</div>
    </div>

</div>


<div class="panel">
    <div class="panel-header">
        <h3>
            كل الكتب
            <span id="books-result-count">
                (<?php echo e($books->total()); ?> كتاب)
            </span>
        </h3>

        <div class="panel-actions">
            <button type="button"
                    id="btn-add-book"
                    class="btn btn-gold btn-sm">
                إضافة كتاب
            </button>
        </div>
    </div>

    
    <form id="books-filters-form" class="filters-bar">
        <input type="search"
               name="search"
               placeholder="ابحث عن كتاب...">

        <select name="status">
            <option value="">كل الحالات</option>
            <option value="1">مفعل</option>
            <option value="0">غير مفعل</option>
        </select>

        <button type="reset"
                class="btn btn-ghost btn-sm">
            إعادة تعيين
        </button>
    </form>

    
    <div class="table-wrap">
        <table class="falak-table">
            <thead>
                <tr>
                    <th>الغلاف (AR)</th>
                    <th>الغلاف (EN)</th>
                    <th>العنوان (AR)</th>
                    <th>العنوان (EN)</th>
                    <th>المؤلف</th>
                    <th>سنة النشر</th>
                    <th>الحالة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody id="books-table-body">
                <?php echo $__env->make('admin.books._rows', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </tbody>
        </table>
    </div>

    <div id="books-pagination">
        <?php echo e($books->links()); ?>

    </div>
</div>


<div class="modal-backdrop" id="book-modal">
    <div class="modal-box modal-lg">
        <div class="modal-title">
            <span id="book-modal-title">إضافة كتاب</span>
            <button type="button" data-close-modal>×</button>
        </div>

        <form id="book-form" enctype="multipart/form-data" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="_method" id="form-method" value="POST">

            <div class="row">
                <div class="col-6">
                    <h5>اللغة العربية</h5>
                    <div class="form-group">
                        <label class="form-label">العنوان</label>
                        <input type="text" name="title_ar" id="title_ar" class="form-control">
                        <span class="error-message" id="error-title_ar"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-label">التصنيف</label>
                        <input type="text" name="category_ar" id="category_ar" class="form-control">
                        <span class="error-message" id="error-category_ar"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-label">الوصف</label>
                        <textarea name="description_ar" id="description_ar" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">الغلاف</label>
                        <input type="file" name="image_ar" id="image_ar" class="form-control">
                        <small class="text-muted">اتركه فارغاً إن لم ترغب في التغيير (في حالة التعديل)</small>
                        <div id="current-image-ar" style="margin-top: 10px;"></div>
                    </div>
                </div>

                <div class="col-6">
                    <h5>English</h5>
                    <div class="form-group">
                        <label class="form-label">Title</label>
                        <input type="text" name="title_en" id="title_en" class="form-control">
                        <span class="error-message" id="error-title_en"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Category</label>
                        <input type="text" name="category_en" id="category_en" class="form-control">
                        <span class="error-message" id="error-category_en"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="description_en" id="description_en" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Cover</label>
                        <input type="file" name="image_en" id="image_en" class="form-control">
                        <small class="text-muted">Leave empty if you don't want to change (in edit mode)</small>
                        <div id="current-image-en" style="margin-top: 10px;"></div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="form-label">المؤلف</label>
                        <select name="author_id" id="author_id" class="form-control">
                            <?php $__currentLoopData = $authors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $author): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($author->id); ?>"><?php echo e($author->name_ar); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <span class="error-message" id="error-author_id"></span>
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <label class="form-label">المترجم</label>
                        <select name="translator_id" id="translator_id" class="form-control">
                            <option value="">بدون</option>
                            <?php $__currentLoopData = $translators; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $translator): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($translator->id); ?>"><?php echo e($translator->name_ar); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <span class="error-message" id="error-translator_id"></span>
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <label class="form-label">سنة النشر</label>
                        <input type="number" name="publication_year" id="publication_year" class="form-control">
                        <span class="error-message" id="error-publication_year"></span>
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <label class="form-label">عدد الصفحات</label>
                        <input type="number" name="pages_count" id="pages_count" class="form-control">
                        <span class="error-message" id="error-pages_count"></span>
                    </div>
                </div>

                <div class="col-4">
                    <div class="form-group">
                        <label class="form-label">الحالة</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">مفعل</option>
                            <option value="0">غير مفعل</option>
                        </select>
                        <span class="error-message" id="error-status"></span>
                    </div>
                </div>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn btn-ghost" data-close-modal>إلغاء</button>
                <button type="submit" id="submit-book-btn" class="btn btn-gold">حفظ</button>
            </div>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('js/table-actions.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\falakpubl\resources\views/admin/books/index.blade.php ENDPATH**/ ?>