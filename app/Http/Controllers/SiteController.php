<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;

class SiteController extends Controller
{
    public function show($path = '/')
    {
        $domain = Request::getHost();
        $apiUrl = config('services.api_base_url') . '/api/content';

        $response = Http::get($apiUrl, [
            'domain' => $domain,
            'path' => '/' . ltrim($path, '/'),
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return view('site.page', ['content' => $data]);
        }

        abort(404);
    }
}
