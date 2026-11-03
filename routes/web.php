
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\StockController;

// Inventory
Route::get('/inventory', function () {
    return 'Inventory System';
});

// Products
Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('/products/low-stock', [ProductController::class, 'lowStock'])
    ->name('products.low-stock');

Route::get('/products/create', [ProductController::class, 'create'])
    ->name('products.create');

Route::post('/products', [ProductController::class, 'store'])
    ->name('products.store');

Route::get('/products/{id}', [ProductController::class, 'show'])
    ->name('products.show');

// Test layout
Route::get('/test-layout', function () {
    return view('layouts.app');
});

// Suppliers
Route::get('/suppliers', [SuppliersController::class, 'index'])
    ->name('suppliers.index');

Route::get('/suppliers/create', [SuppliersController::class, 'create'])
    ->name('suppliers.create');

Route::post('/suppliers', [SuppliersController::class, 'store'])
    ->name('suppliers.store');

Route::get('/suppliers/{id}', [SuppliersController::class, 'show'])
    ->name('suppliers.show');

// Categories
Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories.index');

// Stock Summary
Route::get('/stock-summary', [StockController::class, 'summary'])
    ->name('stock.summary');
