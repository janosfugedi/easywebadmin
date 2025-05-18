<?php
namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

class ModulService
{
    public function loadModules(string $modulesPath):void
    {
        $modules = File::directories($modulesPath);
        foreach ($modules as $module) {
            $this->loadModule($module);
        }
    }
    public function loadModule($modulePath):void
    {
        $moduleName = basename($modulePath);
        $routeFile = "{$modulePath}/routes.php";
        if (File::exists($routeFile)) {
            Route::middleware('web')->group($routeFile);
        }
        $viewsPath = "{$modulePath}/views";
        View::addNamespace("{$moduleName}", $viewsPath);
    }
}
