<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Menu::query();

        if ($request->has('site_id')) {
            $query->where('site_id', $request->input('site_id'));
        }

        if ($request->has('parent_id')) {
            $query->where('parent_id', $request->input('parent_id'));
        }

        return $query->orderBy('weight')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'site_id' => 'required|exists:sites,id',
            'parent_id' => 'nullable|exists:menus,id',
            'title' => 'required|string',
            'path' => 'required|string',
            'weight' => 'nullable|integer',
            'visible' => 'boolean',
        ]);

        return Menu::create($data);
    }

    public function show(Menu $menu)
    {
        return $menu;
    }

    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'title' => 'sometimes|string',
            'path' => 'sometimes|string',
            'parent_id' => 'nullable|exists:menus,id',
            'weight' => 'nullable|integer',
            'visible' => 'boolean',
        ]);

        $menu->update($data);

        return $menu;
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return response()->noContent();
    }
}
