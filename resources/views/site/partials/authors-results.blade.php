@forelse($authors as $author)
    @php
        $authorName = app()->isLocale('en') ? ($author->name_en ?: $author->name_ar) : ($author->name_ar ?: $author->name_en);
        $authorBio = app()->isLocale('en') ? ($author->bio_en ?: $author->bio_ar) : ($author->bio_ar ?: $author->bio_en);
    @endphp
    <a href="{{ route('site.authors.show', $author) }}" class="fk-person-card">
        <div class="fk-person-avatar">
            <img src="{{ $author->avatar }}" alt="{{ $authorName }}">
        </div>
        <div class="fk-person-body">
            <h3 class="fk-person-name" dir="auto">{{ $authorName }}</h3>
            @if($authorBio)
                <p class="fk-person-bio" dir="auto">{{ Str::limit($authorBio, 90) }}</p>
            @endif
            <span class="fk-person-count">{{ trans_choice('messages.book_count', $author->books_count, ['count' => $author->books_count]) }}</span>
        </div>
    </a>
@empty
    <div class="fk-empty">{{ __('messages.no_search_results') }}</div>
@endforelse
