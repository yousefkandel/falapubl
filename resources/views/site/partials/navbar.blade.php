<header class="site-header">
    <div class="nav-inner">
        <a href="{{ route('site.home') }}" class="logo">
            <img src="{{ asset('images/site/logo.svg') }}" alt="{{ __('messages.brand') }}" class="logo-img">
        </a>

        <nav class="links">
            <a href="{{ route('site.home') }}"
                class="{{ request()->routeIs('site.home') ? 'active' : '' }}">{{ __('messages.home') }}</a>
            <a href="{{ route('site.books') }}"
                class="{{ request()->routeIs('site.books*') ? 'active' : '' }}">{{ __('messages.books') }}</a>
            <a href="{{ route('site.authors') }}">{{ __('messages.authors') }}</a>
            <a href="{{ route('site.translators') }}">{{ __('messages.translators') }}</a>
            <a href="{{ route('site.about') }}">{{ __('messages.about') }}</a>
            <a href="{{ route('site.contact') }}">{{ __('messages.contact') }}</a>
        </nav>

        <div class="nav-actions">
            @include('site.partials.language-switcher')
            <button class="burger" aria-label="{{ __('messages.menu') }}"
                onclick="document.querySelector('.mobile-panel').classList.toggle('open')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <div class="mobile-panel">
        <a href="{{ route('site.home') }}">{{ __('messages.home') }}</a>
        <a href="{{ route('site.books') }}">{{ __('messages.books') }}</a>
        <a href="{{ route('site.authors') }}">{{ __('messages.authors') }}</a>
        <a href="{{ route('site.translators') }}">{{ __('messages.translators') }}</a>
        <a href="{{ route('site.about') }}">{{ __('messages.about') }}</a>
        <a href="{{ route('site.contact') }}">{{ __('messages.contact') }}</a>
        @include('site.partials.language-switcher')
    </div>
</header>
