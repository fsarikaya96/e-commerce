<?php

namespace App\Repository;

use App\Repository\{
    Implementations\BrandRepository, Interfaces\IBrandRepository, Implementations\CategoryRepository,Interfaces\ICategoryRepository,
    Implementations\ColorRepository, Interfaces\IColorRepository, Implementations\ProductRepository, Interfaces\IProductRepository,
    Implementations\SliderRepository, Interfaces\ISliderRepository, Implementations\WishlistRepository, Interfaces\IWishlistRepository,
    Implementations\CartRepository, Interfaces\ICartRepository, Implementations\OrderRepository, Interfaces\IOrderRepository,
    Implementations\SettingRepository, Interfaces\ISettingRepository, Implementations\UserRepository, Interfaces\IUserRepository
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
        app()->bind(ICartRepository::class,CartRepository::class);
        app()->bind(IOrderRepository::class,OrderRepository::class);
        app()->bind(ISettingRepository::class,SettingRepository::class);
        app()->bind(IUserRepository::class,UserRepository::class);
    }
}
