<?php

namespace App\Http\Controllers\Admin\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Author\AuthorRequest;
use App\Models\Author;
use App\Services\Admin\Author\AuthorService;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function __construct(
        private AuthorService $authorService
    ) {
    }

    public function index()
    {
        $data = $this->authorService->index();

        // إحصائيات
        $data['total_authors'] = Author::count();
        $data['active_authors'] = Author::where('status', 1)->count();
        $data['inactive_authors'] = Author::where('status', 0)->count();
        $data['authors_with_books'] = Author::has('books')->count();

        return view('admin.authors.index', $data);
    }

    public function store(AuthorRequest $request)
    {
        try {
            $author = $this->authorService->store($request->validated());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'تمت إضافة المؤلف بنجاح.',
                    'author' => $author,
                    'row_html' => view('admin.authors._row', compact('author'))->render(),
                ]);
            }

            return redirect()
                ->route('admin.authors.index')
                ->with('success', 'تمت إضافة المؤلف بنجاح.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'حدث خطأ أثناء إضافة المؤلف: ' . $e->getMessage()
                ], 500);
            }
            throw $e;
        }
    }

    public function update(AuthorRequest $request, Author $author)
    {
        try {
            $author = $this->authorService->update($author, $request->validated());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'تم تحديث بيانات المؤلف بنجاح.',
                    'author' => $author,
                    'row_html' => view('admin.authors._row', compact('author'))->render(),
                ]);
            }

            return redirect()
                ->route('admin.authors.index')
                ->with('success', 'تم تحديث بيانات المؤلف بنجاح.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'حدث خطأ أثناء تحديث المؤلف: ' . $e->getMessage()
                ], 500);
            }
            throw $e;
        }
    }

    public function destroy(Request $request, Author $author)
    {
        try {
            $this->authorService->delete($author);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'تم حذف المؤلف بنجاح.',
                ]);
            }

            return redirect()
                ->route('admin.authors.index')
                ->with('success', 'تم حذف المؤلف بنجاح.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'حدث خطأ أثناء حذف المؤلف: ' . $e->getMessage()
                ], 500);
            }
            throw $e;
        }
    }

    public function filter(Request $request)
    {
        try {
            $authors = $this->authorService->filter($request->all());

            return response()->json([
                'success' => true,
                'count' => $authors->total(),
                'rows_html' => view('admin.authors._rows', compact('authors'))->render(),
                // 'pagination' => $authors->links('admin.authors._pagination')->render(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تصفية البيانات: ' . $e->getMessage()
            ], 500);
        }
    }

    // API للحصول على الإحصائيات
    public function stats()
    {
        return response()->json([
            'total_authors' => Author::count(),
            'active_authors' => Author::where('status', 1)->count(),
            'inactive_authors' => Author::where('status', 0)->count(),
            'authors_with_books' => Author::has('books')->count(),
        ]);
    }
}
