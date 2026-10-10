@forelse($translators as $translator)
    @php
        $translatorName = app()->isLocale('en') ? ($translator->name_en ?: $translator->name_ar) : ($translator->name_ar ?: $translator->name_en);
        $translatorBio = app()->isLocale('en') ? ($translator->bio_en ?: $translator->bio_ar) : ($translator->bio_ar ?: $translator->bio_en);
    @endphp
    <a href="{{ route('site.translators.show', $translator) }}" class="fk-person-card">
        <div class="fk-person-avatar">
            <img src="{{ $translator->avatar }}" alt="{{ $translatorName }}">
        </div>
        <div class="fk-person-body">
            <h3 class="fk-person-name" dir="auto">{{ $translatorName }}</h3>
            @if($translatorBio)
                <p class="fk-person-bio" dir="auto">{{ Str::limit($translatorBio, 90) }}</p>
            @endif
            <span class="fk-person-count">{{ trans_choice('messages.translation_count', $translator->books_count, ['count' => $translator->books_count]) }}</span>
        </div>
    </a>
@empty
    <div class="fk-empty">{{ __('messages.no_search_results') }}</div>
@endforelse
