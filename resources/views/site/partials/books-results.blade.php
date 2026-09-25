@forelse($books as $book)
    @include('site.partials.book-card', ['book' => $book])
@empty
    <div class="fk-empty" style="text-align:center; color: rgba(248,245,240,.6); padding: 60px 20px;">
        لا توجد نتائج مطابقة لبحثك.
    </div>
@endforelse
