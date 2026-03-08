<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/**
 * Public Routes
 */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/about', 'about')->name('about');

// Products (Public)
Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index')->name('products.index');
    Route::get('/products/{id}', 'show')->name('products.show');
});

// Contact
Route::controller(ContactController::class)->group(function () {
    Route::get('/contact', 'index')->name('contact');
    Route::post('/contact', 'store')->name('contact.store');
});

// Cart (Session-based, no auth required)
Route::prefix('cart')->name('cart.')->controller(CartController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/add', 'add')->name('add');
    Route::post('/update', 'update')->name('update');
    Route::post('/remove', 'remove')->name('remove');
    Route::post('/clear', 'clear')->name('clear');
});

/**
 * Authenticated Routes
 */
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => redirect()->route('home'))->name('dashboard');

    // Admin routes
    Route::middleware(\App\Http\Middleware\AdminMiddleware::class)->prefix('admin')->name('admin.')->controller(App\Http\Controllers\AdminController::class)->group(function () {
        Route::get('/', 'dashboard')->name('dashboard');
        Route::get('/products', 'products')->name('products');
        Route::get('/contacts', 'contacts')->name('contacts');
    });

    // Products (Admin/Auth)
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products/create', 'create')->name('products.create');
        Route::post('/products', 'store')->name('products.store');
        Route::get('/products/{id}/edit', 'edit')->name('products.edit');
        Route::put('/products/{id}', 'update')->name('products.update');
        Route::delete('/products/{id}', 'destroy')->name('products.destroy');
    });

    // Checkout & Orders
    Route::controller(CheckoutController::class)->group(function () {
        Route::get('/checkout', 'index')->name('checkout.index');
        Route::post('/checkout', 'store')->name('checkout.store');
    });
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    // Profile Settings
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';
