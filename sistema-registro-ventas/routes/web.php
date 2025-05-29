<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('usuarios', UserController::class)
        ->middleware('permission:ver usuarios');
    Route::resource('categorias', CategoriaController::class)
        ->middleware(['permission:crear categorias|listar categorias']);
    Route::resource('productos', ProductoController::class)
        ->middleware(['permission:crear productos|listar productos']);
    Route::resource('ventas', VentaController::class)
        ->middleware(['permission:crear ventas|ver ventas propias']);
});


require __DIR__.'/auth.php';
