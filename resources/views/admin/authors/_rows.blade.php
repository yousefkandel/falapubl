@forelse($authors as $author)
    @include('admin.authors._row', ['author' => $author])
@empty
    <tr>
        <td colspan="7" class="text-center">لا توجد مؤلفين</td>
    </tr>
@endforelse
