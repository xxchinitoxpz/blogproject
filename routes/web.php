<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\OrderController;



Route::get('/', [HomeController::class, 'homepage']);

Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/home', [HomeController::class, 'index'])->middleware(['auth'])->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart-products', [CartController::class, 'getCartProducts'])->name('cart.products');
    Route::get('/checkout', [SaleController::class, 'showCheckoutForm'])->name('checkout.form');
    Route::post('/create-sale', [SaleController::class, 'createSale'])->name('checkout.create');
    Route::get('/contact', function () {
        return view('home.contact');
    })->name('contact');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
});










require __DIR__ . '/auth.php';
