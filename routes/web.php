<?php

use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//-------Client-------
Route::get('home', function () {
    return view('client.pages.home');
})->name('client.pages.home');

Route::get('shop', function () {
    return view('client.pages.shop');
})->name('client.pages.shop');

Route::get('detail', function () {
    return view('client.pages.detail');
})->name('client.pages.detail');

Route::get('contact', function () {
    return view('client.pages.contact');
})->name('client.pages.contact');

Route::get('cart', function () {
    return view('client.pages.cart');
})->name('client.pages.cart');

Route::get('checkout', function () {
    return view('client.pages.checkout');
})->name('client.pages.checkout');
//  -----User-----
// Route::get('register', function () {
//     return view('client.pages.register');
// })->name('client.pages.register');

Route::get('register', function () {
    return view('client.pages.user.register');
})->name('client.pages.user.register');

Route::get('login', function () {
    return view('client.pages.user.login');
})->name('client.pages.user.login');
//-------Client End-------
//Route::get('admin/product_category/list', [ProductCategoryController::class, 'list'])->name('admin.pages.product_category.list');
