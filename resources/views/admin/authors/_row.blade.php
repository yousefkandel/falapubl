<tr data-id="{{ $author->id }}">
    <td>
        <img src="{{ $author->avatar }}"
             alt="{{ $author->name_ar }}"
             width="50" height="50"
             style="object-fit:cover;border-radius:50%;border:2px solid var(--falak-border);">
    </td>
    <td>
        <strong>{{ $author->name_ar }}</strong>
    </td>
    <td>
        {{ $author->name_en }}
    </td>
    <td>
        {{ Str::limit($author->bio_ar, 50) }}
        @if($author->bio_en)
            <br><small class="text-muted">{{ Str::limit($author->bio_en, 50) }}</small>
        @endif
    </td>
    <td>
        <span class="badge badge-info">{{ $author->books_count ?? $author->books->count() }}</span>
    </td>
    <td>
        @if($author->status)
            <span class="badge badge-success">نشط</span>
        @else
            <span class="badge badge-danger">غير نشط</span>
        @endif
    </td>
    <td>
        <div class="row-actions">
            <button class="icon-btn btn-edit"
                    data-id="{{ $author->id }}"
                    data-name-ar="{{ $author->name_ar }}"
                    data-name-en="{{ $author->name_en }}"
                    data-bio-ar="{{ $author->bio_ar }}"
                    data-bio-en="{{ $author->bio_en }}"
                    data-image="{{ $author->image }}"
                    data-status="{{ $author->status }}">
                ✏️
            </button>
            <button class="icon-btn danger btn-delete"
                    data-id="{{ $author->id }}"
                    data-name="{{ $author->name_ar }}">
                🗑️
            </button>
        </div>
    </td>
</tr>
