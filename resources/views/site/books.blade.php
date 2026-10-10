@extends('site.layout')

@section('title', __('messages.books_title'))
@section('meta_description', __('messages.books_intro'))

@section('content')

<section class="hero-cosmic" style="min-height: 280px;">
    <div class="hero-glow g1"></div>
    <div class="hero-glow g2"></div>

    @include('site.partials.orbit-field')

    <div class="hero-mist">
        <div class="m m1"></div>
        <div class="m m2"></div>
        <div class="m m3"></div>
    </div>

    <div class="hero-content">
        <h1 style="font-size: clamp(26px,4vw,40px);">{{ __('messages.books_hero') }}</h1>
        <p>{{ __('messages.books_intro') }}</p>

        <form method="GET" action="{{ route('site.books') }}" class="fk-search-form" id="books-search-form" data-ajax-search="books">
            <input type="search" name="search" value="{{ request('search') }}" placeholder="{{ __('messages.search_book') }}">
            <button type="submit" aria-label="{{ __('messages.search') }}">
                <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
            </button>
        </form>
    </div>
</section>

<section class="fk-books" id="books-results-section" data-results-url="{{ route('site.books') }}" data-error-message="{{ __('messages.search_error') }}" data-unexpected-message="{{ __('messages.unexpected_error') }}">
    <div id="books-search-info">
        @if(request('search'))
            @include('site.partials._search-info', ['search' => request('search'), 'total' => $books->total(), 'unit' => __('messages.results'), 'clearUrl' => route('site.books')])
        @endif
    </div>

    <div id="books-results-grid">
        @include('site.partials.books-results', ['books' => $books])
    </div>

    <div style="max-width:1180px; margin: 20px auto 0; color: rgba(248,245,240,.8);" id="books-pagination">
        {{ $books->links() }}
    </div>
</section>

@endsection

@push('scripts')
<script src="{{ asset('js/site-search.js') }}"></script>
@endpush
