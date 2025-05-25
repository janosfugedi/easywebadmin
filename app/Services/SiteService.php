<?php
namespace App\Services;

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;

class SiteService
{
    public function getHost():?string
    {
        if (empty(\Config::get('loadedSite', null))) {
            $host = request()->getHost();
            $sitePath = $this->getSitePath($host);
            if (empty($sitePath)) {
                return null;
            }
            $this->configInit($sitePath);
            // klón oldal?
            $alias = \Config::get('alias', null);
            if (!empty($alias) && $alias !== $host) {
                \Config::set('loadedSite', $alias);
            } else {
                \Config::set('loadedSite', $host);
            }
        }
        return \Config::get('loadedSite');
    }
    public function load(): bool
    {
        $host = $this->getHost();
        if (empty($host)) {
            return false;
        }

        $sitePath = $this->getSitePath($host);
        if (empty($sitePath)) {
            return false;
        }

        $this->configInit($sitePath);
        $this->routeInit($sitePath);
        $this->viewInit($sitePath);

        // Modulok betöltése
        $this->loadModules($sitePath);
        return true;
    }
    protected function getSitePath (string $host): ?string
    {
        $segments = explode('.', $host);
        if (count($segments) < 2) {
            return null;
        }
        // Ellenőrizzük az összes lehetséges domain variációt
        while (count($segments) >= 2) {
            $sitePath = base_path("sites/" . implode('.', $segments));
            if (File::exists($sitePath)) {
                break;
            }
            array_shift($segments); // Eldobjuk a legbaloldalibb szegmenst
        }
        // config extend
        if (!is_dir("{$sitePath}")) {
            return null;
        }
        return $sitePath;
    }

    protected function configInit(string $sitePath):void
    {
        $configFile = "{$sitePath}/config.php";

        if (!file_exists($configFile)) {
            return;
        }
        $siteConfig = require $configFile;

        foreach ($siteConfig as $key => $value) {
            Config::set($key, $value);
        }
    }
    protected function routeInit(string $sitePath):void
    {
        if (File::exists("{$sitePath}/routes.php")) {
            Route::middleware('web')
                ->group("{$sitePath}/routes.php");
        }
        foreach (config('pages', []) as $url => $page) {
            Route::get($url, function () use ($page) {
                return app(SiteController::class)->page($page);
            });
        }
    }

    protected function viewInit (string $sitePath):void
    {
        View::getFinder()->prependLocation("{$sitePath}/views");
        View::getFinder()->prependLocation(base_path("sites/default/views"));
    }
    protected function loadModules(string $sitePath):void
    {
        // Globális Site Modulok
        if (File::exists(base_path('sites/default/Modules'))) {
            app(ModulService::class)->loadModules(base_path('sites/default/Modules'));
        }
        // Site-specifikus modulok
        if (File::exists(base_path("{$sitePath}/Modules"))) {
            app(ModulService::class)->loadModules(base_path("{$sitePath}/Modules"));
        }
    }

    public function asset(string $path):?string
    {
        $domain = $this->getHost();
        $file = base_path("sites/{$domain}/assets/{$path}");
        if (file_exists($file)) {
            return $file;
        }
        $file = base_path("sites/default/assets/{$path}");
        if (file_exists($file)) {
            return $file;
        }

        return null;
    }
}
