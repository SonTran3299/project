<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\GoogleController;
use App\Http\Controllers\Client\HomeController;
use App\Mail\TestEmailTemplate;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('google/redirect', [GoogleController::class, 'redirect'])->name('client.google.redirect');
Route::get('google/callback', [GoogleController::class, 'callback'])->name('client.google.callback');

Route::prefix('')
    ->controller(ClientController::class)
    ->name('client.')
    ->group(function () {
        Route::get('shop', 'shop')->name('shop');

        Route::get('contact', 'contact')->name('contact');

        Route::get('login', 'login')->name('login');

        Route::get('register', 'register')->name('register');

        Route::get('detail/{product}', 'detail')->name('detail');
    });

Route::prefix('user')
    ->controller(CartController::class)
    ->name('client.')
    ->middleware('auth')
    ->group(function () {
        Route::get('cart', 'index')->name('cart');
        Route::post('add-item-to-cart/{product}', 'addToCart')->name('add-item-to-cart');
        Route::get('checkout', 'checkout')->name('checkout');
        Route::post('place-order', 'placeOrder')->name('place-order');
        Route::post('delete-product/{product}', 'deleteProductFromCart')->name('delete-product');
        Route::get('cart-count', 'cartCount')->name('cart-count');
    });

Route::get('/', [HomeController::class, 'index'])->name('client.home');

Route::get('test-mail', function () {
    Mail::to('tvs32.ys@gmail.com')->send(new TestEmailTemplate());
});

