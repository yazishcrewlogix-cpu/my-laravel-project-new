<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Load auth routes (Breeze or custom)
require __DIR__.'/auth.php';

// Home route
Route::get('/', function () {
    return redirect()->route('products.index');
});

// Authenticated product routes
Route::middleware(['auth'])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products/{product}/delete', [ProductController::class, 'destroy'])->name('products.destroy');
});
