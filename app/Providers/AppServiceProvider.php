<?php

namespace App\Providers;

use App\Models\Setting;
use App\Repository\RepositoryIoCRegister;
use App\Services\ServiceIoCRegister;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
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
        Paginator::useBootstrap();
        $webSetting = Setting::first();
        View::share('appSetting',$webSetting);
        Route::pattern('id', '[0-9]+');
    }
}
