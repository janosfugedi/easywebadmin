<?php

namespace App\Providers;

use App\Http\Controllers\SiteController;
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
    protected function getHost ():string
    {
        $host = request()->getHost();
        $alias = require base_path("sites/alias.php");
        if (isset($alias[$host])) {
            $host = $alias[$host];
        }
        return $host;
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $host = $this->getHost();
        $segments = explode('.', $host);
        // Ellenőrizzük az összes lehetséges domain variációt
        while (count($segments) >= 2) {
            $sitePath = base_path("sites/" . implode('.', $segments));
            if (File::exists($sitePath)) {
                break;
            }
            array_shift($segments); // Eldobjuk a legbaloldalibb szegmenst
        }
        // config extend
        if (is_dir("{$sitePath}")) {
            //View::addLocation("{$sitePath}/views");
            View::getFinder()->prependLocation("{$sitePath}/views");
            $siteConfig = require "{$sitePath}/config.php";
            foreach ($siteConfig as $key => $value) {
                Config::set($key, $value);
            }
            // route extend
            if (File::exists("{$sitePath}/routes.php")) {
                Route::middleware('web')
                    ->group("{$sitePath}/routes.php");
            }
            // Modulok betöltése
            AppServiceProvider::loadModules("sites/all"); // Globális modulok
            AppServiceProvider::loadModules("{$sitePath}"); // Site-specifikus modulok
            Route::get('/{slug?}',[SiteController::class, 'page'])->where('slug', '.*');
        }


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
