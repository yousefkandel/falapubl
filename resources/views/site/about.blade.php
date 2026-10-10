@extends('site.layout')

@php
    $isEnglish = app()->isLocale('en');
    $pageTitle = $isEnglish ? ($page?->title_en ?: $page?->title_ar ?: __('messages.about')) : ($page?->title_ar ?: $page?->title_en ?: __('messages.about'));
    $pageContent = $isEnglish ? ($page?->content_en ?: $page?->content_ar) : ($page?->content_ar ?: $page?->content_en);
@endphp

@section('title', $pageTitle . ' — ' . __('messages.brand_short'))
@section('meta_description', Str::limit($pageContent ?: __('messages.content_updating'), 160))

@section('content')

<section class="hero-cosmic" style="min-height: 260px;">
    <div class="hero-glow g1"></div>
    <div class="hero-glow g2"></div>

    @include('site.partials.orbit-field')

    <div class="hero-mist">
        <div class="m m1"></div>
        <div class="m m2"></div>
        <div class="m m3"></div>
    </div>

    <div class="hero-content">
        <h1 dir="auto" style="font-size: clamp(26px,4vw,40px);">{{ $pageTitle }}</h1>
    </div>
</section>

<section class="fk-page-content">
    <div class="fk-page-inner">
        @if($pageContent)
            <div class="fk-prose" dir="auto">
                {!! nl2br(e($pageContent)) !!}
            </div>
        @else
            <p class="fk-empty">{{ __('messages.content_updating') }}</p>
        @endif
    </div>
</section>

@endsection
