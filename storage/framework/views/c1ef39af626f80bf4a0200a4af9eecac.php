<?php
    $variants = ['grape', 'orchid'];
    $variant = $variants[$book->id % 2] ?? 'grape';
?>
<article class="fk-card fk-card--<?php echo e($variant); ?>">
    <div class="fk-card-row">

        
        <div class="fk-half fk-half--start" dir="ltr">
            <div class="fk-cover">
                <?php if($book->image_en): ?>
                    <img src="<?php echo e(asset('storage/' . $book->image_en)); ?>" alt="<?php echo e($book->title_en); ?>" class="fk-cover-image">
                <?php else: ?>
                    <div class="fk-cover-inner">
                        <svg class="fk-cover-orbits" viewBox="0 0 200 300" preserveAspectRatio="xMidYMid slice">
                            <ellipse cx="100" cy="150" rx="70" ry="34" />
                            <ellipse cx="100" cy="150" rx="70" ry="34" transform="rotate(55 100 150)" />
                            <ellipse cx="100" cy="150" rx="70" ry="34" transform="rotate(-55 100 150)" />
                        </svg>
                        <span class="fk-cover-title"><?php echo e($book->title_en); ?></span>
                    </div>
                <?php endif; ?>
                <span class="fk-cover-star" aria-hidden="true">
                    <svg viewBox="0 0 24 24" width="14" height="14"><path d="M12 0 L14 10 L24 12 L14 14 L12 24 L10 14 L0 12 L10 10 Z" fill="currentColor" /></svg>
                </span>
            </div>

            <div class="fk-details">
                <span class="fk-eyebrow">ENGLISH EDITION</span>
                <h3 class="fk-title">
                    <a href="<?php echo e(route('site.books.show', $book)); ?>" style="color:inherit;"><?php echo e($book->title_en); ?></a>
                </h3>
                <p class="fk-desc"><?php echo e(Str::limit($book->description_en, 100)); ?></p>

                <div class="fk-meta">
                    <div class="fk-meta-row">
                        <span class="fk-meta-label">Author</span>
                        <span class="fk-meta-value">
                            <?php if($book->author): ?>
                                <a href="<?php echo e(route('site.authors.show', $book->author)); ?>" class="fk-link"><?php echo e($book->author->name_en); ?></a>
                            <?php else: ?>
                                —
                            <?php endif; ?>
                        </span>
                    </div>
                    <?php if($book->translator): ?>
                    <div class="fk-meta-row">
                        <span class="fk-meta-label">Translator</span>
                        <span class="fk-meta-value">
                            <a href="<?php echo e(route('site.translators.show', $book->translator)); ?>" class="fk-link"><?php echo e($book->translator->name_en); ?></a>
                        </span>
                    </div>
                    <?php endif; ?>
                    <div class="fk-meta-row"><span class="fk-meta-label">Category</span><span class="fk-meta-value"><?php echo e($book->category_en); ?></span></div>
                    <div class="fk-meta-row"><span class="fk-meta-label">Pages</span><span class="fk-meta-value"><?php echo e($book->pages_count); ?></span></div>
                </div>
            </div>
        </div>

        <div class="fk-divider" aria-hidden="true"></div>

        
        <div class="fk-half fk-half--end" dir="rtl">
            <div class="fk-cover">
                <?php if($book->image_ar): ?>
                    <img src="<?php echo e(asset('storage/' . $book->image_ar)); ?>" alt="<?php echo e($book->title_ar); ?>" class="fk-cover-image">
                <?php else: ?>
                    <div class="fk-cover-inner">
                        <svg class="fk-cover-orbits" viewBox="0 0 200 300" preserveAspectRatio="xMidYMid slice">
                            <ellipse cx="100" cy="150" rx="70" ry="34" />
                            <ellipse cx="100" cy="150" rx="70" ry="34" transform="rotate(55 100 150)" />
                            <ellipse cx="100" cy="150" rx="70" ry="34" transform="rotate(-55 100 150)" />
                        </svg>
                        <span class="fk-cover-title"><?php echo e($book->title_ar); ?></span>
                    </div>
                <?php endif; ?>
                <span class="fk-cover-star" aria-hidden="true">
                    <svg viewBox="0 0 24 24" width="14" height="14"><path d="M12 0 L14 10 L24 12 L14 14 L12 24 L10 14 L0 12 L10 10 Z" fill="currentColor" /></svg>
                </span>
            </div>

            <div class="fk-details">
                <span class="fk-eyebrow">النسخة العربية</span>
                <h3 class="fk-title">
                    <a href="<?php echo e(route('site.books.show', $book)); ?>" style="color:inherit;"><?php echo e($book->title_ar); ?></a>
                </h3>
                <p class="fk-desc"><?php echo e(Str::limit($book->description_ar, 100)); ?></p>

                <div class="fk-meta">
                    <div class="fk-meta-row">
                        <span class="fk-meta-label">المؤلف</span>
                        <span class="fk-meta-value">
                            <?php if($book->author): ?>
                                <a href="<?php echo e(route('site.authors.show', $book->author)); ?>" class="fk-link"><?php echo e($book->author->name_ar); ?></a>
                            <?php else: ?>
                                —
                            <?php endif; ?>
                        </span>
                    </div>
                    <?php if($book->translator): ?>
                    <div class="fk-meta-row">
                        <span class="fk-meta-label">المترجم</span>
                        <span class="fk-meta-value">
                            <a href="<?php echo e(route('site.translators.show', $book->translator)); ?>" class="fk-link"><?php echo e($book->translator->name_ar); ?></a>
                        </span>
                    </div>
                    <?php endif; ?>
                    <div class="fk-meta-row"><span class="fk-meta-label">القسم</span><span class="fk-meta-value"><?php echo e($book->category_ar); ?></span></div>
                    <div class="fk-meta-row"><span class="fk-meta-label">عدد الصفحات</span><span class="fk-meta-value"><?php echo e($book->pages_count); ?></span></div>
                </div>
            </div>
        </div>

    </div>
</article>
<?php /**PATH D:\falakpubl\resources\views/site/partials/book-card.blade.php ENDPATH**/ ?>