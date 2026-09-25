<tr data-id="{{ $user->id }}">
    <td>
        <div class="avatar" style="width:36px;height:36px;font-size:14px;">{{ mb_substr($user->name, 0, 1) }}</div>
    </td>
    <td><strong>{{ $user->name }}</strong></td>
    <td dir="ltr">{{ $user->email }}</td>
    <td>{{ $user->created_at->format('Y-m-d') }}</td>
    <td>
        @if($user->status)
            <span class="badge badge-success">نشط</span>
        @else
            <span class="badge badge-danger">غير نشط</span>
        @endif
    </td>
    <td>
        <div class="row-actions">
            <button class="icon-btn btn-edit"
                    data-id="{{ $user->id }}"
                    data-name="{{ $user->name }}"
                    data-email="{{ $user->email }}"
                    data-status="{{ $user->status }}">
                ✏️
            </button>
            @if($user->id !== auth()->id())
            <button class="icon-btn danger btn-delete"
                    data-id="{{ $user->id }}"
                    data-name="{{ $user->name }}">
                🗑️
            </button>
            @endif
        </div>
    </td>
</tr>
