<?php

use App\Models\User;
use App\Models\Space;
use App\Models\SpaceType;
use App\Models\Service;
use App\Models\Modality;
use App\Models\Island; // Asegúrate de que este modelo esté definido si es necesario
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SpaceController;

// Noves rutes
Route::bind('space', function ($value) {
    return is_numeric($value)
        ? Space::findOrFail($value) // Cerca pel camp 'id'
        : Space::where('regNumber', $value)->firstOrFail(); // Cerca pel camp 'regNumber'
});
Route::bind('user', function ($value) {
    return is_numeric($value)
        ? User::findOrFail($value) // Cerca pel camp 'id'
        : User::where('email', $value)->firstOrFail(); // Cerca pel camp 'email'
});

// Rutes sense autenticació
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['multi_auth'])->group(function () {
    // Ruta para obtener los tipos de espacio
    Route::get('/space_types', function () {
        // Devuelve todos los tipos de espacio
        return SpaceType::all()->pluck('name');
    });

    // Ruta para obtener las islas (si tienes el modelo Island)
    Route::get('/islas', function () {
        // Suponiendo que tienes un modelo Island
        return Island::all()->pluck('name');
    });

    // Ruta para obtener las modalidades (si tienes el modelo Modality)
    Route::get('/modalidades', function () {
        // Suponiendo que tienes un modelo Modality
        return Modality::all()->pluck('name');
    });

    // Ruta para obtener los servicios (si tienes el modelo Service)
    Route::get('/servicios', function () {
        // Suponiendo que tienes un modelo Service
        return Service::all()->pluck('name');
    });

    // Rutas para el espacio
    Route::apiresource('/space', SpaceController::class)->only(['index', 'show', 'store']);

    // Rutas para el usuario
    Route::apiresource('/user', UserController::class)->only(['show', 'update', 'destroy']);

    // Ruta para cerrar sesión
    Route::post('/logout', [AuthController::class, 'logout']);
});
