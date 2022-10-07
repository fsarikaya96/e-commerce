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
// ---------------------------------------------------------------------- //
// ----------------------- Frontend Start ------------------------------- //
// ---------------------------------------------------------------------- //

Route::controller(\App\Http\Controllers\Frontend\FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('frontend.home');
    Route::get('/collections', 'categories')->name('frontend.category');
    Route::get('/collections/{category_slug}', 'products')->name('frontend.products');
    Route::get('/collections/{category_slug}/{product_slug}', 'productView')->name('frontend.products.view');
});
Route::middleware('auth')->group(function () {

    Route::get('/wishlists', [\App\Http\Controllers\Frontend\WishlistController::class, 'index'])->name('wishlists');
    Route::get('/carts', [\App\Http\Controllers\Frontend\CartController::class, 'index'])->name('carts');
    Route::get('/checkout', [\App\Http\Controllers\Frontend\CheckoutController::class, 'index'])->name('checkout');
    Route::get('/thank-you', [\App\Http\Controllers\Frontend\ThankYouController::class, 'index'])->name('thankyou');
    Route::get('/orders', [\App\Http\Controllers\Frontend\OrderController::class, 'index'])->name('orders');
    Route::get('/orders/{id}', [\App\Http\Controllers\Frontend\OrderController::class, 'show'])->name('show');
});

// ---------------------------------------------------------------------- //
// ----------------------- Frontend End --------------------------------- //
// ---------------------------------------------------------------------- //


// ---------------------------------------------------------------------- //
// ----------------------- Backend Start ------------------------------- //
// ---------------------------------------------------------------------- //
Route::prefix('admin')->middleware(['auth' => 'isAdmin'])->group(function () {
    Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    // Category
    Route::controller(\App\Http\Controllers\Admin\CategoryController::class)->group(function () {
        Route::get('category', 'index')->name('admin.category');
        Route::get('category/create', 'create')->name('admin.category.create');
        Route::post('category/store', 'store')->name('admin.category.store');
        Route::get('category/{id}/edit', 'edit')->name('admin.category.edit');
        Route::put('category/{id}', 'update')->name('admin.category.update');
    });

    // Product
    Route::controller(\App\Http\Controllers\Admin\ProductController::class)->group(function () {
        Route::get('products', 'index')->name('admin.products');
        Route::get('products/create', 'create')->name('admin.products.create');
        Route::post('products', 'store')->name('admin.products.store');
        Route::get('products/{id}/edit', 'edit')->name('admin.products.edit');
        Route::put('products/{id}', 'update')->name('admin.products.update');
        Route::get('products/product-image/{product}/delete', 'deleteImage')->name('admin.products.deleteImage');
        Route::post('products/update-product-color/{product?}', 'updateProductColor')->name(
            'admin.products.updateProductColor'
        );
        Route::post('products/delete-product-color/{product?}', 'deleteProductColor')->name(
            'admin.products.deleteProductColor'
        );
    });

    // Slider
    Route::controller(\App\Http\Controllers\Admin\SliderController::class)->group(function () {
        Route::get('sliders', 'index')->name('admin.sliders');
        Route::get('sliders/create', 'create')->name('admin.sliders.create');
        Route::post('sliders', 'store')->name('admin.sliders.store');
        Route::get('sliders/{id}/edit', 'edit')->name('admin.sliders.edit');
        Route::put('sliders/{id}', 'update')->name('admin.sliders.update');
    });

    // Color
    Route::controller(\App\Http\Controllers\Admin\ColorController::class)->group(function () {
        Route::get('colors', 'index')->name('admin.colors');
        Route::get('colors/create', 'create')->name('admin.colors.create');
    });
    // Brand
    Route::get('brands', [\App\Http\Controllers\Admin\BrandController::class, 'index'])->name('admin.brands');
});
// ---------------------------------------------------------------------- //
// ----------------------- Backend End ------------------------------- //
// ---------------------------------------------------------------------- //
