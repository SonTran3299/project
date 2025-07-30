<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\CheckIsAdmin;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('admin/home', function () {
    return view('admin.pages.home');
});

//---Product Category---
Route::prefix('admin/product_category')
    ->controller(ProductCategoryController::class)
    ->name('admin.product_category.')
    ->middleware(CheckIsAdmin::class)
    ->group(function () {
        Route::get('list', 'list')->name('list');

        Route::get('create', 'create')->name('create');

        Route::post('store', 'store')->name('store');

        Route::get('make_slug', 'makeSlug')->name('make_slug');

        Route::post('destroy/{productCategory}', 'destroy')->name('destroy');

        Route::get('detail/{productCategory}', 'detail')->name('detail');

        Route::post('update/{productCategory}', 'update')->name('update');

        Route::post('restore/{productCategory}', 'restore')->name('restore');
    });

//---Product---
// Route::get('/admin/product/create', function(){
//     return view('admin.pages.product.create');
// })
Route::prefix('admin/product')
    ->controller(ProductController::class)
    ->name('admin.product.')
    ->middleware(CheckIsAdmin::class)
    ->group(function () {
        Route::get('list', 'list')->name('list');

        Route::get('create', 'create')->name('create');

        Route::post('store', 'store')->name('store');

        Route::post('destroy/{product}', 'destroy')->name('destroy');

        Route::get('detail/{product}', 'detail')->name('detail');

        Route::post('update/{product}', 'update')->name('update');
    });

//---User---
Route::get('admin/user', [UserController::class, 'list'])->name('admin.user.list')->middleware(CheckIsAdmin::class);

Route::prefix('admin/order')
    ->controller(OrderController::class)
    ->name('admin.order.')
    ->middleware(CheckIsAdmin::class)
    ->group(function () {
        Route::get('list', 'index')->name('list');
        Route::get('detail/{order}', 'detail')->name('detail');
        Route::post('update-order-status/{order}', 'updateOrderStatus')->name('update-order-status');
    });

Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware(CheckIsAdmin::class);
