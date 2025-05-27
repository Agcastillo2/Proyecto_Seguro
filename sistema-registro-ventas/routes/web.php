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

// Grupo con middleware auth para profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas protegidas por permisos
Route::middleware(['auth'])->group(function () {
    
    // Usuarios
    Route::resource('usuarios', UserController::class)
        ->middleware('permission:ver usuarios');

    // Categorías
    Route::resource('categorias', CategoriaController::class)
        ->middleware(['permission:crear categorias|listar categorias']);

    // Productos
    Route::resource('productos', ProductoController::class)
        ->middleware(['permission:crear productos|listar productos']);

    // Ventas
    Route::resource('ventas', VentaController::class)
        ->middleware(['permission:crear ventas|ver ventas propias']);
});


require __DIR__.'/auth.php';
