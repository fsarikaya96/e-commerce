<?php

namespace App\Repository\Admin;

use App\Repository\Admin\Implementations\BrandRepository;
use App\Repository\Admin\Implementations\CategoryRepository;
use App\Repository\Admin\Implementations\ColorRepository;
use App\Repository\Admin\Interfaces\IBrandRepository;
use App\Repository\Admin\Interfaces\ICategoryRepository;
use App\Repository\Admin\Interfaces\IColorRepository;

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
    }
}
