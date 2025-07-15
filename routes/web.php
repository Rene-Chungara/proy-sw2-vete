<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\TipoPagoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\NotaEntradaController;
use App\Http\Controllers\NotaSalidaController;
use App\Http\Controllers\NotaVentaController;
use App\Http\Controllers\PrediccionController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::post('/logout', function() {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login'); 
})->name('logout');

Route::resource('users', UserController::class)->middleware('auth');
Route::resource('roles', RoleController::class)->middleware('auth');
Route::resource('empleados', EmpleadoController::class)->middleware('auth');
Route::resource('almacenes', AlmacenController::class)->middleware('auth')->parameters([
    'almacenes' => 'almacen'
]);
Route::resource('categorias', CategoriaController::class)->middleware('auth');
Route::resource('proveedores', ProveedorController::class)->middleware('auth')->parameters([
    'proveedores' => 'proveedor'
]);
Route::resource('clientes', ClienteController::class)->middleware('auth')->parameters([
    'clientes' => 'cliente'
]);
Route::resource('tipo_pagos', TipoPagoController::class)->middleware('auth')->parameters([
    'tipo_pagos' => 'tipo_pago'
]);
Route::resource('productos', ProductoController::class)->middleware('auth');
Route::resource('nota_entradas', NotaEntradaController::class)->middleware('auth')->parameters([
    'nota_entradas' => 'nota_entrada'
]);
Route::resource('nota_salidas', NotaSalidaController::class)->middleware('auth')->parameters([
    'nota_salidas' => 'nota_salida'
]);
Route::resource('nota_ventas', NotaVentaController::class)->middleware('auth')->parameters([
    'nota_ventas' => 'nota_venta'
]);
Route::get('dashboard/reporte', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.reporte');
Route::get('/bi-dashboard', [App\Http\Controllers\BiDashboardController::class, 'index'])->name('bi.dashboard');
Route::post('/bi/actualizar', [\App\Http\Controllers\BiDashboardController::class, 'actualizar'])->name('bi.actualizar');

Route::get('/bi/prediccion/{id}', [PrediccionController::class, 'mostrarPrediccion'])->name('bi.prediccion');
Route::get('/bi/select', [PrediccionController::class, 'seleccionarProducto'])->name('bi.select');
Route::view('/terminos-y-condiciones', 'legal.terminos')->name('terms.show');
Route::get('/bi/recomendacion-compra/{id}', [PrediccionController::class, 'mostrarRecomendacionCompra'])->name('bi.recomendacion');
Route::get('/bi/sugerencias-precio', [PrediccionController::class, 'mostrarSugerenciasPrecio'])->name('bi.precio.producto');


require __DIR__.'/auth.php';
