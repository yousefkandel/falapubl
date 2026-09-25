@forelse($books as $book)

    @include('admin.books._row',[
        'book'=>$book
    ])

@empty

<tr>

    <td colspan="8" class="text-center">

        لا توجد كتب

    </td>

</tr>

@endforelse
