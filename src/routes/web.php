<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'inicio']);
Route::get('/Inicio', [HomeController::class, 'inicio']);

Route::get('/Productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/Productos/create', [ProductoController::class, 'create'])->name('productos.create');
Route::post('/Productos', [ProductoController::class, 'store'])->name('productos.store');
Route::get('/Productos/{producto}', [ProductoController::class, 'show'])->whereNumber('producto')->name('productos.show');
Route::get('/Productos/{producto}/edit', [ProductoController::class, 'edit'])->whereNumber('producto')->name('productos.edit');
Route::post('/Productos/{producto}', [ProductoController::class, 'update'])->whereNumber('producto')->name('productos.update');
Route::post('/Productos/{producto}/delete', [ProductoController::class, 'destroy'])->whereNumber('producto')->name('productos.destroy');
