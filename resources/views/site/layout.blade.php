<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $seoTitle = trim($__env->yieldContent('title')) ?: __('messages.default_title');
        $seoDescription = trim($__env->yieldContent('meta_description')) ?: __('messages.default_description');
    @endphp

    {{-- SEO --}}
    <title>@yield('title', __('messages.default_title'))</title>

    <meta
        name="description"
        content="{{ $seoDescription }}"
    >

    <meta name="robots" content="@yield('meta_robots', 'index, follow')">

    <meta name="author" content="{{ __('messages.brand') }}">

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Favicon --}}
    <link
        rel="icon"
        href="{{ asset('images/site/logo.svg') }}"
        type="image/svg+xml"
    >

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    {{-- Main CSS --}}
    <link
        rel="stylesheet"
        href="{{ asset('css/site.css') }}"
    >

    {{-- Open Graph --}}
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:title" content="@yield('og_title', $seoTitle)">

    <meta
        property="og:description"
        content="@yield('og_description', $seoDescription)"
    >

    <meta property="og:url" content="{{ url()->current() }}">

    <meta
        property="og:image"
        content="@yield('og_image', asset('images/site/logo.svg'))"
    >

    <meta property="og:locale" content="{{ app()->isLocale('ar') ? 'ar_AR' : 'en_US' }}">
    <meta property="og:site_name" content="{{ __('messages.brand') }}">

    {{-- Twitter / X --}}
    <meta name="twitter:card" content="summary_large_image">

    <meta
        name="twitter:title"
        content="@yield('twitter_title', $seoTitle)"
    >

    <meta
        name="twitter:description"
        content="@yield('twitter_description', $seoDescription)"
    >

    <meta
        name="twitter:image"
        content="@yield('twitter_image', asset('images/site/logo.svg'))"
    >

{{-- Google Organization Schema --}}
@php
    $organizationSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        '@id' => url('/') . '#organization',
        'name' => __('messages.brand'),
        'alternateName' => 'فلك',
        'url' => url('/'),
        'logo' => asset('images/site/logo.svg'),
        'description' => __('messages.default_description'),
    ];
@endphp

<script type="application/ld+json">
    {!! json_encode($organizationSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>


{{-- Google WebSite Schema --}}
{{-- Google WebSite Schema --}}
@php
    $websiteSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        '@id' => url('/') . '#website',
        'url' => url('/'),
        'name' => __('messages.brand'),
        'alternateName' => [
            'فلك',
            'Falak Publishing',
            'Falak Publishing & Translation',
        ],
        'publisher' => [
            '@id' => url('/') . '#organization',
        ],
    ];
@endphp

<script type="application/ld+json">
    {!! json_encode($websiteSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
@stack('styles')
</head>

<body class="cosmic-canvas">

    {{-- Navigation --}}
    @include('site.partials.navbar')

    {{-- Page Content --}}
    @yield('content')

    {{-- Footer --}}
    @include('site.partials.footer')

    <div class="book-lightbox" id="book-cover-lightbox" role="dialog" aria-modal="true" aria-label="{{ __('messages.cover_popup') }}" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}" hidden>
        <button type="button" class="book-lightbox__close" data-close-book-lightbox aria-label="{{ __('messages.close_cover_popup') }}">&times;</button>
        <img class="book-lightbox__image" data-book-lightbox-image alt="">
    </div>

    {{-- Page Scripts --}}
    <script src="{{ asset('js/book-cover-lightbox.js') }}" defer></script>
    @stack('scripts')

</body>
</html>
