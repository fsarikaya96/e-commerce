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

Auth::routes();
// Frontend
Route::controller(\App\Http\Controllers\Frontend\FrontendController::class)->group(function () {
    Route::get('/','index')->name('frontend.home');
    Route::get('/collections','categories')->name('frontend.category');
    Route::get('/collections/{category_slug}','products')->name('frontend.products');
});

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
        Route::post('products/update-product-color/{product?}','updateProductColor')->name('admin.products.updateProductColor');
        Route::post('products/delete-product-color/{product?}','deleteProductColor')->name('admin.products.deleteProductColor');
    });

    // Slider
    Route::controller(\App\Http\Controllers\Admin\SliderController::class)->group(function () {
        Route::get('sliders', 'index')->name('admin.sliders');
        Route::get('sliders/create', 'create')->name('admin.sliders.create');
        Route::post('sliders', 'store')->name('admin.sliders.store');
        Route::get('sliders/{slider}/edit', 'edit')->name('admin.sliders.edit');
        Route::put('sliders/{slider}', 'update')->name('admin.sliders.update');

    });

    // Color
    Route::controller(\App\Http\Controllers\Admin\ColorController::class)->group(function () {
        Route::get('colors', 'index')->name('admin.colors');
        Route::get('colors/create', 'create')->name('admin.colors.create');

    });
        Route::get('brands', App\Http\Livewire\Admin\Brand\Index::class)->name('admin.brands');
});
