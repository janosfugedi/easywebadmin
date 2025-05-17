<?php
namespace App\Http\Controllers\Themes;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class BaseThemeController
{
    protected string $theme;

    public function __construct(string $theme)
    {
        $this->theme = $theme;
    }

    protected function getThemePath(): string
    {
        return resource_path("views/theme/{$this->theme}/theme.json");
    }

    public function getThemeMeta(): array
    {
        $path = $this->getThemePath();

        if (!File::exists($path)) {
            abort(404, "Theme '{$this->theme}' not found.");
        }

        return json_decode(File::get($path), true);
    }

    public function getRegions(): array
    {
        return $this->getThemeMeta()['regions'] ?? [];
    }

    public function getAssets(): array
    {
        return $this->getThemeMeta()['assets'] ?? [];
    }

    public function showMeta()
    {
        return Response::json($this->getThemeMeta());
    }
}
