@extends('site.layout')

@section('title', __('messages.home_title'))
@section('meta_description', __('messages.home_intro'))

@section('content')

<section class="hero-cosmic">
    <div class="hero-glow g1"></div>
    <div class="hero-glow g2"></div>

    @include('site.partials.orbit-field')

    <div class="hero-mist">
        <div class="m m1"></div>
        <div class="m m2"></div>
        <div class="m m3"></div>
    </div>

    <div class="hero-content">
        <h1>{{ __('messages.home_heading') }}</h1>
        <p>{{ __('messages.home_intro') }}</p>
        <div class="hero-ctas">
            <a href="{{ route('site.books') }}" class="btn-primary">{{ __('messages.browse_books') }}</a>
            <a href="{{ route('site.about') }}" class="btn-outline-dark">{{ __('messages.falak_story') }}</a>
        </div>
    </div>
</section>

<section class="fk-books">
    @forelse($books as $book)
        @include('site.partials.book-card', ['book' => $book])
    @empty
        <div style="text-align:center; color: rgba(248,245,240,.6); padding: 60px 20px;">
            {{ __('messages.home_empty') }}
        </div>
    @endforelse
</section>

@endsection
