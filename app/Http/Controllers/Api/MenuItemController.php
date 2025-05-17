<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function index(Request $request)
    {
        $query = MenuItem::query();

        if ($request->has('menu_id')) {
            $query->where('menu_id', $request->input('menu_id'));
        }

        if ($request->has('parent_id')) {
            $query->where('parent_id', $request->input('parent_id'));
        }

        return $query->orderBy('weight')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'parent_id' => 'nullable|exists:menu_items,id',
            'title' => 'required|string|max:255',
            'path' => 'required|string|max:255',
            'weight' => 'nullable|integer',
            'visible' => 'boolean',
        ]);

        return MenuItem::create($data);
    }

    public function show(MenuItem $menuItem)
    {
        return $menuItem;
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'path' => 'sometimes|string|max:255',
            'parent_id' => 'nullable|exists:menu_items,id',
            'weight' => 'nullable|integer',
            'visible' => 'boolean',
        ]);

        $menuItem->update($data);

        return $menuItem;
    }

    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();

        return response()->noContent();
    }
}
