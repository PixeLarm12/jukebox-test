<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Repositories\AuthRepository;

class AuthController extends Controller
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(AuthRequest $request)
    {
        return response()->json($this->authRepository->auth($request));
    }

    public function logout()
    {
        return response()->json($this->authRepository->logout());
    }
}
