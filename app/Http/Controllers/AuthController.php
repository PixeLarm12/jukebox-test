<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Repositories\AuthRepository;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(AuthRequest $request): JsonResponse
    {
        return response()->json($this->authRepository->auth($request));
    }

    public function logout(): JsonResponse
    {
        return response()->json($this->authRepository->logout());
    }

    public function getUser(): JsonResponse
    {
        return response()->json($this->authRepository->getUser());
    }
}
