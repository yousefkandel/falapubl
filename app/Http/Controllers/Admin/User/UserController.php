<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UserRequest;
use App\Models\User;
use App\Services\Admin\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService
    ) {
    }

    public function index()
    {
        $data = $this->userService->index();

        $data['total_users'] = User::count();
        $data['active_users'] = User::where('status', 1)->count();
        $data['inactive_users'] = User::where('status', 0)->count();

        return view('admin.users.index', $data);
    }

    public function store(UserRequest $request)
    {
        try {
            $user = $this->userService->store($request->validated());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'تمت إضافة المستخدم بنجاح.',
                    'user' => $user,
                    'row_html' => view('admin.users._row', compact('user'))->render(),
                ]);
            }

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'تمت إضافة المستخدم بنجاح.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'حدث خطأ أثناء إضافة المستخدم: ' . $e->getMessage(),
                ], 500);
            }
            throw $e;
        }
    }

    public function update(UserRequest $request, User $user)
    {
        try {
            $user = $this->userService->update($user, $request->validated());

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'تم تحديث بيانات المستخدم بنجاح.',
                    'user' => $user,
                    'row_html' => view('admin.users._row', compact('user'))->render(),
                ]);
            }

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'تم تحديث بيانات المستخدم بنجاح.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'حدث خطأ أثناء تحديث المستخدم: ' . $e->getMessage(),
                ], 500);
            }
            throw $e;
        }
    }

    public function destroy(Request $request, User $user)
    {
        try {
            if ($user->id === auth()->id()) {
                throw new \Exception('لا يمكنك حذف حسابك الحالي.');
            }

            $this->userService->delete($user);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'تم حذف المستخدم بنجاح.',
                ]);
            }

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'تم حذف المستخدم بنجاح.');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                ], 500);
            }
            throw $e;
        }
    }

    public function filter(Request $request)
    {
        try {
            $users = $this->userService->filter($request->all());

            return response()->json([
                'success' => true,
                'count' => $users->total(),
                'rows_html' => view('admin.users._rows', compact('users'))->render(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء تصفية البيانات: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function stats()
    {
        return response()->json([
            'total_users' => User::count(),
            'active_users' => User::where('status', 1)->count(),
            'inactive_users' => User::where('status', 0)->count(),
        ]);
    }
}
