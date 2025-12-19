<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'inicio']);
Route::get('/Inicio', [HomeController::class, 'inicio']);

// Mantener URLs como en CodeIgniter (capitalizadas)
Route::get('/Productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/Productos/{producto}', [ProductoController::class, 'show'])->whereNumber('producto')->name('productos.show');
Route::get('/Productos/{producto}/edit', [ProductoController::class, 'edit'])->whereNumber('producto')->name('productos.edit');

// Si vas a usar formularios POST como en CI:
Route::post('/Productos/{producto}/update', [ProductoController::class, 'update'])->whereNumber('producto')->name('productos.update.post');
Route::post('/Productos/{producto}/delete', [ProductoController::class, 'destroy'])->whereNumber('producto')->name('productos.delete.post');