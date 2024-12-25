<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SpaceController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::middleware(['auth:sanctum'])->get('users', function (Request $request) {
    return $request->user();
});

Route::post('register', [RegisteredUserController::class, 'store']);

Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
});




Route::get('users', [UserController::class, 'index']);

Route::put('users/{identifier}', [UserController::class, 'update']);

Route::delete('users/{email}', [UserController::class, 'destroy']);

Route::get('users/{email}', [UserController::class, 'show']);



Route::post('spaces/{RegNumber}', [SpaceController::class, 'store']);

Route::get('spaces', [SpaceController::class, 'index']);

//Route::get('spaces/{illa}', [SpaceController::class, 'index']);

Route::get('spaces/{identifier}', [SpaceController::class, 'show']);

