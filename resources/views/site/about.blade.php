@extends('site.layout')

@section('title', ($page->title_ar ?? 'من نحن') . ' — فَلَك للنشر')

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
        <h1 style="font-size: clamp(26px,4vw,40px);">{{ $page->title_ar ?? 'من نحن' }}</h1>
        @if(!empty($page->title_en))
            <p style="opacity:.7;">{{ $page->title_en }}</p>
        @endif
    </div>
</section>

<section class="fk-page-content">
    <div class="fk-page-inner">
        @if($page && $page->content_ar)
            <div class="fk-prose">
                {!! nl2br(e($page->content_ar)) !!}
            </div>
        @else
            <p class="fk-empty">المحتوى قيد التحديث.</p>
        @endif
    </div>
</section>

@endsection
