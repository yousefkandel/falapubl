<?php

namespace App\Repositories\Auth;

use App\Contracts\Auth\AuthRepositoryInterface;
use App\Models\User;

class AuthRepository implements AuthRepositoryInterface{
    public function findEmail(string $email){
      return  User::where('email',$email)->first();
    }
}
