<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Page;
use App\Models\Translator;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home()
    {
        $books = Book::with(['author', 'translator'])
            ->where('status', 1)
            ->latest()
            ->take(6)
            ->get();

        return view('site.home', compact('books'));
    }

    public function books(Request $request)
    {
        $books = Book::with(['author', 'translator'])
            ->where('status', 1)
            ->search($request->get('search'))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'results_html'    => view('site.partials.books-results', compact('books'))->render(),
                'pagination_html' => (string) $books->links(),
                'info_html'       => $request->filled('search')
                    ? view('site.partials._search-info', [
                        'search'  => $request->get('search'),
                        'total'   => $books->total(),
                        'unit'    => __('messages.results'),
                        'clearUrl' => route('site.books'),
                    ])->render()
                    : '',
                'count' => $books->total(),
            ]);
        }

        return view('site.books', compact('books'));
    }

    public function show(Book $book)
    {
        abort_unless($book->status, 404);

        $book->load(['author', 'translator']);

        $related = Book::where('status', 1)
            ->where('id', '!=', $book->id)
            ->latest()
            ->take(3)
            ->get();

        return view('site.show', compact('book', 'related'));
    }

    /* ===== المؤلفون ===== */
    public function authors(Request $request)
    {
        $authors = Author::where('status', 1)
            ->search($request->get('search'))
            ->withCount(['books' => fn ($q) => $q->where('status', 1)])
            ->orderBy('name_ar')
            ->paginate(12)
            ->withQueryString();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'results_html'    => view('site.partials.authors-results', compact('authors'))->render(),
                'pagination_html' => (string) $authors->links(),
                'info_html'       => $request->filled('search')
                    ? view('site.partials._search-info', [
                        'search'  => $request->get('search'),
                        'total'   => $authors->total(),
                        'unit'    => __('messages.results'),
                        'clearUrl' => route('site.authors'),
                    ])->render()
                    : '',
                'count' => $authors->total(),
            ]);
        }

        return view('site.authors', compact('authors'));
    }

    public function authorShow(Author $author)
    {
        abort_unless($author->status, 404);

        $books = Book::with(['author', 'translator'])
            ->where('author_id', $author->id)
            ->where('status', 1)
            ->latest()
            ->paginate(9);

        return view('site.author-show', compact('author', 'books'));
    }

    /* ===== المترجمون ===== */
    public function translators(Request $request)
    {
        $translators = Translator::where('status', 1)
            ->search($request->get('search'))
            ->withCount(['books' => fn ($q) => $q->where('status', 1)])
            ->orderBy('name_ar')
            ->paginate(12)
            ->withQueryString();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'results_html'    => view('site.partials.translators-results', compact('translators'))->render(),
                'pagination_html' => (string) $translators->links(),
                'info_html'       => $request->filled('search')
                    ? view('site.partials._search-info', [
                        'search'  => $request->get('search'),
                        'total'   => $translators->total(),
                        'unit'    => __('messages.results'),
                        'clearUrl' => route('site.translators'),
                    ])->render()
                    : '',
                'count' => $translators->total(),
            ]);
        }

        return view('site.translators', compact('translators'));
    }

    public function translatorShow(Translator $translator)
    {
        abort_unless($translator->status, 404);

        $books = Book::with(['author', 'translator'])
            ->where('translator_id', $translator->id)
            ->where('status', 1)
            ->latest()
            ->paginate(9);

        return view('site.translator-show', compact('translator', 'books'));
    }

    /* ===== من نحن ===== */
    public function about()
    {
        $page = Page::findBySlug('about');

        return view('site.about', compact('page'));
    }

    /* ===== تواصل معنا ===== */
    public function contact()
    {
        $page = Page::findBySlug('contact');

        return view('site.contact', compact('page'));
    }

    public function contactSubmit(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:120',
            'email'   => 'required|email|max:180',
            'subject' => 'nullable|string|max:200',
            'message' => 'required|string|max:3000',
        ], [
            'name.required'    => __('messages.name_required'),
            'name.string'      => __('messages.name_invalid'),
            'name.max'         => __('messages.name_max'),
            'email.required'   => __('messages.email_required'),
            'email.string'     => __('messages.email_field_invalid'),
            'email.email'      => __('messages.email_invalid'),
            'email.max'        => __('messages.email_max'),
            'subject.string'   => __('messages.subject_invalid'),
            'subject.max'      => __('messages.subject_max'),
            'message.required' => __('messages.message_required'),
            'message.string'   => __('messages.message_invalid'),
            'message.max'      => __('messages.message_max'),
        ]);

        \App\Models\ContactMessage::create($data);

        return back()->with('success', __('messages.contact_success'));
    }
}
