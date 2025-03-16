<?php
namespace App\Http\Middleware;

use App\Providers\AppServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class IdentifySite
{
    public function handle(Request $request, Closure $next)
    {
        $host = $request->getHost();
        $sitePath = base_path("sites/{$host}");

        // Ha nincs ilyen könyvtár, akkor a default site-ot használjuk
        if (!File::exists($sitePath)) {
            $sitePath = base_path("sites/default");
        }

        // Konfiguráció betöltése
        $configFile = "{$sitePath}/config.php";
        if (File::exists($configFile)) {
            Config::set('site', require $configFile);
        }
        $theme = Config::get('site.theme', 'default'); // Alapértelmezett theme beállítása
        View::addNamespace('theme', [
            base_path("themes/{$theme}/templates"),
            base_path("themes/default/templates")
        ]);

        // Modulok betöltése
        AppServiceProvider::loadModules("sites/all"); // Globális modulok
        AppServiceProvider::loadModules("{$sitePath}"); // Site-specifikus modulok

        return $next($request);
    }
}
