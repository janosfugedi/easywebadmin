<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\AbstractNodeValidator;
use App\Http\Controllers\Controller;
use App\Models\Node;
use App\Models\NodeRevision;
use App\Validators\Types\PageTypeValidator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NodeController extends Controller
{
    use AuthorizesRequests;
    public function store(Request $request)
    {
        $type = $request->input('type');
        $class = "\\App\\NodeTypes\\" . ucfirst($type) . "TypeValidator";

        if (!class_exists($class)) {
            return response()->json(['error' => 'Invalid node type'], 400);
        }

        /** @var AbstractNodeValidator $validator */
        $validator = new $class();
        try {
            $data = $validator->validate($request);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        return DB::transaction(function () use ($data, $type) {
            $node = Node::create([
                'type' => $type,
                'site_id' => $data['site_id'],
                'user_id' => auth()->id(),
                'published' => $data['published'] ?? false,
            ]);

            $revision = NodeRevision::create([
                'nid' => $node->nid,
                'user_id' => auth()->id(),
                'title' => $data['title'],
                'log' => $data['log'] ?? null,
                'body' => $data['body'] ?? null,
                'published' => $node->published,
                'created_at' => now(),
            ]);

            $node->vid = $revision->vid;
            $node->save();

            return response()->json([
                'node' => array_merge(
                    $node->toArray(),
                    [
                        'title' => $node->latestRevision->title ?? null,
                        'body' => $node->latestRevision->body ?? null,
                    ]
                )
            ], 201);
        });
    }

    public function update(Request $request, $nid)
    {
        $node = Node::findOrFail($nid);
        $type = $node->type;
        if (auth()->id() !== $node->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $class = "\\App\\NodeTypes\\" . ucfirst($type) . "TypeValidator";
        if (!class_exists($class)) {
            return response()->json(['error' => 'Invalid node type'], 400);
        }

        /** @var AbstractNodeValidator $validator */
        $validator = new $class();
        $data = $validator->validate($request, true); // true = update

        return DB::transaction(function () use ($node, $data) {
            $revision = NodeRevision::create([
                'nid' => $node->nid,
                'user_id' => auth()->id(),
                'title' => $data['title'],
                'body' => $data['body'] ?? null,
                'log' => $data['log'] ?? null,
                'published' => $data['published'] ?? $node->published,
                'created_at' => now(),
            ]);

            $node->update([
                'vid' => $revision->vid,
                'published' => $revision->published,
            ]);

            return response()->json([
                'node' => $node->fresh()->load('latestRevision')
            ]);
        });
    }

    public function index(Request $request)
    {
        $nodes = Node::where('user_id', $request->user()->id)
            ->where('status', '!=', 'deleted')
            ->with('latestRevision')
            ->orderByDesc('nid')
            ->get();

        return response()->json(['nodes' => $nodes]);
    }

    public function destroy(Node $node)
    {
        $this->authorize('delete', $node);

        if (auth()->id() !== $node->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $node->update([
            'published' => false,
            'status' => 'deleted'
        ]);

        return response()->json(['message' => 'Node marked as deleted.']);
    }
}
