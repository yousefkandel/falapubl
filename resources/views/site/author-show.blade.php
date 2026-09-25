@extends('site.layout')

@section('title', $author->name_ar . ' — فَلَك للنشر')

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

    <div class="hero-content fk-profile-hero">
        <div class="fk-profile-avatar">
            <img src="{{ $author->avatar }}" alt="{{ $author->name_ar }}">
        </div>
        <div>
            <h1 style="font-size: clamp(24px,3.5vw,36px); margin-bottom: 6px;">{{ $author->name_ar }}</h1>
            <p style="opacity:.75; margin-bottom: 10px;">{{ $author->name_en }}</p>
            @if($author->bio_ar)
                <p style="max-width:560px; opacity:.9;">{{ $author->bio_ar }}</p>
            @endif
        </div>
    </div>
</section>

<section class="fk-books">
    <div style="max-width:1180px; margin: 0 auto 16px;">
        <h2 style="color: var(--gold-light); font-size: 20px;">كتب المؤلف</h2>
    </div>

    @forelse($books as $book)
        @include('site.partials.book-card', ['book' => $book])
    @empty
        <div class="fk-empty">لا توجد كتب منشورة لهذا المؤلف حالياً.</div>
    @endforelse

    <div class="fk-pagination">
        {{ $books->links() }}
    </div>
</section>

@endsection
