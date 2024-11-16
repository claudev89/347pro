<?php

use Illuminate\Support\Facades\Route;
use App\Models\Categoria;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UrlsController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('productos', [ProductoController::class, 'index']);

Route::get('activar-suscripcion/{hash}', [\App\Http\Controllers\SuscripcionController::class, 'activarSuscripcion'])
    ->name('activar.suscripcion');

Route::get('carrito', function () { return view('carrito'); })->name('carrito');

Route::get('/{categoria}/{subcategoriaOProducto?}/{producto?}', [CategoriaController::class, 'show'])
    ->where('categoria', '[a-zA-Z0-9-_]+')
    ->where('subcategoriaOProducto', '[a-zA-Z0-9-_]*') // opcional
    ->where('producto', '[a-zA-Z0-9-_]*')
    ->name('categoria.producto');
