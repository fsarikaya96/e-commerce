<?php

namespace App\Providers;

use App\Repository\RepositoryIoCRegister;
use App\Services\ServiceIoCRegister;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        RepositoryIoCRegister::register();
        ServiceIoCRegister::register();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Route::pattern('id', '[0-9]+');
    }
}
