
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\LogVisit;


// Login routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});


// Protected routes with LogVisit middleware
Route::middleware(['auth', LogVisit::class])->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    Route::get('/products/low-stock', [ProductController::class, 'lowStock'])->name('products.low-stock');

    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

    Route::post('/products', [ProductController::class, 'store'])->name('products.store');

    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');


    // Categories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');


    // Suppliers
    Route::get('/suppliers', [SuppliersController::class, 'index'])->name('suppliers.index');

    Route::get('/suppliers/{id}', [SuppliersController::class, 'show'])->name('suppliers.show');


    // Stock Summary
    Route::get('/stock-summary', [StockController::class, 'summary'])->name('stock.summary');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});