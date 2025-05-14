<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;

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

    public function page(string $slug = null)
    {
        $path = '/' . ltrim($slug, '/');

        $pages = config('pages');

        if (!isset($pages[$path])) {
            abort(404);
        }
        $page    = $pages[$path];
        $theme   = $page['theme'] ?? 'default';
        $regions = $page['regions'] ?? [];
        View::addNamespace('theme', [
            base_path("themes/{$theme}/views/"),
            base_path("themes/default/views/")
        ]);
        $view = 'theme::layout';

        if (!View::exists($view)) {
            abort(500, "Layout not found for theme [$theme]");
        }
        $blocks = [];
        foreach ($regions as $region => $blockIds) {
            $blocks[$region] = collect($blockIds)->map(fn($id) => config("blocks.$id"))->filter();
        }

        return view($view, [
            'title' => config('title',''),
            'theme' => $theme,
            'regions' => $regions,
            'blocks' => $blocks,
        ]);
    }
}
