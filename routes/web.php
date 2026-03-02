<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class , 'index'])->name('home');
Route::get('/products', [ProductController::class , 'index'])->name('products.index');
Route::middleware('auth')->group(function () {
    Route::get('/products/create', [ProductController::class , 'create'])->name('products.create');
    Route::post('/products', [ProductController::class , 'store'])->name('products.store');
});
Route::get('/products/{id}', [ProductController::class , 'show'])->name('products.show');
Route::get('/contact', [ContactController::class , 'index'])->name('contact');
Route::post('/contact', [ContactController::class , 'store'])->name('contact.store');
Route::view('/about', 'about')->name('about');

// Cart (session-based, no auth required)
Route::post('/cart/add', [CartController::class , 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class , 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class , 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class , 'clear'])->name('cart.clear');
Route::get('/cart', [CartController::class , 'index'])->name('cart.index');

// Auth routes
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/dashboard', function () {
            return redirect()->route('home');
        }
        )->name('dashboard');

        Route::get('/profile', [ProfileController::class , 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class , 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class , 'destroy'])->name('profile.destroy');
    });

require __DIR__ . '/auth.php';
