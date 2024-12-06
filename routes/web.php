<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmpleadoController;


// Redirección a login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas públicas (Autenticación)
Route::prefix('auth')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {

    // Dashboard y vistas principales
    Route::get('/dashboard', [ProductoController::class, 'dashboard'])->name('dashboard');
    Route::get('/welcome', fn() => view('welcome'))->name('welcome');

    // Rutas para productos e inventario
    Route::get('/inventario', [ProductoController::class, 'inventario'])->name('inventario');
    Route::resource('productos', ProductoController::class);
    Route::post('/productos/deleteAll', [ProductoController::class, 'deleteAll'])->name('productos.deleteAll');


    // Rutas para ventas
    Route::resource('ventas', VentaController::class)->only(['index', 'create', 'store']);

    // Rutas para clientes
    Route::resource('clientes', ClienteController::class);

     // Ruta para gestionar usuarios (ver todos los usuarios)
     Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
 
     // Ruta para eliminar un usuario
     Route::delete('/usuarios/{user}', [UserController::class, 'destroy'])->name('usuarios.destroy');

    // Rutas para reportes
    Route::prefix('reportes')->group(function () {
        Route::get('/', [ReporteController::class, 'index'])->name('reportes.index');
        Route::get('/inventario', [ReporteController::class, 'inventarioReporte'])->name('reportes.inventario');
        Route::get('/clientes', [ReporteController::class, 'clientesReporte'])->name('reportes.clientes');
        Route::get('/reabastecimiento', [ReporteController::class, 'sugerenciaReabastecimiento'])->name('reportes.reabastecimiento');
        Route::get('/productos-mas-vendidos', [ReporteController::class, 'productosMasVendidos'])->name('reportes.productosMasVendidos');
        Route::get('/rentabilidad', [ReporteController::class, 'analisisRentabilidad'])->name('reportes.rentabilidad');
        Route::get('/comparacion-ventas', [ReporteController::class, 'comparacionVentas'])->name('reportes.comparacionVentas');
        Route::get('/total-gastado', [ReporteController::class, 'totalGastadoPorCliente'])->name('reportes.clientesGastado');
    });
     // Ruta para gestion de empleados
    Route::resource('empleados', EmpleadoController::class);

});
