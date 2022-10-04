<?php

namespace App\Services;

use App\Services\{
    Implementations\BrandService, Interfaces\IBrandService, Implementations\CategoryService,Interfaces\ICategoryService,
    Implementations\ColorService, Interfaces\IColorService, Implementations\ProductService, Interfaces\IProductService,
    Implementations\SliderService, Interfaces\ISliderService, Implementations\WishlistService, Interfaces\IWishlistService
};

class ServiceIoCRegister
{
    /**
     * Register Service dependency injection
     * @return void
     */

    public static function register() : void
    {
        app()->bind(ICategoryService::class, CategoryService::class);
        app()->bind(IBrandService::class, BrandService::class);
        app()->bind(IColorService::class, ColorService::class);
        app()->bind(ISliderService::class, SliderService::class);
        app()->bind(IProductService::class, ProductService::class);
        app()->bind(IWishlistService::class, WishlistService::class);
    }
}
