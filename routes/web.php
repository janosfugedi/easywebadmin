<?php

use Illuminate\Support\Facades\Route;
// ha a php artisan themes:link nem működne
Route::get('/themes/{theme}/{file}', function ($theme, $file) {
    $path = base_path("themes/{$theme}/css/{$file}");

    if (!File::exists($path)) {
        abort(404);
    }

    return Response::file($path, ['Content-Type' => 'text/css']);
})->where('file', '.*');

use App\Http\Controllers\SiteController;

Route::get('/{path?}', [SiteController::class, 'show'])
    ->where('path', '.*');
