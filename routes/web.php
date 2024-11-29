<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\ClienteController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas públicas
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ProductoController::class, 'dashboard'])->name('dashboard');
    Route::get('/inventario', [ProductoController::class, 'inventario'])->name('inventario')->middleware('auth');
    Route::resource('ventas', VentaController::class)->only(['index', 'create', 'store']);
    Route::view('/welcome', 'welcome')->name('welcome'); // Ruta para welcome
    Route::resource('productos', ProductoController::class);
    Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
// Rutas para los controladores recién creados
Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::get('/configuracion', [ConfiguracionController::class, 'index'])->name('configuracion');

Route::resource('roles', ConfiguracionController::class);
Route::put('roles/{user}', [ConfiguracionController::class, 'updateRole'])->name('roles.update');
Route::get('roles/{user}', [ConfiguracionController::class, 'showRoles'])->name('roles.show');

Route::resource('clientes', ClienteController::class);
Route::get('/reportes/inventario', [ReporteController::class, 'inventarioReporte'])->name('reportes.inventario');

// Reportes
Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
Route::get('/reportes/inventario', [ReporteController::class, 'inventarioReporte'])->name('reportes.inventario');
Route::get('/reportes/clientes', [ReporteController::class, 'clientesReporte'])->name('reportes.clientes');

});
