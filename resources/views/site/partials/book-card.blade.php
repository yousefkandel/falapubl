@php
    $variants = ['grape', 'orchid'];
    $variant = $variants[$book->id % 2] ?? 'grape';
    $editions = [
        [
            'locale' => 'en',
            'side' => 'start',
            'direction' => 'ltr',
            'label' => __('messages.english_edition', [], 'en'),
            'image' => $book->image_en,
            'title' => $book->title_en ?: $book->title_ar,
            'description' => $book->description_en ?: $book->description_ar,
            'author' => $book->author?->name_en ?: $book->author?->name_ar,
            'translator' => $book->translator?->name_en ?: $book->translator?->name_ar,
            'category' => $book->category_en ?: $book->category_ar,
            'year' => $book->english_publication_year ?: $book->publication_year,
            'pages' => $book->english_pages ?: $book->pages_count,
        ],
        [
            'locale' => 'ar',
            'side' => 'end',
            'direction' => 'rtl',
            'label' => __('messages.arabic_edition', [], 'ar'),
            'image' => $book->image_ar,
            'title' => $book->title_ar ?: $book->title_en,
            'description' => $book->description_ar ?: $book->description_en,
            'author' => $book->author?->name_ar ?: $book->author?->name_en,
            'translator' => $book->translator?->name_ar ?: $book->translator?->name_en,
            'category' => $book->category_ar ?: $book->category_en,
            'year' => $book->publication_year ?: $book->english_publication_year,
            'pages' => $book->pages_count ?: $book->english_pages,
        ],
    ];
@endphp
<article class="fk-card fk-card--{{ $variant }}">
    <div class="fk-card-row">
        @foreach($editions as $edition)
            <div class="fk-half fk-half--{{ $edition['side'] }}" dir="{{ $edition['direction'] }}">
                <div class="fk-cover">
                    @if($edition['image'])
                        <button type="button" class="fk-cover-image-trigger js-book-cover-open" aria-label="{{ __('messages.cover_popup') }}: {{ $edition['title'] }}">
                            <img src="{{ asset('storage/' . $edition['image']) }}" alt="{{ $edition['title'] }}" class="fk-cover-image">
                        </button>
                    @else
                        <div class="fk-cover-inner">
                            <svg class="fk-cover-orbits" viewBox="0 0 200 300" preserveAspectRatio="xMidYMid slice">
                                <ellipse cx="100" cy="150" rx="70" ry="34" />
                                <ellipse cx="100" cy="150" rx="70" ry="34" transform="rotate(55 100 150)" />
                                <ellipse cx="100" cy="150" rx="70" ry="34" transform="rotate(-55 100 150)" />
                            </svg>
                            <span class="fk-cover-title">{{ $edition['title'] }}</span>
                        </div>
                    @endif
                    <span class="fk-cover-star" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="14" height="14"><path d="M12 0 L14 10 L24 12 L14 14 L12 24 L10 14 L0 12 L10 10 Z" fill="currentColor" /></svg>
                    </span>
                </div>

                <div class="fk-details">
                    <span class="fk-eyebrow">{{ $edition['label'] }}</span>
                    <a href="{{ route('site.books.show', $book) }}" style="color: inherit; text-decoration: none;">
                        <h3 class="fk-title" dir="auto">{{ $edition['title'] }}</h3>
                        <p class="fk-desc" dir="auto">{{ Str::limit($edition['description'] ?: __('messages.book_description_unavailable', [], $edition['locale']), 100) }}</p>
                    </a>
                    <div class="fk-meta">
                        <div class="fk-meta-row">
                            <span class="fk-meta-label">{{ __('messages.author', [], $edition['locale']) }}</span>
                            <span class="fk-meta-value">
                                @if($book->author)
                                    <a href="{{ route('site.authors.show', $book->author) }}" class="fk-link">{{ $edition['author'] }}</a>
                                @else
                                    —
                                @endif
                            </span>
                        </div>
                        @if($book->translator)
                            <div class="fk-meta-row">
                                <span class="fk-meta-label">{{ __('messages.translator', [], $edition['locale']) }}</span>
                                <span class="fk-meta-value"><a href="{{ route('site.translators.show', $book->translator) }}" class="fk-link">{{ $edition['translator'] }}</a></span>
                            </div>
                        @endif
                        @if($edition['category'])
                            <div class="fk-meta-row"><span class="fk-meta-label">{{ __('messages.category', [], $edition['locale']) }}</span><span class="fk-meta-value">{{ $edition['category'] }}</span></div>
                        @endif
                        @if($edition['pages'])
                            <div class="fk-meta-row"><span class="fk-meta-label">{{ __('messages.pages', [], $edition['locale']) }}</span><span class="fk-meta-value">{{ $edition['pages'] }}</span></div>
                        @endif
                        @if($edition['year'])
                            <div class="fk-meta-row"><span class="fk-meta-label">{{ __('messages.publication_year', [], $edition['locale']) }}</span><span class="fk-meta-value">{{ $edition['year'] }}</span></div>
                        @endif
                    </div>
                </div>
            </div>
            @if($edition['side'] === 'start')
                <div class="fk-divider" aria-hidden="true"></div>
            @endif
        @endforeach
    </div>
</article>
