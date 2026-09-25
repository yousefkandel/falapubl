<?php
namespace App\Services\Admin\Auth;

use App\Contracts\Auth\AuthRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function __construct(private AuthRepositoryInterface $authRepository)
    {
    }
    public function login(array $data)
    {
        $user= $this->authRepository->findEmail($data['email']);
        if (!$user || ! Hash::check($data['password'],$user->password)) {
                throw ValidationException::withMessages([
                'email' => ['Invalid credentials.'],
            ]);
        }

        if (! $user->status) {
            throw ValidationException::withMessages([
                'email' => ['هذا الحساب معطّل. يرجى التواصل مع مدير النظام.'],
            ]);
        }

        Auth::login($user);

    }

    public function logout(): void
    {
        Auth::logout();
    }
}
