<?php
namespace App\Contracts\Auth;

interface AuthRepositoryInterface{
    public function findEmail(string $email);
    
}
