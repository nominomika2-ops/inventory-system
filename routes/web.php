
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SuppliersController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/inventory', function () {
    return 'Inventory System';
});

Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('/products/{id}', [ProductController::class, 'show'])
    ->name('products.show');

Route::get('/test-layout', function () {
    return view('layouts.app');
});

Route::get('/suppliers', [SuppliersController::class, 'index'])
    ->name('suppliers.index');

Route::get('/suppliers/{id}', [SuppliersController::class, 'show'])
    ->name('suppliers.show');

