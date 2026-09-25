<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'تسجيل الدخول') — لوحة تحكم فلك</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@400;700;800&family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    @stack('styles')
</head>
<body>
    @yield('content')

    <script>
        // نجوم متلألئة عشوائية في خلفية صفحات الدخول
        document.addEventListener('DOMContentLoaded', () => {
            const page = document.querySelector('.auth-page');
            if (!page) return;
            for (let i = 0; i < 28; i++) {
                const star = document.createElement('span');
                star.className = 'star';
                star.style.top = Math.random() * 100 + '%';
                star.style.left = Math.random() * 100 + '%';
                star.style.animationDelay = (Math.random() * 3) + 's';
                page.appendChild(star);
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
