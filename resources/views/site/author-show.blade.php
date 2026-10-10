@extends('site.layout')

@php
    $authorName = app()->isLocale('en') ? ($author->name_en ?: $author->name_ar) : ($author->name_ar ?: $author->name_en);
    $authorBio = app()->isLocale('en') ? ($author->bio_en ?: $author->bio_ar) : ($author->bio_ar ?: $author->bio_en);
@endphp

@section('title', $authorName . ' — ' . __('messages.brand_short'))
@section('meta_description', Str::limit($authorBio ?: __('messages.author_books'), 160))

@section('content')

<section class="hero-cosmic" style="min-height: 280px;">
    <div class="hero-glow g1"></div>
    <div class="hero-glow g2"></div>

    @include('site.partials.orbit-field')

    <div class="hero-mist">
        <div class="m m1"></div>
        <div class="m m2"></div>
        <div class="m m3"></div>
    </div>

    <div class="hero-content fk-profile-hero">
        <div class="fk-profile-avatar">
            <img src="{{ $author->avatar }}" alt="{{ $authorName }}">
        </div>
        <div>
            <h1 dir="auto" style="font-size: clamp(24px,3.5vw,36px); margin-bottom: 6px;">{{ $authorName }}</h1>
            @if($authorBio)
                <p dir="auto" style="max-width:560px; opacity:.9;">{{ $authorBio }}</p>
            @endif
        </div>
    </div>
</section>

<section class="fk-books">
    <div style="max-width:1180px; margin: 0 auto 16px;">
        <h2 style="color: var(--gold-light); font-size: 20px;">{{ __('messages.author_books') }}</h2>
    </div>

    @forelse($books as $book)
        @include('site.partials.book-card', ['book' => $book])
    @empty
        <div class="fk-empty">{{ __('messages.no_author_books') }}</div>
    @endforelse

    <div class="fk-pagination">
        {{ $books->links() }}
    </div>
</section>

@endsection
