@forelse($users as $user)
    @include('admin.users._row', ['user' => $user])
@empty
    <tr>
        <td colspan="6" class="text-center">لا يوجد مستخدمون</td>
    </tr>
@endforelse
