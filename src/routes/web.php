<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;

Route::get('/', [HomeController::class, 'inicio']);
Route::get('/Inicio', [HomeController::class, 'inicio']);

Route::get('/Productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/Productos/create', [ProductoController::class, 'create'])->name('productos.create');
Route::post('/Productos', [ProductoController::class, 'store'])->name('productos.store');
Route::get('/Productos/{producto}', [ProductoController::class, 'show'])->whereNumber('producto')->name('productos.show');
Route::get('/Productos/{producto}/edit', [ProductoController::class, 'edit'])->whereNumber('producto')->name('productos.edit');
Route::post('/Productos/{producto}', [ProductoController::class, 'update'])->whereNumber('producto')->name('productos.update');
Route::post('/Productos/{producto}/delete', [ProductoController::class, 'destroy'])->whereNumber('producto')->name('productos.destroy');

// CARRITO
Route::get('/carrito', [\App\Http\Controllers\CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/agregar/{producto}', [\App\Http\Controllers\CarritoController::class, 'agregar'])->whereNumber('producto')->name('carrito.agregar');
Route::post('/carrito/{carritoItem}/delete', [\App\Http\Controllers\CarritoController::class, 'destroy'])->whereNumber('carritoItem')->name('carrito.destroy');

// LOGIN
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

// LOGOUT
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
