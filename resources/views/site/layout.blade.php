<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO --}}
    <title>@yield('title', 'فَلَك للنشر والترجمة | كتب وترجمات')</title>

    <meta
        name="description"
        content="@yield('meta_description', 'فَلَك للنشر والترجمة — نشر وترجمة الكتب بين العربية والإنجليزية، واكتشاف إصدارات وكتب مميزة لكل قارئ.')"
    >

    <meta name="robots" content="@yield('meta_robots', 'index, follow')">

    <meta name="author" content="فَلَك للنشر والترجمة">

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
    <meta property="og:title" content="@yield('og_title', 'فَلَك للنشر والترجمة')">

    <meta
        property="og:description"
        content="@yield('og_description', 'فَلَك للنشر والترجمة — كتب وإصدارات وترجمات بين العربية والإنجليزية.')"
    >

    <meta property="og:url" content="{{ url()->current() }}">

    <meta
        property="og:image"
        content="@yield('og_image', asset('images/site/logo.svg'))"
    >

    <meta property="og:locale" content="ar_AR">
    <meta property="og:site_name" content="فَلَك للنشر والترجمة">

    {{-- Twitter / X --}}
    <meta name="twitter:card" content="summary_large_image">

    <meta
        name="twitter:title"
        content="@yield('twitter_title', 'فَلَك للنشر والترجمة')"
    >

    <meta
        name="twitter:description"
        content="@yield('twitter_description', 'فَلَك للنشر والترجمة — كتب وإصدارات وترجمات بين العربية والإنجليزية.')"
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
        'name' => 'فَلَك للنشر والترجمة',
        'alternateName' => 'فلك',
        'url' => url('/'),
        'logo' => asset('images/site/logo.svg'),
        'description' => 'فَلَك للنشر والترجمة — دار نشر وترجمة بين العربية والإنجليزية.',
    ];
@endphp

<script type="application/ld+json">
    {!! json_encode($organizationSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>


{{-- Google WebSite Schema --}}
@php
    $websiteSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        '@id' => url('/') . '#website',
        'url' => url('/'),
        'name' => 'فلك',
        'alternateName' => 'فَلَك للنشر والترجمة',
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

    {{-- Page Scripts --}}
    @stack('scripts')

</body>
</html>
