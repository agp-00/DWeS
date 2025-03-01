<?php

use App\Models\User;
use App\Models\Space;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SpaceController;
use App\Http\Controllers\Api\FilterController;
use App\Http\Controllers\Api\CommentController;

// Binding personalizado para "space" y "user"
Route::bind('space', function ($value) {
    return is_numeric($value)
        ? Space::findOrFail($value) // Busca por 'id'
        : Space::where('regNumber', $value)->firstOrFail(); // Busca por 'regNumber'
});

Route::bind('user', function ($value) {
    return is_numeric($value)
        ? User::findOrFail($value) // Busca por 'id'
        : User::where('email', $value)->firstOrFail(); // Busca por 'email'
});

// Ruta pública para obtener filtros
Route::get('/filters', [FilterController::class, 'getFilters']);

// Rutas públicas sin autenticación
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas con autenticación usando Sanctum
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/spaces/{space}/comments', [CommentController::class, 'store']);

    // Endpoints para manejar espacios
    Route::apiResource('/space', SpaceController::class)->only(['index','show','store', 'update']);

    // Endpoints para el usuario
    Route::apiResource('/user', UserController::class)->only(['show','update','destroy']);

    // Cierre de sesión
    Route::post('/logout', [AuthController::class, 'logout']);
})
;
