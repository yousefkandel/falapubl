@extends('site.layout')

@section('title', $translator->name_ar . ' — فَلَك للنشر')

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
            <img src="{{ $translator->avatar }}" alt="{{ $translator->name_ar }}">
        </div>
        <div>
            <h1 style="font-size: clamp(24px,3.5vw,36px); margin-bottom: 6px;">{{ $translator->name_ar }}</h1>
            <p style="opacity:.75; margin-bottom: 10px;">{{ $translator->name_en }}</p>
            @if($translator->bio_ar)
                <p style="max-width:560px; opacity:.9;">{{ $translator->bio_ar }}</p>
            @endif
        </div>
    </div>
</section>

<section class="fk-books">
    <div style="max-width:1180px; margin: 0 auto 16px;">
        <h2 style="color: var(--gold-light); font-size: 20px;">الكتب التي ترجمها</h2>
    </div>

    @forelse($books as $book)
        @include('site.partials.book-card', ['book' => $book])
    @empty
        <div class="fk-empty">لا توجد كتب مترجمة بواسطة هذا المترجم حالياً.</div>
    @endforelse

    <div class="fk-pagination">
        {{ $books->links() }}
    </div>
</section>

@endsection
