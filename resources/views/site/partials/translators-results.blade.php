@forelse($translators as $translator)
    <a href="{{ route('site.translators.show', $translator) }}" class="fk-person-card">
        <div class="fk-person-avatar">
            <img src="{{ $translator->avatar }}" alt="{{ $translator->name_ar }}">
        </div>
        <div class="fk-person-body">
            <h3 class="fk-person-name">{{ $translator->name_ar }}</h3>
            <span class="fk-person-name-en">{{ $translator->name_en }}</span>
            @if($translator->bio_ar)
                <p class="fk-person-bio">{{ Str::limit($translator->bio_ar, 90) }}</p>
            @endif
            <span class="fk-person-count">{{ $translator->books_count }} ترجمة</span>
        </div>
    </a>
@empty
    <div class="fk-empty">لا توجد نتائج مطابقة لبحثك.</div>
@endforelse
