<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NodeType;
use Illuminate\Http\Request;

class NodeTypeController extends Controller
{
    public function index()
    {
        return NodeType::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|unique:node_types,type',
            'label' => 'required|string',
            'schema' => 'nullable|array',
        ]);

        return NodeType::create($validated);
    }

    public function show(NodeType $nodeType)
    {
        return $nodeType;
    }

    public function update(Request $request, NodeType $nodeType)
    {
        $validated = $request->validate([
            'label' => 'sometimes|required|string',
            'schema' => 'nullable|array',
        ]);

        $nodeType->update($validated);

        return $nodeType;
    }

    public function destroy(NodeType $nodeType)
    {
        $nodeType->delete();

        return response()->noContent();
    }
}
