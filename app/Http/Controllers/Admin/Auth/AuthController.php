<?php
namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Services\Admin\Auth\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller{
public function __construct(private AuthService $authService)
{
}
    public function index()
    {
        return view('admin.auth.login');
    }

public function login(LoginRequest $request)
{
    $this->authService->login($request->validated());

    $request->session()->regenerate();

    return redirect()->route('admin.dashboard');
}

public function logout(Request $request)
{
    $this->authService->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('admin.login.index');
}
}
