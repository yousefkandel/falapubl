<?php

namespace App\Http\Controllers\Admin\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Book\BookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Translator;
use App\Services\Admin\Book\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct(
        private BookService $bookService
    ) {
    }

    public function index()
    {
        $data = $this->bookService->index();
        $data['total_books'] = Book::count();
        $data['total_authors'] = Author::count();
        $data['total_translators'] = Translator::count();
        $data['active_books'] = Book::where('status', 1)->count();
        return view('admin.books.index', $data);
    }

    public function store(BookRequest $request)
    {
        $book = $this->bookService->store($request->validated());

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'  => true,
                'message'  => 'تمت إضافة الكتاب بنجاح.',
                'book'     => $book,
                'row_html' => view('admin.books._row', compact('book'))->render(),
            ]);
        }

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'تمت إضافة الكتاب بنجاح.');
    }

    public function update(BookRequest $request, Book $book)
    {
        $book = $this->bookService->update($book, $request->validated());

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success'  => true,
                'message'  => 'تم تحديث بيانات الكتاب بنجاح.',
                'book'     => $book,
                'row_html' => view('admin.books._row', compact('book'))->render(),
            ]);
        }

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'تم تحديث بيانات الكتاب بنجاح.');
    }

    public function destroy(Request $request, Book $book)
    {
        $this->bookService->destroy($book);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'تم حذف الكتاب بنجاح.',
                'id'      => $book->id,
            ]);
        }

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'تم حذف الكتاب بنجاح.');
    }

    public function filter(Request $request)
    {
        $books = $this->bookService->filter($request->all());

        return response()->json([
            'success'    => true,
            'count'      => $books->total(),
            'rows_html'  => view('admin.books._rows', compact('books'))->render(),
            // 'pagination' => (string) $books->links('books._pagination'),
        ]);
    }
}
