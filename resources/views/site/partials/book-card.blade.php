@php
    $variants = ['grape', 'orchid'];
    $variant = $variants[$book->id % 2] ?? 'grape';
@endphp
<article class="fk-card fk-card--{{ $variant }}">
    <div class="fk-card-row">

        {{-- النسخة الإنجليزية --}}
        <div class="fk-half fk-half--start" dir="ltr">
            <div class="fk-cover">
                @if($book->image_en)
                    <img src="{{ asset('storage/' . $book->image_en) }}" alt="{{ $book->title_en }}" class="fk-cover-image">
                @else
                    <div class="fk-cover-inner">
                        <svg class="fk-cover-orbits" viewBox="0 0 200 300" preserveAspectRatio="xMidYMid slice">
                            <ellipse cx="100" cy="150" rx="70" ry="34" />
                            <ellipse cx="100" cy="150" rx="70" ry="34" transform="rotate(55 100 150)" />
                            <ellipse cx="100" cy="150" rx="70" ry="34" transform="rotate(-55 100 150)" />
                        </svg>
                        <span class="fk-cover-title">{{ $book->title_en }}</span>
                    </div>
                @endif
                <span class="fk-cover-star" aria-hidden="true">
                    <svg viewBox="0 0 24 24" width="14" height="14"><path d="M12 0 L14 10 L24 12 L14 14 L12 24 L10 14 L0 12 L10 10 Z" fill="currentColor" /></svg>
                </span>
            </div>

            <div class="fk-details">
                <span class="fk-eyebrow">ENGLISH EDITION</span>
  <a href="{{ route('site.books.show', $book) }}" style="color: inherit; text-decoration: none;">
    <h3 class="fk-title">
        {{ $book->title_en }}
    </h3>

    <p class="fk-desc">
        {{ Str::limit($book->description_en, 100) }}
    </p>
</a>
                <div class="fk-meta">
                    <div class="fk-meta-row">
                        <span class="fk-meta-label">Author</span>
                        <span class="fk-meta-value">
                            @if($book->author)
                                <a href="{{ route('site.authors.show', $book->author) }}" class="fk-link">{{ $book->author->name_en }}</a>
                            @else
                                —
                            @endif
                        </span>
                    </div>
                    @if($book->translator)
                    <div class="fk-meta-row">
                        <span class="fk-meta-label">Translator</span>
                        <span class="fk-meta-value">
                            <a href="{{ route('site.translators.show', $book->translator) }}" class="fk-link">{{ $book->translator->name_en }}</a>
                        </span>
                    </div>
                    @endif
                    @if($book->category_en)
                    <div class="fk-meta-row"><span class="fk-meta-label">Category</span><span class="fk-meta-value">{{ $book->category_en }}</span></div>
                    @endif
                    @if($book->english_pages)
                    <div class="fk-meta-row"><span class="fk-meta-label">Pages</span><span class="fk-meta-value">{{ $book->english_pages }}</span></div>
                    @endif
                                        @if($book->english_publication_year)
                        <div class="fk-meta-row"><span class="fk-meta-label">Publication Year</span><span class="fk-meta-value">{{ $book->english_publication_year }}</span></div>
                    @endif
                </div>
            </div>
        </div>

        <div class="fk-divider" aria-hidden="true"></div>

        {{-- النسخة العربية --}}
        <div class="fk-half fk-half--end" dir="rtl">
            <div class="fk-cover">
                @if($book->image_ar)
                    <img src="{{ asset('storage/' . $book->image_ar) }}" alt="{{ $book->title_ar }}" class="fk-cover-image">
                @else
                    <div class="fk-cover-inner">
                        <svg class="fk-cover-orbits" viewBox="0 0 200 300" preserveAspectRatio="xMidYMid slice">
                            <ellipse cx="100" cy="150" rx="70" ry="34" />
                            <ellipse cx="100" cy="150" rx="70" ry="34" transform="rotate(55 100 150)" />
                            <ellipse cx="100" cy="150" rx="70" ry="34" transform="rotate(-55 100 150)" />
                        </svg>
                        <span class="fk-cover-title">{{ $book->title_ar }}</span>
                    </div>
                @endif
                <span class="fk-cover-star" aria-hidden="true">
                    <svg viewBox="0 0 24 24" width="14" height="14"><path d="M12 0 L14 10 L24 12 L14 14 L12 24 L10 14 L0 12 L10 10 Z" fill="currentColor" /></svg>
                </span>
            </div>

            <div class="fk-details">
                <span class="fk-eyebrow">النسخة العربية</span>
            <a href="{{ route('site.books.show', $book) }}" style="color: inherit; text-decoration: none;">
    <h3 class="fk-title">
        {{ $book->title_ar }}
    </h3>

    <p class="fk-desc">
        {{ Str::limit($book->description_ar, 100) }}
    </p>
</a>
                <div class="fk-meta">
                    <div class="fk-meta-row">
                        <span class="fk-meta-label">المؤلف</span>
                        <span class="fk-meta-value">
                            @if($book->author)
                                <a href="{{ route('site.authors.show', $book->author) }}" class="fk-link">{{ $book->author->name_ar }}</a>
                            @else
                                —
                            @endif
                        </span>
                    </div>
                    @if($book->translator)
                    <div class="fk-meta-row">
                        <span class="fk-meta-label">المترجم</span>
                        <span class="fk-meta-value">
                            <a href="{{ route('site.translators.show', $book->translator) }}" class="fk-link">{{ $book->translator->name_ar }}</a>
                        </span>
                    </div>
                    @endif
                    @if($book->category_ar)
                    <div class="fk-meta-row"><span class="fk-meta-label">القسم</span><span class="fk-meta-value">{{ $book->category_ar }}</span></div>
                    @endif
                    @if($book->pages_count)
                    <div class="fk-meta-row"><span class="fk-meta-label">عدد الصفحات</span><span class="fk-meta-value">{{ $book->pages_count }}</span></div>
                    @endif
                    @if($book->publication_year)
                        <div class="fk-meta-row"><span class="fk-meta-label">سنة النشر</span><span class="fk-meta-value">{{ $book->publication_year }}</span></div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</article>
