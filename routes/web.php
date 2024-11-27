<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;

// Ruta pública (Home)
Route::get('/', function () {
    return view('welcome');
});

// Rutas para el login y el registro
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    // Ruta para el dashboard
    Route::get('/dashboard', [ProductoController::class, 'dashboard'])->name('dashboard');

    // Rutas de productos (se manejan automáticamente con resource)
    Route::resource('productos', ProductoController::class);
});
