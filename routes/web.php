<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth' => 'isAdmin'])->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    // Category
    Route::controller(\App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::get('category', 'index')->name('admin.category');
        Route::get('category/create', 'create')->name('admin.category.create');
        Route::post('category/store', 'store')->name('admin.category.store');
        Route::get('category/{category}/edit', 'edit')->name('admin.category.edit');
        Route::put('category/{category}', 'update')->name('admin.category.update');
    });

    // Product
    Route::controller(\App\Http\Controllers\Admin\ProductController::class)->group(function () {
        Route::get('products', 'index')->name('admin.products');
        Route::get('products/create', 'create')->name('admin.products.create');
        Route::post('products', 'store')->name('admin.products.store');
        Route::get('products/{product}/edit','edit')->name('admin.products.edit');
        Route::put('products/{product}','update')->name('admin.products.update');
        Route::get('products/product-image/{product}/delete','deleteImage')->name('admin.products.deleteImage');
    });

    // Colors
    Route::controller(\App\Http\Controllers\Admin\ColorController::class)->group(function () {
        Route::get('colors', 'index')->name('admin.colors');
        Route::get('colors/create', 'create')->name('admin.colors.create');

    });
        Route::get('brands', App\Http\Livewire\Admin\Brand\Index::class)->name('admin.brands');
});
