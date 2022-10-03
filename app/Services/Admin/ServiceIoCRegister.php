<?php

namespace App\Services\Admin;

use App\Services\Admin\Implementations\BrandService;
use App\Services\Admin\Implementations\CategoryService;
use App\Services\Admin\Implementations\ColorService;
use App\Services\Admin\Implementations\ProductService;
use App\Services\Admin\Implementations\SliderService;
use App\Services\Admin\Interfaces\IBrandService;
use App\Services\Admin\Interfaces\ICategoryService;
use App\Services\Admin\Interfaces\IColorService;
use App\Services\Admin\Interfaces\IProductService;
use App\Services\Admin\Interfaces\ISliderService;

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
    }
}
