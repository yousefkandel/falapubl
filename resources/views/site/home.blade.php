@extends('site.layout')

@section('title', __('messages.home_title'))
@section('meta_description', __('messages.home_intro'))

@section('content')

<section class="hero-cosmic home-hero">
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
       <div class="fk-head-social">
    <!-- Instagram -->
    <a href="https://www.instagram.com/darfalakpubl/"
       aria-label="Instagram"
       class="fk-social-btn"
       target="_blank"
       rel="noopener noreferrer">
        <svg viewBox="0 0 24 24" width="17" height="17" fill="none">
            <rect x="3.5" y="3.5" width="17" height="17" rx="5"
                  stroke="currentColor" stroke-width="1.5"/>
            <circle cx="12" cy="12" r="4"
                    stroke="currentColor" stroke-width="1.5"/>
            <circle cx="17.2" cy="6.8" r="1" fill="currentColor"/>
        </svg>
    </a>

    <!-- TikTok -->
    <a href="https://www.tiktok.com/@darfalakpubl"
       aria-label="TikTok"
       class="fk-social-btn"
       target="_blank"
       rel="noopener noreferrer">
        <svg viewBox="0 0 24 24" width="17" height="17" fill="currentColor">
            <path d="M19.6 7.2a6.1 6.1 0 0 1-3.8-1.3v8.4a5.8 5.8 0 1 1-5-5.7v3.2a2.7 2.7 0 1 0 1.8 2.5V2.5h3.2c.2 2 1.6 3.7 3.8 4.1z"/>
        </svg>
    </a>

    <!-- X -->
    <a href="https://x.com/darfalakpubl?s=11&amp;t=rQv_Mkl71k0FacHQXDsobA"
       aria-label="X"
       class="fk-social-btn"
       target="_blank"
       rel="noopener noreferrer">
        <svg viewBox="0 0 24 24" width="17" height="17" fill="currentColor" aria-hidden="true">
            <path d="M18.9 2h3.6l-7.9 9L24 22h-7.5l-5.9-7.7L3.8 22H.2l8.5-9.7L0 2h7.7l5.3 7.1L18.9 2Zm-1.3 18h2L6.5 3.9h-2z"/>
        </svg>
    </a>

    <!-- WhatsApp -->
    <a href="https://wa.me/971508386699"
       aria-label="WhatsApp"
       class="fk-social-btn"
       target="_blank"
       rel="noopener noreferrer">
        <svg viewBox="0 0 24 24" width="17" height="17" fill="currentColor">
            <path d="M20.5 3.5A11.8 11.8 0 0 0 2 17.7L.5 23.5l6-1.6A11.8 11.8 0 0 0 20.5 3.5ZM12 21a9 9 0 0 1-4.6-1.3l-.3-.2-3.4.9.9-3.3-.2-.3A9 9 0 1 1 12 21Zm5-6.7c-.3-.2-1.7-.8-2-.9s-.5-.2-.7.2-.8.9-1 1.1-.3.2-.6.1a7.3 7.3 0 0 1-2.2-1.4 8.2 8.2 0 0 1-1.5-1.9c-.2-.3 0-.5.1-.6l.5-.6.3-.5c.1-.2 0-.4 0-.5s-.7-1.7-.9-2.3c-.2-.6-.5-.5-.7-.5h-.6c-.2 0-.5.1-.8.4s-1 1-1 2.4 1 2.8 1.1 3c.1.2 2 3.1 4.8 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.6-.1 1.7-.7 1.9-1.4.2-.7.2-1.3.2-1.4s-.2-.3-.5-.4Z"/>
        </svg>
    </a>

    <!-- Gmail -->
    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=copyright@falakpubl.com"
       aria-label="Gmail"
       class="fk-social-btn"
       target="_blank"
       rel="noopener noreferrer">
        <svg viewBox="0 0 24 24" width="17" height="17" fill="none">
            <path d="M3 6.5A1.5 1.5 0 0 1 4.5 5h15A1.5 1.5 0 0 1 21 6.5v11a1.5 1.5 0 0 1-1.5 1.5h-15A1.5 1.5 0 0 1 3 17.5v-11Z"
                  stroke="currentColor" stroke-width="1.5"/>
            <path d="m4 6 8 6 8-6"
                  stroke="currentColor" stroke-width="1.5"
                  stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </a>
</div>
    </div>
</section>

<section class="fk-books" id="home-books-section" data-load-more-url="{{ route('site.home') }}">
    <div id="home-books-results">
        @forelse($books as $book)
            @include('site.partials.book-card', ['book' => $book])
        @empty
            <div style="text-align:center; color: rgba(248,245,240,.6); padding: 60px 20px;">
                {{ __('messages.home_empty') }}
            </div>
        @endforelse
    </div>

    <div class="fk-load-more-wrap" @if(!$hasMore) hidden @endif>
        <button type="button" class="fk-load-more btn-primary" id="home-load-more" data-offset="{{ $books->count() }}" aria-controls="home-books-results">
            <span>{{ __('messages.load_more') }}</span>
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
    </div>
</section>

@endsection

@push('scripts')
<script src="{{ asset('js/home-load-more.js') }}" defer></script>
@endpush
