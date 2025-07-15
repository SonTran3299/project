<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\GoogleController;
use App\Http\Controllers\Client\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('google/redirect', [GoogleController::class, 'redirect'])->name('client.google.redirect');
Route::get('google/callback', [GoogleController::class, 'callback'])->name('client.google.callback');

// Route::middleware('guest')->group(function () {
//     Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('user.login');
//     Route::get('register', [RegisteredUserController::class, 'create'])->name('user.register');

// });
// Route::prefix('user')
//     ->controller(ClientController::class)
//     ->name('user.')
//     ->group(function () {
//         Route::get('login', 'login')->name('login');
//         Route::get('register', 'register')->name('register');
//     });


Route::prefix('client')
    ->controller(ClientController::class)
    ->name('client.')
    ->group(function () {
        Route::get('shop', 'shop')->name('shop');

        Route::get('contact', 'contact')->name('contact');

        Route::get('cart', 'cart')->name('cart');

        Route::get('login', 'login')->name('login');

        Route::get('register', 'register')->name('register');

        Route::get('detail/{product}', 'detail')->name('detail');
    });

Route::prefix('client')
    ->controller(CartController::class)
    ->name('client.')
    ->group(function () {
        //Route::get('cart', 'showCart')->name('cart');
        Route::post('update', 'updateCart')->name('updateCart');
        Route::get('add-item-to-cart', 'addToCart')->name('add-item-to-cart');
        Route::get('cart', 'index')->name('cart');
    });

Route::get('client/home', [HomeController::class, 'index'])->name('client.home');
//Route::post('/cart/update-quantity', [ClientController::class, 'updateCartQuantity'])->name('cart.update_quantity');
