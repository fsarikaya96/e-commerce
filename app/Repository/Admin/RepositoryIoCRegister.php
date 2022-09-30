<?php

namespace App\Repository\Admin;

use App\Repository\Admin\Implementations\CategoryRepository;
use App\Repository\Admin\Interfaces\ICategoryRepository;

class RepositoryIoCRegister
{
    /**
     * Register Repository dependency injection
     * @return void
     */

    public static function register() : void
    {
        app()->bind(ICategoryRepository::class,CategoryRepository::class);
    }
}
