<?php

namespace App\Http\Controllers\Admin\Translator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Translator\TranslatorRequest;
use App\Models\Translator;
use App\Services\Admin\Translator\TranslatorService;
use Illuminate\Http\Request;

class TranslatorController extends Controller
{
    public function __construct(
        private TranslatorService $translatorService
    ) {
    }

    public function index()
    {
        $data = $this->translatorService->index();

        // إحصائيات
        $data['total_translators'] = Translator::count();
        $data['active_translators'] = Translator::where('status', 1)->count();
        $data['inactive_translators'] = Translator::where('status', 0)->count();
        $data['translators_with_books'] = Translator::has('books')->count();

        return view('admin.translators.index', $data);
    }

    public function store(TranslatorRequest $request)
    {
        try {
            $translator = $this->translatorService->store($request->validated());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'تمت إضافة المترجم بنجاح.',
                    'translator' => $translator,
                    'row_html' => view('admin.translators._row', compact('translator'))->render(),
                ]);
            }

            return redirect()
                ->route('admin.translators.index')
                ->with('success', 'تمت إضافة المترجم بنجاح.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'حدث خطأ أثناء إضافة المترجم: ' . $e->getMessage()
                ], 500);
            }
            throw $e;
        }
    }

    public function update(TranslatorRequest $request, Translator $translator)
    {
        try {
            $translator = $this->translatorService->update($translator, $request->validated());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'تم تحديث بيانات المترجم بنجاح.',
                    'translator' => $translator,
                    'row_html' => view('admin.translators._row', compact('translator'))->render(),
                ]);
            }

            return redirect()
                ->route('admin.translators.index')
                ->with('success', 'تم تحديث بيانات المترجم بنجاح.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'حدث خطأ أثناء تحديث المترجم: ' . $e->getMessage()
                ], 500);
            }
            throw $e;
        }
    }

    public function destroy(Request $request, Translator $translator)
    {
        try {
            $this->translatorService->delete($translator);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'تم حذف المترجم بنجاح.',
                ]);
            }

            return redirect()
                ->route('admin.translators.index')
                ->with('success', 'تم حذف المترجم بنجاح.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'حدث خطأ أثناء حذف المترجم: ' . $e->getMessage()
                ], 500);
            }
            throw $e;
        }
    }

    public function filter(Request $request)
    {
        try {
            $translators = $this->translatorService->filter($request->all());

            return response()->json([
                'success' => true,
                'count' => $translators->total(),
                'rows_html' => view('admin.translators._rows', compact('translators'))->render(),
                // 'pagination' => $translators->links('admin.translators._pagination')->render(),
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
            'total_translators' => Translator::count(),
            'active_translators' => Translator::where('status', 1)->count(),
            'inactive_translators' => Translator::where('status', 0)->count(),
            'translators_with_books' => Translator::has('books')->count(),
        ]);
    }
}
