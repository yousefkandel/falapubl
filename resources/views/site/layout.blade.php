<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'فَلَك للنشر والترجمة')</title>
    <meta name="description" content="فلك تُصدر وتترجم الكتب بين العربية والإنجليزية — كل كتاب هنا كون صغير، وكل قارئ يستحق خريطة واضحة فيه.">

    <link rel="icon" href="{{ asset('images/site/logo.svg') }}" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    @stack('styles')
</head>
<body class="cosmic-canvas">

    @include('site.partials.navbar')

    @yield('content')

    @include('site.partials.footer')

    @stack('scripts')
</body>
</html>
