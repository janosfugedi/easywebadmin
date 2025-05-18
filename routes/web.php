<?php

use App\Http\Controllers\Api\SiteController;
use App\Services\SiteService;
use Illuminate\Support\Facades\Route;

// ha a php artisan themes:link nem működne
Route::get('/themes/{theme}/{file}', function ($theme, $file) {
    $path = base_path("themes/{$theme}/css/{$file}");

    if (!File::exists($path)) {
        abort(404);
    }

    return Response::file($path, ['Content-Type' => 'text/css']);
})->where('file', '.*');
Route::get('/assets/{path}', function ($path) {
    $file = app(SiteService::class)->asset($path);
    if (empty($file)) {
        abort(404);
    }
    return Response::file($file);
})->where('path', '.*');
