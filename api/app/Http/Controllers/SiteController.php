<?php
namespace App\Http\Controllers;
use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'sites' => $request->user()->sites()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'domain' => ['required', 'string', 'regex:/^([a-z0-9\-]+\.)+[a-z]{2,}$/i'],
            'title' => ['required', 'string'],
            'theme_id' => 'required|exists:themes,id',
        ]);

        $site = Site::create([
            'domain' => $validated['domain'] ?? null,
            'title' => $validated['title'],
            'theme_id' => $validated['theme_id'],
            'user_id' => $request->user()->id,
        ]);

        return response()->json(['site' => $site], 201);
    }
}
