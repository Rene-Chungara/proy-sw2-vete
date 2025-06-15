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

Route::view('dashboard', 'dashboard')
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


require __DIR__.'/auth.php';
