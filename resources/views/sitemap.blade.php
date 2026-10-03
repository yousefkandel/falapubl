<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<!-- hash -->
    {{-- الصفحة الرئيسية --}}
    <url>
        <loc>{{ url('/') }}</loc>
    </url>

    {{-- الكتب --}}
    @foreach ($books as $book)
        <url>
            <loc>{{ route('site.books.show', $book) }}</loc>
            @if($book->updated_at)
                <lastmod>{{ $book->updated_at->toAtomString() }}</lastmod>
            @endif
        </url>
    @endforeach

    {{-- المؤلفون --}}
    @foreach ($authors as $author)
        <url>
            <loc>{{ route('site.authors.show', $author) }}</loc>
            @if($author->updated_at)
                <lastmod>{{ $author->updated_at->toAtomString() }}</lastmod>
            @endif
        </url>
    @endforeach

    {{-- المترجمون --}}
    @foreach ($translators as $translator)
        <url>
            <loc>{{ route('site.translators.show', $translator) }}</loc>
            @if($translator->updated_at)
                <lastmod>{{ $translator->updated_at->toAtomString() }}</lastmod>
            @endif
        </url>
    @endforeach

    {{-- الصفحات الثابتة --}}
    <url>
        <loc>{{ url('/books') }}</loc>
    </url>

    <url>
        <loc>{{ url('/authors') }}</loc>
    </url>

    <url>
        <loc>{{ url('/translators') }}</loc>
    </url>

    <url>
        <loc>{{ url('/about') }}</loc>
    </url>

    <url>
        <loc>{{ url('/contact') }}</loc>
    </url>

</urlset>