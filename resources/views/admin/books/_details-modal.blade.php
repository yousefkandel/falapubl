<div class="modal-backdrop book-details-backdrop" id="book-details-modal" aria-hidden="true">
    <section class="modal-box modal-lg book-details-modal" role="dialog" aria-modal="true" aria-labelledby="book-details-title" tabindex="-1">
        <div class="modal-title">
            <span id="book-details-title">تفاصيل الكتاب</span>
            <button type="button" data-close-book-details aria-label="إغلاق">×</button>
        </div>

        <div class="book-details-mockup" dir="rtl">
            <img
                class="book-details-mockup__background"
                src="{{ asset('images/site/falak-book-mockup-background.jpg') }}"
                alt=""
                aria-hidden="true">
            <img data-book-detail-cover alt="غلاف الكتاب" hidden>
        </div>

        <dl class="book-details-grid" dir="rtl">
            <div><dt>العنوان العربي</dt><dd data-book-detail="titleAr"></dd></div>
            <div><dt>العنوان الإنجليزي</dt><dd data-book-detail="titleEn"></dd></div>
            <div><dt>التصنيف العربي</dt><dd data-book-detail="categoryAr"></dd></div>
            <div><dt>التصنيف الإنجليزي</dt><dd data-book-detail="categoryEn"></dd></div>
            <div><dt>المؤلف</dt><dd data-book-detail="author"></dd></div>
            <div><dt>المترجم</dt><dd data-book-detail="translator"></dd></div>
            <div><dt>سنة النشر</dt><dd data-book-detail="publicationYear"></dd></div>
            <div><dt>عدد الصفحات</dt><dd data-book-detail="pagesCount"></dd></div>
            <div><dt>سنة نشر النسخة الإنجليزية</dt><dd data-book-detail="englishPublicationYear"></dd></div>
            <div><dt>صفحات النسخة الإنجليزية</dt><dd data-book-detail="englishPages"></dd></div>
            <div class="book-details-full"><dt>الوصف العربي</dt><dd data-book-detail="descriptionAr"></dd></div>
            <div class="book-details-full"><dt>الوصف الإنجليزي</dt><dd data-book-detail="descriptionEn"></dd></div>
            <div><dt>الحالة</dt><dd data-book-detail="status"></dd></div>
            <div><dt>تاريخ الإنشاء</dt><dd data-book-detail="createdAt"></dd></div>
            <div><dt>آخر تحديث</dt><dd data-book-detail="updatedAt"></dd></div>
        </dl>

        <div class="modal-actions">
            <button type="button" class="btn btn-ghost" data-close-book-details>إغلاق</button>
        </div>
    </section>
</div>
