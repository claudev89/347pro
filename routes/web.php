<?php

use Illuminate\Support\Facades\Route;
use App\Models\Categoria;
use App\Http\Controllers\CategoriaController;

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

Route::get('/{categoria}/{subcategoria}', [CategoriaController::class, 'show'])->name('categoria.show');
Route::get('/{categoria}/', [CategoriaController::class, 'show'])->name('categoria.show');
