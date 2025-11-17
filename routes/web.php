<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Renomeamos todas as rotas para evitar conflito com a API
Route::get('/', [ProductController::class, 'showWeb'])->name('web.products.index');
Route::get('/create', [ProductController::class, 'createWeb'])->name('web.products.create');
Route::post('/store', [ProductController::class, 'storeWeb'])->name('web.products.store');
Route::get('/{product}/edit', [ProductController::class, 'editWeb'])->name('web.products.edit');
Route::put('/{product}', [ProductController::class, 'updateWeb'])->name('web.products.update');
Route::delete('/{product}', [ProductController::class, 'destroyWeb'])->name('web.products.destroy');