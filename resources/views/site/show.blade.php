@extends('site.layout')

@section('title', $book->title_ar . ' — فَلَك للنشر')

@section('content')

<section class="fk-books" style="min-height: auto; padding-top: 40px;">
    @include('site.partials.book-show', ['book' => $book])

    @if($related->isNotEmpty())
        <div style="max-width:1180px; margin: 40px auto 0;">
            <h2 style="color: var(--gold-light); font-size: 20px; margin-bottom: 20px;">قد يعجبك أيضاً</h2>
        </div>
        @foreach($related as $relatedBook)
            @include('site.partials.book-show', ['book' => $relatedBook])
        @endforeach
    @endif
</section>

@endsection
