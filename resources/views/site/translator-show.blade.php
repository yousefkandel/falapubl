@extends('site.layout')

@php
    $translatorName = app()->isLocale('en') ? ($translator->name_en ?: $translator->name_ar) : ($translator->name_ar ?: $translator->name_en);
    $translatorBio = app()->isLocale('en') ? ($translator->bio_en ?: $translator->bio_ar) : ($translator->bio_ar ?: $translator->bio_en);
@endphp

@section('title', $translatorName . ' — ' . __('messages.brand_short'))
@section('meta_description', Str::limit($translatorBio ?: __('messages.translator_books'), 160))

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
            <img src="{{ $translator->avatar }}" alt="{{ $translatorName }}">
        </div>
        <div>
            <h1 dir="auto" style="font-size: clamp(24px,3.5vw,36px); margin-bottom: 6px;">{{ $translatorName }}</h1>
            @if($translatorBio)
                <p dir="auto" style="max-width:560px; opacity:.9;">{{ $translatorBio }}</p>
            @endif
        </div>
    </div>
</section>

<section class="fk-books">
    <div style="max-width:1180px; margin: 0 auto 16px;">
        <h2 style="color: var(--gold-light); font-size: 20px;">{{ __('messages.translator_books') }}</h2>
    </div>

    @forelse($books as $book)
        @include('site.partials.book-card', ['book' => $book])
    @empty
        <div class="fk-empty">{{ __('messages.no_translator_books') }}</div>
    @endforelse

    <div class="fk-pagination">
        {{ $books->links() }}
    </div>
</section>

@endsection
