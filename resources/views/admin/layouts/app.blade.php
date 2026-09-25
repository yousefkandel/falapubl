<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'الرئيسية') — لوحة تحكم فلك</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@400;700;800&family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @stack('styles')
</head>
<body>
    <div class="app-shell">

        {{-- غطاء خلفي يظهر عند فتح القائمة في وضع الموبايل --}}
        <div class="sidebar-overlay" id="sidebar-overlay"></div>

        {{-- ===== الشريط الجانبي ===== --}}
        <aside class="sidebar" id="app-sidebar">
            <div class="sidebar-brand">
                <div class="logo-mark">ف</div>
                <span>فَلَك</span>
            </div>

            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 11l9-7 9 7"/><path d="M5 10v9h14v-9"/></svg>
                    الرئيسية
                </a>

                <div class="nav-group-label">إدارة المحتوى</div>
                <a href="{{ route('admin.books.index') }}" class="{{ request()->routeIs('admin.books.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 5a2 2 0 012-2h11v18H6a2 2 0 01-2-2V5z"/><path d="M17 3v18"/></svg>
                    الكتب
                </a>
                <a href="{{ route('admin.authors.index') }}" class="{{ request()->routeIs('admin.authors.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 4-6 8-6s8 2 8 6"/></svg>
                    المؤلفون
                </a>
                <a href="{{ route('admin.translators.index') }}" class="{{ request()->routeIs('admin.translators.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M8 4l8 4-8 4M8 12l8 4-8 4"/></svg>
                    المترجمون
                </a>
                <a href="{{ route('admin.content.index') }}" class="{{ request()->routeIs('admin.content.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6M16 13H8M16 17H8M10 9H8"/></svg>
                    من نحن / تواصل
                </a>

                <div class="nav-group-label">النظام</div>
                <a href="{{ route('admin.contact-messages.index') }}" class="{{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><path d="M22 6l-10 7L2 6"/></svg>
                    رسائل التواصل
                    @php $unreadCount = \App\Models\ContactMessage::where('is_read', false)->count(); @endphp
                    @if($unreadCount > 0)
                        <span class="badge badge-danger" style="margin-inline-start:auto; padding:2px 8px; font-size:11px;">{{ $unreadCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    المستخدمون
                </a>
                <a href="{{ route('site.home') }}" target="_blank">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15 15 0 010 20 15 15 0 010-20z"/></svg>
                    عرض الموقع
                </a>
            </nav>

            <div class="sidebar-footer">
                <div class="sidebar-user">
                    <div class="avatar">{{ mb_substr(auth()->user()->name ?? 'أ', 0, 1) }}</div>
                    <div>
                        <div class="name">{{ auth()->user()->name ?? 'المشرف' }}</div>
                        <div class="role">مدير المكتبة</div>
                    </div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" title="تسجيل الخروج">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- ===== المحتوى ===== --}}
        <div class="main-content">
            <header class="topbar">
                <div class="topbar-title-wrap">
                    <button type="button" class="sidebar-toggle" id="sidebar-toggle" aria-label="فتح القائمة">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <div>
                        <h2>@yield('page-title', 'الرئيسية')</h2>
                        <div class="breadcrumb">@yield('breadcrumb', 'لوحة التحكم')</div>
                    </div>
                </div>
                <div class="topbar-search">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4-4"/></svg>
                    <input type="search" placeholder="بحث سريع...">
                </div>
            </header>

            <main class="content">
                @if (session('success'))
                    <div class="toast toast-success show" style="position:static;margin-bottom:18px;display:inline-block;">{{ session('success') }}</div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

    <div id="toast" class="toast"></div>

    <script src="{{ asset('js/dashboard.js') }}"></script>
    @stack('scripts')
</body>
</html>
