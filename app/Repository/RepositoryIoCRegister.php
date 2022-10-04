<?php

namespace App\Repository;

use App\Repository\{
    Implementations\BrandRepository, Interfaces\IBrandRepository, Implementations\CategoryRepository,Interfaces\ICategoryRepository,
    Implementations\ColorRepository, Interfaces\IColorRepository, Implementations\ProductRepository, Interfaces\IProductRepository,
    Implementations\SliderRepository, Interfaces\ISliderRepository, Implementations\WishlistRepository, Interfaces\IWishlistRepository
};
class RepositoryIoCRegister
{
    /**
     * Register Repository dependency injection
     * @return void
     */

    public static function register() : void
    {
        app()->bind(ICategoryRepository::class,CategoryRepository::class);
        app()->bind(IBrandRepository::class,BrandRepository::class);
        app()->bind(IColorRepository::class,ColorRepository::class);
        app()->bind(ISliderRepository::class,SliderRepository::class);
        app()->bind(IProductRepository::class,ProductRepository::class);
        app()->bind(IWishlistRepository::class,WishlistRepository::class);
    }
}
