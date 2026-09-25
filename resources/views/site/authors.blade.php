@extends('site.layout')

@section('title', 'المؤلفون — فَلَك للنشر')

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
        <h1 style="font-size: clamp(26px,4vw,40px);">المؤلفون</h1>
        <p>تعرّف على كُتّاب إصدارات فَلَك وأعمالهم.</p>

        <form method="GET" action="{{ route('site.authors') }}" class="fk-search-form" id="authors-search-form" data-ajax-search="authors">
            <input type="search" name="search" value="{{ request('search') }}" placeholder="ابحث باسم المؤلف...">
            <button type="submit" aria-label="بحث">
                <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
            </button>
        </form>
    </div>
</section>

<section class="fk-people" id="authors-results-section" data-results-url="{{ route('site.authors') }}">
    <div id="authors-search-info">
        @if(request('search'))
            @include('site.partials._search-info', ['search' => request('search'), 'total' => $authors->total(), 'unit' => 'نتيجة', 'clearUrl' => route('site.authors')])
        @endif
    </div>

    <div class="fk-people-grid" id="authors-results-grid">
        @include('site.partials.authors-results', ['authors' => $authors])
    </div>

    <div class="fk-pagination" id="authors-pagination">
        {{ $authors->links() }}
    </div>
</section>

@endsection

@push('scripts')
<script src="{{ asset('js/site-search.js') }}"></script>
@endpush
