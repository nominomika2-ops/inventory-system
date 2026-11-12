
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;

use App\Http\Middleware\LogVisit;
use App\Http\Middleware\EnsureUserIsAdmin;


// Home Route
Route::get('/', function () {
    return redirect()->route('login');
})->name('home');


// Login Routes
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.attempt');

});


// Protected Routes
Route::middleware(['auth', LogVisit::class])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');


    // Products - View
    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');

    Route::get('/products/low-stock', [ProductController::class, 'lowStock'])
        ->name('products.low-stock');


    // Stock In and Stock Out
    // Both Admin and Staff can access
    Route::post('/products/{id}/stock', [StockController::class, 'adjust'])
        ->name('products.stock');


    // Reports
    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');

    Route::get('/reports/stock-value', [ReportController::class, 'stockValue'])
        ->name('reports.stock-value');

    Route::get('/reports/movements', [ReportController::class, 'movements'])
        ->name('reports.movements');

    Route::get('/reports/top-products', [ReportController::class, 'topProducts'])
        ->name('reports.top-products');


    // Admin Only Routes
    Route::middleware(EnsureUserIsAdmin::class)->group(function () {

        // Product Create
        Route::get('/products/create', [ProductController::class, 'create'])
            ->name('products.create');

        // Product Store
        Route::post('/products', [ProductController::class, 'store'])
            ->name('products.store');

        // Product Edit
        Route::get('/products/{id}/edit', [ProductController::class, 'edit'])
            ->name('products.edit');

        // Product Update
        Route::put('/products/{id}', [ProductController::class, 'update'])
            ->name('products.update');

        // Product Delete
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])
            ->name('products.destroy');


        // Category Create, Store, Edit, Update, Delete
        Route::resource('categories', CategoryController::class)
            ->except(['index', 'show']);


        // User Management
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


    // Categories List
    Route::resource('categories', CategoryController::class)
        ->only(['index']);


    // Suppliers List
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
