<?php

namespace App\Http\Controllers;

use App\Models\Block;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'blocks' => Block::where('user_id', $request->user()->id)->get()
        ]);
    }

    public function update(Request $request, Block $block)
    {
        if ($block->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $validated = $request->validate([
            'region' => 'sometimes|required|string|max:64',
            'status' => 'boolean',
            'weight' => 'integer',
            'custom' => 'integer|in:0,1,2',
            'visibility' => 'integer|in:0,1,2',
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
        ]);

        $block->update($validated);

        return response()->json(['block' => $block]);
    }

    public function destroy(Request $request, Block $block)
    {
        if ($block->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $block->delete();

        return response()->json(['message' => 'Block deleted']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'site_id' => 'required|integer',
            'region' => 'required|string|max:64',
            'status' => 'boolean',
            'weight' => 'integer',
            'custom' => 'integer|in:0,1,2',
            'visibility' => 'integer|in:0,1,2',
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
        ]);

        $block = Block::create([
            'user_id' => auth()->id(),
            'site_id' => $validated['site_id'],
            'region' => $validated['region'],
            'status' => $validated['status'] ?? false,
            'weight' => $validated['weight'] ?? 0,
            'custom' => $validated['custom'] ?? 0,
            'visibility' => $validated['visibility'] ?? 0,
            'title' => $validated['title'] ?? '',
            'content' => $validated['content'] ?? '',
        ]);

        return response()->json(['block' => $block], 201);
    }
}
