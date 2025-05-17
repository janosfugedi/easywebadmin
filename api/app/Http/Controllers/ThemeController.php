<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        return response()->json([
            'themes' => Theme::query()
                ->where('status', 'available')
                ->orWhere(function ($q) {
                    $q->where('status', 'custom')
                        ->where(function ($q) {
                            $q->where('user_id', auth()->id())
                                ->orWhere('site_id', request()->site?->id);
                        });
                })
                ->get()
        ]);
    }

    public function show(Theme $theme)
    {
        $canAccess = $theme->status === 'available'
            || ($theme->status === 'custom' && (
                    $theme->user_id === auth()->id()
                    || $theme->site_id === request()->site?->id
                ));

        abort_unless($canAccess, 403);

        return response()->json(['theme' => $theme]);
    }
}
