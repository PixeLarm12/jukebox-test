<?php

namespace App\Repositories;

use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthRepository
{
    public function auth(AuthRequest $request): array
    {
        if($request->validated())
        {
            $token = Auth::attempt($request->getData());

            if(!$token) {
                return ["error" => "Unauthorized"];
            }

            return [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ];
        }
    }

    public function logout()
    {
        auth()->logout();
    }

    public function getUser()
    {
        return auth()->user();
    }
}
