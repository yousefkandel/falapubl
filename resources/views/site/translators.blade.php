@extends('site.layout')

@section('title', 'المترجمون — فَلَك للنشر')

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
        <h1 style="font-size: clamp(26px,4vw,40px);">المترجمون</h1>
        <p>المترجمون الذين نقلوا أعمال فَلَك بين العربية والإنجليزية.</p>

        <form method="GET" action="{{ route('site.translators') }}" class="fk-search-form" id="translators-search-form" data-ajax-search="translators">
            <input type="search" name="search" value="{{ request('search') }}" placeholder="ابحث باسم المترجم...">
            <button type="submit" aria-label="بحث">
                <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
            </button>
        </form>
    </div>
</section>

<section class="fk-people" id="translators-results-section" data-results-url="{{ route('site.translators') }}">
    <div id="translators-search-info">
        @if(request('search'))
            @include('site.partials._search-info', ['search' => request('search'), 'total' => $translators->total(), 'unit' => 'نتيجة', 'clearUrl' => route('site.translators')])
        @endif
    </div>

    <div class="fk-people-grid" id="translators-results-grid">
        @include('site.partials.translators-results', ['translators' => $translators])
    </div>

    <div class="fk-pagination" id="translators-pagination">
        {{ $translators->links() }}
    </div>
</section>

@endsection

@push('scripts')
<script src="{{ asset('js/site-search.js') }}"></script>
@endpush
