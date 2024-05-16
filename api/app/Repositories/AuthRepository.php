<?php

namespace App\Repositories;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthRepository
{
    public function auth(AuthRequest $request): bool
    {
        if($request->validated())
        {
            return Auth::attempt($request->getData(), true);
        }
    }

    public function logout()
    {
        Auth::logout();
    }

    public function getUser()
    {
        return Auth::user();
    }
}
