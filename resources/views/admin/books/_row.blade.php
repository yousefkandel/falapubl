<tr data-id="{{ $book->id }}">

    <td>
        <img
            src="{{ $book->image_ar ? asset('storage/' . $book->image_ar) : asset('images/no-image.png') }}"
            alt="{{ $book->title_ar }}"
            width="60"
            height="80"
            style="object-fit:cover;border-radius:6px;">
    </td>
    <td>
        <img
            src="{{ $book->image_en ? asset('storage/' . $book->image_en) : asset('images/no-image.png') }}"
            alt="{{ $book->title_en}}"
            width="60"
            height="80"
            style="object-fit:cover;border-radius:6px;">
    </td>
    <td>
        <strong>{{ $book->title_ar }}</strong>

        @if($book->title_en)
            <br>
            <strong class="text-muted">
                {{ $book->title_en }}
            </strong>
        @endif
    </td>

    <td>
        {{ $book->category_ar }}

        @if($book->category_en)
            <br>
            <small class="text-muted">
                {{ $book->category_en }}
            </small>
        @endif
    </td>

    <td>

        {{ $book->author?->name_ar }}
        @if($book->author?->name_ar)
            <br>
            <small class="text-muted">
                {{ $book->author->name_en}}
            </small>
        @endif
    </td>

    <td>

        {{ $book->translator?->name_ar ?? 'لا يوجد مترجم' }}

    </td>

    <td>

        @if($book->status)

            <span class="badge badge-success">

                مفعل

            </span>

        @else

            <span class="badge badge-danger">

                غير مفعل

            </span>

        @endif

    </td>

    <td>

        <div class="row-actions">

            <button
                type="button"
                class="icon-btn btn-view"
                aria-label="عرض تفاصيل {{ $book->title_ar }}"
                data-title-ar="{{ $book->title_ar }}"
                data-title-en="{{ $book->title_en }}"
                data-category-ar="{{ $book->category_ar }}"
                data-category-en="{{ $book->category_en }}"
                data-author="{{ $book->author?->name_ar }}"
                data-translator="{{ $book->translator?->name_ar }}"
                data-publication-year="{{ $book->publication_year }}"
                data-pages-count="{{ $book->pages_count }}"
                data-english-publication-year="{{ $book->english_publication_year }}"
                data-english-pages="{{ $book->english_pages }}"
                data-description-ar="{{ $book->description_ar }}"
                data-description-en="{{ $book->description_en }}"
                data-status="{{ $book->status ? 'مفعل' : 'غير مفعل' }}"
                data-image-ar="{{ $book->image_ar ? asset('storage/' . $book->image_ar) : '' }}"
                data-image-en="{{ $book->image_en ? asset('storage/' . $book->image_en) : '' }}"
                data-created-at="{{ $book->created_at?->format('Y-m-d H:i') }}"
                data-updated-at="{{ $book->updated_at?->format('Y-m-d H:i') }}">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>

            <button
                type="button"
                class="icon-btn btn-edit"
                data-id="{{ $book->id }}"
                data-title-ar="{{ $book->title_ar }}"
                data-title-en="{{ $book->title_en }}"
                data-category-ar="{{ $book->category_ar }}"
                data-category-en="{{ $book->category_en }}"
                data-author-id="{{ $book->author_id }}"
                data-translator-id="{{ $book->translator_id }}"
                data-publication-year="{{ $book->publication_year }}"
                data-pages-count="{{ $book->pages_count }}"
                data-english-publication-year="{{ $book->english_publication_year }}"
                data-english-pages="{{ $book->english_pages }}"
                data-description-ar="{{ $book->description_ar }}"
                data-description-en="{{ $book->description_en }}"
                data-status="{{ $book->status }}"
                data-image-ar="{{ $book->image_ar }}"
                data-image-en="{{ $book->image_en }}">
                ✏️
            </button>

            <button
                class="icon-btn danger btn-delete"
                data-id="{{ $book->id }}"
                data-title="{{ $book->title_ar }}">
                🗑️
            </button>

        </div>

    </td>

</tr>
