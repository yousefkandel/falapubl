@extends('site.layout')

@section('title', 'فَلَك — نسير في فلك الكتب')

@section('content')

<section class="hero-cosmic">
    <div class="hero-glow g1"></div>
    <div class="hero-glow g2"></div>

    @include('site.partials.orbit-field')

    <div class="hero-mist">
        <div class="m m1"></div>
        <div class="m m2"></div>
        <div class="m m3"></div>
    </div>

    <div class="hero-content">
        <h1>نَسِيرُ فِي فَلَكِ الْكُتُبِ، حَيْثُ لَا نِهَايَةَ لِلشَّغَفِ</h1>
        <p>فلك تُصدر وتترجم الكتب بين العربية والإنجليزية — كل كتاب هنا كون صغير، وكل قارئ يستحق خريطة واضحة فيه.</p>
        <div class="hero-ctas">
            <a href="{{ route('site.books') }}" class="btn-primary">تصفّح الكتب</a>
            <a href="{{ route('site.about') }}" class="btn-outline-dark">قصة فلك</a>
        </div>
    </div>
</section>

<section class="fk-books">
    @forelse($books as $book)
        @include('site.partials.book-card', ['book' => $book])
    @empty
        <div style="text-align:center; color: rgba(248,245,240,.6); padding: 60px 20px;">
            لا توجد كتب منشورة حالياً — تابعونا قريبًا.
        </div>
    @endforelse
</section>

@endsection
