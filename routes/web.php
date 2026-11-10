
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

use App\Http\Middleware\LogVisit;
use App\Http\Middleware\EnsureUserIsAdmin;


// Home route
Route::get('/', function () {
    return redirect()->route('login');
});


// Login routes
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.attempt');

});


// Protected routes
Route::middleware(['auth', LogVisit::class])->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');


    // Products - All authenticated users
    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');

    Route::get('/products/low-stock', [ProductController::class, 'lowStock'])
        ->name('products.low-stock');


    // Stock In and Stock Out - Admin and Staff
    Route::post('/products/{id}/stock', [StockController::class, 'adjust'])
        ->name('products.stock');


    // Admin-only routes
    Route::middleware(EnsureUserIsAdmin::class)->group(function () {

        // Product Create and Store
        Route::get('/products/create', [ProductController::class, 'create'])
            ->name('products.create');

        Route::post('/products', [ProductController::class, 'store'])
            ->name('products.store');


        // Product Edit, Update and Delete
        Route::get('/products/{id}/edit', [ProductController::class, 'edit'])
            ->name('products.edit');

        Route::put('/products/{id}', [ProductController::class, 'update'])
            ->name('products.update');

        Route::delete('/products/{id}', [ProductController::class, 'destroy'])
            ->name('products.destroy');


        // Category Admin Routes
        Route::resource('categories', CategoryController::class)
            ->except(['index', 'show']);


        // User Admin Routes
        Route::get('/users', [UserController::class, 'index'])
            ->name('users.index');

        Route::get('/users/create', [UserController::class, 'create'])
            ->name('users.create');

        Route::post('/users', [UserController::class, 'store'])
            ->name('users.store');


        // Supplier Create and Store
        Route::get('/suppliers/create', [SuppliersController::class, 'create'])
            ->name('suppliers.create');

        Route::post('/suppliers', [SuppliersController::class, 'store'])
            ->name('suppliers.store');

    });


    // Product Details
    Route::get('/products/{id}', [ProductController::class, 'show'])
        ->name('products.show');


    // Categories - All authenticated users can view
    Route::resource('categories', CategoryController::class)
        ->only(['index']);


    // Suppliers - All authenticated users can view
    Route::get('/suppliers', [SuppliersController::class, 'index'])
        ->name('suppliers.index');

    Route::get('/suppliers/{id}', [SuppliersController::class, 'show'])
        ->name('suppliers.show');


    // Stock Summary
    Route::get('/stock-summary', [StockController::class, 'summary'])
        ->name('stock.summary');


    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile');


    // Password Change
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])
        ->name('profile.password');

    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password.update');

});
