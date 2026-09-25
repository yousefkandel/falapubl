<header class="site-header">
    <div class="nav-inner">
        <a href="{{ route('site.home') }}" class="logo">
            <img src="{{ asset('images/site/logo.svg') }}" alt="Falak Publishing" class="logo-img">
        </a>

        <nav class="links">
            <a href="{{ route('site.home') }}"
                class="{{ request()->routeIs('site.home') ? 'active' : '' }}">الرئيسية</a>
            <a href="{{ route('site.books') }}"
                class="{{ request()->routeIs('site.books*') ? 'active' : '' }}">الكتب</a>
            <a href="{{ route('site.authors') }}">المؤلفون</a>
            <a href="{{ route('site.translators') }}">المترجمون</a>
            <a href="{{ route('site.about') }}">من نحن</a>
            <a href="{{ route('site.contact') }}">تواصل معنا</a>
        </nav>

        <div class="nav-actions">

            <button class="burger" aria-label="القائمة"
                onclick="document.querySelector('.mobile-panel').classList.toggle('open')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <div class="mobile-panel">
        <a href="{{ route('site.home') }}">الرئيسية</a>
        <a href="{{ route('site.books') }}">الكتب</a>
        <a href="{{ route('site.authors') }}">المؤلفون</a>
        <a href="{{ route('site.translators') }}">المترجمون</a>
        <a href="{{ route('site.about') }}">من نحن</a>
        <a href="{{ route('site.contact') }}">تواصل معنا</a>
    </div>
</header>