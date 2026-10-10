@extends('site.layout')

@php
    $bookTitle = app()->isLocale('en') ? ($book->title_en ?: $book->title_ar) : ($book->title_ar ?: $book->title_en);
@endphp

@section('title', $bookTitle . ' — ' . __('messages.brand_short'))
@section('meta_description', Str::limit(app()->isLocale('en') ? ($book->description_en ?: $book->description_ar ?: __('messages.book_description_unavailable')) : ($book->description_ar ?: $book->description_en ?: __('messages.book_description_unavailable')), 160))

@section('content')

<section class="fk-books" style="min-height: auto; padding-top: 40px;">
    @include('site.partials.book-show', ['book' => $book])

    @if($related->isNotEmpty())
        <div style="max-width:1180px; margin: 40px auto 0;">
            <h2 style="color: var(--gold-light); font-size: 20px; margin-bottom: 20px;">{{ __('messages.related_books') }}</h2>
        </div>
        @foreach($related as $relatedBook)
            @include('site.partials.book-show', ['book' => $relatedBook])
        @endforeach
    @endif
</section>

@endsection
