<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
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
        $modulesPath = app_path('Modules');

        if (File::exists($modulesPath)) {
            $modules = File::directories($modulesPath);
            foreach ($modules as $module) {
                $moduleName = basename($module);
                self::loadModules($module);
            }
        }
    }

    public static function loadModules($modulesPath)
    {
        if (File::exists($modulesPath)) {
            $modules = File::directories($modulesPath);
            foreach ($modules as $module) {
                $moduleName = basename($module);
                $routeFile = "{$module}/routes.php";
                if (File::exists($routeFile)) {
                    Route::middleware('web')->group($routeFile);
                }
                $viewsPath = "{$module}/views";
                View::addNamespace("{$moduleName}", $viewsPath);
            }
        }
    }
}
