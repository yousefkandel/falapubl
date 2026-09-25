<footer class="fk-footer">
    <svg class="fk-foot-orbits" viewBox="0 0 1200 500" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
        <ellipse cx="1040" cy="90" rx="150" ry="70" />
        <ellipse cx="1040" cy="90" rx="150" ry="70" transform="rotate(55 1040 90)" />
        <ellipse cx="1040" cy="90" rx="150" ry="70" transform="rotate(-55 1040 90)" />
    </svg>

    <div class="fk-foot-inner">
        <div class="fk-foot-top">
            <div class="fk-foot-brand">
                <div class="fk-foot-logo">
                    <svg viewBox="0 0 40 40" width="26" height="26" aria-hidden="true">
                        <circle cx="20" cy="20" r="7" fill="var(--gold-light)" />
                        <ellipse cx="20" cy="20" rx="17" ry="8" fill="none" stroke="var(--gold-light)" stroke-width="1.2" />
                        <ellipse cx="20" cy="20" rx="17" ry="8" fill="none" stroke="var(--gold-light)" stroke-width="1.2" transform="rotate(60 20 20)" />
                        <ellipse cx="20" cy="20" rx="17" ry="8" fill="none" stroke="var(--gold-light)" stroke-width="1.2" transform="rotate(120 20 20)" />
                    </svg>
                    <span>فلك</span>
                </div>
                <p class="fk-foot-tagline">
                    دار نشر تُصدر وتترجم الكتب بين العربية والإنجليزية — كل كتاب هنا كون صغير، وكل قارئ يستحق خريطة واضحة فيه.
                </p>
                <div class="fk-foot-social">
                    <a href="#" aria-label="Instagram" class="fk-social-btn">
                        <svg viewBox="0 0 24 24" width="17" height="17" fill="none"><rect x="3.5" y="3.5" width="17" height="17" rx="5" stroke="currentColor" stroke-width="1.5" /><circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="1.5" /><circle cx="17.2" cy="6.8" r="1" fill="currentColor" /></svg>
                    </a>
                    <a href="#" aria-label="X" class="fk-social-btn">
                        <svg viewBox="0 0 24 24" width="15" height="15" fill="none"><path d="M4 4l16 16M20 4L4 20" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" /></svg>
                    </a>
                    <a href="#" aria-label="Goodreads" class="fk-social-btn">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none"><path d="M6 3h9.5A2.5 2.5 0 0 1 18 5.5v15L12 18l-6 2.5v-15A2.5 2.5 0 0 1 6 3z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" /></svg>
                    </a>
                </div>
            </div>

            <div class="fk-foot-col">
                <h4 class="fk-foot-heading">عن الدار</h4>
                <ul class="fk-foot-links">
                    <li><a href="<?php echo e(route('site.about')); ?>">من نحن</a></li>
                    <li><a href="<?php echo e(route('site.about')); ?>">قصة فلك</a></li>
                    <li><a href="<?php echo e(route('site.contact')); ?>">تواصل معنا</a></li>
                </ul>
            </div>

            <div class="fk-foot-col">
                <h4 class="fk-foot-heading">استكشف</h4>
                <ul class="fk-foot-links">
                    <li><a href="<?php echo e(route('site.books')); ?>">كل الكتب</a></li>
                    <li><a href="<?php echo e(route('site.authors')); ?>">المؤلفون</a></li>
                    <li><a href="<?php echo e(route('site.translators')); ?>">المترجمون</a></li>
                </ul>
            </div>

            <div class="fk-foot-col">
                <h4 class="fk-foot-heading">تواصل معنا</h4>
                <ul class="fk-foot-contact">
                    <li>
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none"><path d="M3 6h18v12H3z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" /><path d="M3 7l9 6 9-6" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" /></svg>
                        <a href="mailto:hello@falak-books.com">hello@falak-books.com</a>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none"><path d="M6 3h3l2 5-2.5 1.5a11 11 0 0 0 5 5L15 12l5 2v3a2 2 0 0 1-2 2C10.5 19 5 13.5 5 6a2 2 0 0 1 1-3z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" /></svg>
                        <a href="tel:+971000000000" dir="ltr">+971 00 000 0000</a>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none"><path d="M12 22s7-7.2 7-12.5A7 7 0 0 0 5 9.5C5 14.8 12 22 12 22z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" /><circle cx="12" cy="9.5" r="2.3" stroke="currentColor" stroke-width="1.5" /></svg>
                        <span>دبي، الإمارات العربية المتحدة</span>
                    </li>
                </ul>


            </div>
        </div>

        <div class="fk-foot-divider"></div>

        <div class="fk-foot-bottom">
            <span>© <?php echo e(date('Y')); ?> دار فلك للنشر — جميع الحقوق محفوظة</span>
            <div class="fk-foot-legal">
                <a href="#">سياسة الخصوصية</a>
                <a href="#">الشروط والأحكام</a>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH D:\falak\falak_backend\resources\views/site/partials/footer.blade.php ENDPATH**/ ?>