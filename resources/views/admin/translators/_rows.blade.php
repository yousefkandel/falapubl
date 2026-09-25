@forelse($translators as $translator)
    @include('admin.translators._row', ['translator' => $translator])
@empty
    <tr>
        <td colspan="7" class="text-center">لا توجد مترجمين</td>
    </tr>
@endforelse
