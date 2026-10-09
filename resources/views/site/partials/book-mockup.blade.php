@php
    $edition = $edition ?? 'ar';
    $bookCoverPath = $edition === 'en' ? $book->image_en : $book->image_ar;
    $bookCoverTitle = $edition === 'en' ? $book->title_en : $book->title_ar;
@endphp

<div class="fk-cover">
    @if($bookCoverPath)
        <button type="button" class="fk-cover__trigger js-book-cover-open" aria-label="عرض غلاف {{ $bookCoverTitle ?: $book->title_ar }}">
            <img
                src="{{ asset('storage/' . $bookCoverPath) }}"
                alt="{{ $bookCoverTitle }}"
                class="fk-cover-image">
        </button>
    @endif
</div>
