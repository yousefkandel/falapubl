@extends('site.layout')

@section('title', 'الكتب — فَلَك للنشر')

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
        <h1 style="font-size: clamp(26px,4vw,40px);">فلك للترجمة والنشر والتوزيع</h1>
        <p>تصفّح كل الإصدارات</p>

        <form method="GET" action="{{ route('site.books') }}" class="fk-search-form" id="books-search-form" data-ajax-search="books">
            <input type="search" name="search" value="{{ request('search') }}" placeholder="ابحث بعنوان الكتاب...">
            <button type="submit" aria-label="بحث">
                <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="M21 21l-4.3-4.3"/></svg>
            </button>
        </form>
    </div>
</section>

<section class="fk-books" id="books-results-section" data-results-url="{{ route('site.books') }}">
    <div id="books-search-info">
        @if(request('search'))
            @include('site.partials._search-info', ['search' => request('search'), 'total' => $books->total(), 'unit' => 'نتيجة', 'clearUrl' => route('site.books')])
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
