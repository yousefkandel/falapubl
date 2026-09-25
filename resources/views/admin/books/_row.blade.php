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

        {{ $book->publication_year }}

        <br>

        <small class="text-muted">

            {{ $book->pages_count }} صفحة

        </small>

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
