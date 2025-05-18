<?php

namespace App\Providers;

use App\Http\Controllers\SiteController;
use App\Services\ModulService;
use App\Services\SiteService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        app(SiteService::class)->load();
        if (File::exists(app_path('Modules'))) {
            app(ModulService::class)->loadModules(app_path('Modules'));
        }
    }


}
