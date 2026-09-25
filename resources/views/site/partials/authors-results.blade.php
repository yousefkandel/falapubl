@forelse($authors as $author)
    <a href="{{ route('site.authors.show', $author) }}" class="fk-person-card">
        <div class="fk-person-avatar">
            <img src="{{ $author->avatar }}" alt="{{ $author->name_ar }}">
        </div>
        <div class="fk-person-body">
            <h3 class="fk-person-name">{{ $author->name_ar }}</h3>
            <span class="fk-person-name-en">{{ $author->name_en }}</span>
            @if($author->bio_ar)
                <p class="fk-person-bio">{{ Str::limit($author->bio_ar, 90) }}</p>
            @endif
            <span class="fk-person-count">{{ $author->books_count }} كتاب</span>
        </div>
    </a>
@empty
    <div class="fk-empty">لا توجد نتائج مطابقة لبحثك.</div>
@endforelse
