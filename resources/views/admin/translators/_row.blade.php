<tr data-id="{{ $translator->id }}">
    <td>
        @if($translator->image)
            <img src="{{ asset('storage/' . $translator->image) }}"
                 alt="{{ $translator->name_ar }}"
                 width="50" height="50"
                 style="object-fit:cover;border-radius:50%;border:2px solid var(--falak-border);">
        @else
            <div style="width:50px;height:50px;border-radius:50%;background:var(--falak-purple-700);display:flex;align-items:center;justify-content:center;color:var(--falak-gold-light);font-weight:bold;font-size:20px;border:2px solid var(--falak-border);">
                {{ substr($translator->name_ar, 0, 1) }}
            </div>
        @endif
    </td>
    <td>
        <strong>{{ $translator->name_ar }}</strong>
    </td>
    <td>
        {{ $translator->name_en }}
    </td>
    <td>
        {{ Str::limit($translator->bio_ar, 50) }}
        @if($translator->bio_en)
            <br><small class="text-muted">{{ Str::limit($translator->bio_en, 50) }}</small>
        @endif
    </td>
    <td>
        <span class="badge badge-info">{{ $translator->books_count ?? $translator->books->count() }}</span>
    </td>
    <td>
        @if($translator->status)
            <span class="badge badge-success">نشط</span>
        @else
            <span class="badge badge-danger">غير نشط</span>
        @endif
    </td>
    <td>
        <div class="row-actions">
            <button class="icon-btn btn-edit"
                    data-id="{{ $translator->id }}"
                    data-name-ar="{{ $translator->name_ar }}"
                    data-name-en="{{ $translator->name_en }}"
                    data-bio-ar="{{ $translator->bio_ar }}"
                    data-bio-en="{{ $translator->bio_en }}"
                    data-image="{{ $translator->image }}"
                    data-status="{{ $translator->status }}">
                ✏️
            </button>
            <button class="icon-btn danger btn-delete"
                    data-id="{{ $translator->id }}"
                    data-name="{{ $translator->name_ar }}">
                🗑️
            </button>
        </div>
    </td>
</tr>
