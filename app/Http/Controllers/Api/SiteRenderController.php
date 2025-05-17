<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Block;
use App\Models\Site;

class SiteRenderController extends Controller
{
    public function show($domain)
    {
        $site = Site::with('theme')
            ->where('domain', $domain)
            ->firstOrFail();

        $blocks = Block::where('site_id', $site->id)
            ->where('status', 1)
            ->orderBy('weight')
            ->get()
            ->groupBy('region');
        $themeName = $site->theme->name;
        $view = "theme.{$themeName}.layout";

        if (!view()->exists($view)) {
            abort(500, "Theme view [{$view}] not found.");
        }

        return response()->view($view, [
            'site' => $site,
            'theme' => $site->theme,
            'blocks' => $blocks,
        ], 200, ['Content-Type' => 'text/html']);
    }
}
