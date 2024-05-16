<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware("auth")->group(function () {
    Route::apiResource("/tasks", TaskController::class);
    Route::get("/tasks/{task}", TaskController::class . "@show");
})->name("task.");

Route::post("/login", AuthController::class . "@login")->name("auth.login");
Route::get("/logout", AuthController::class . "@logout")->name("auth.logout");
Route::get("/get-user", AuthController::class . "@getUser")->name("auth.getUser");
