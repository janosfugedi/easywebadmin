<?php

namespace Tests\Feature\Nodes;

use App\Models\Node;
use App\Models\Site;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageNodeTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_page_node()
    {
        $user = User::factory()->create();
        $site = Site::factory()->for($user)->create();

        $payload = [
            'type' => 'page',
            'site_id' => $site->id,
            'title' => 'Rólunk',
            'body' => 'Ez az oldal a cégünkről szól.',
        ];

        $response = $this->actingAs($user)->postJson('/api/nodes', $payload);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'node' => [
                    'nid',
                    'vid',
                    'type',
                    'site_id',
                    'user_id',
                    'published',
                    'created_at',
                    'updated_at',
                    'title',
                    'body',
                ]
            ]);
    }
    public function test_user_can_update_page_node()
    {
        $user = User::factory()->create();
        $site = Site::factory()->for($user)->create();

        $payload = [
            'type' => 'page',
            'site_id' => $site->id,
            'title' => 'Eredeti cím',
            'body' => 'Eredeti szöveg.',
        ];

        $createResponse = $this->actingAs($user)->postJson('/api/nodes', $payload);
        $createResponse->assertStatus(201);
        $nid = $createResponse->json('node.nid');

        $updatePayload = [
            'title' => 'Frissített cím',
            'body' => 'Frissített szöveg.',
            'log' => 'Kijavítottam pár elírást.',
        ];

        $updateResponse = $this->actingAs($user)->putJson("/api/nodes/{$nid}", $updatePayload);
        $updateResponse->assertStatus(200)
            ->assertJsonFragment([
                'title' => 'Frissített cím',
                'body' => 'Frissített szöveg.',
            ]);
    }

    public function test_user_can_list_own_page_nodes()
    {
        $user = User::factory()->create();
        $site = Site::factory()->for($user)->create();

        Node::factory()->count(3)->for($user)->create([
            'site_id' => $site->id,
            'type' => 'page',
            'published' => true,
        ]);

        $response = $this->actingAs($user)->getJson('/api/nodes');
        $response->assertStatus(200);
        $response->assertJsonCount(3, 'nodes');
    }

    public function test_user_can_soft_delete_own_node()
    {
        $user = User::factory()->create();
        $site = Site::factory()->for($user)->create();

        $node = Node::factory()->for($user)->create([
            'site_id' => $site->id,
            'type' => 'page',
            'published' => true,
        ]);

        $response = $this->actingAs($user)->deleteJson("/api/nodes/{$node->nid}");
        $response->assertStatus(200);

        $this->assertDatabaseHas('node', [
            'nid' => $node->nid,
            'published' => false,
        ]);
    }

    public function test_user_cannot_list_others_nodes()
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $site = Site::factory()->for($other)->create();

        Node::factory()->count(2)->for($other)->create([
            'site_id' => $site->id,
            'type' => 'page',
            'published' => true,
        ]);

        $response = $this->actingAs($user)->getJson('/api/nodes');
        $response->assertStatus(200);
        $response->assertJsonCount(0, 'nodes');
    }

    public function test_user_cannot_update_others_node()
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $site = Site::factory()->for($other)->create();

        $node = Node::factory()->for($other)->create([
            'site_id' => $site->id,
            'type' => 'page',
            'published' => true,
        ]);

        $response = $this->actingAs($user)->putJson("/api/nodes/{$node->nid}", [
            'title' => 'Tilos frissíteni',
            'body' => 'Tilos módosítani.',
            'log' => 'Jogosulatlan módosítás.',
        ]);

        $response->assertStatus(403);
    }

    public function test_user_cannot_delete_others_node()
    {
        $user = User::factory()->create();
        $other = User::factory()->create();
        $site = Site::factory()->for($other)->create();

        $node = Node::factory()->for($other)->create([
            'site_id' => $site->id,
            'type' => 'page',
            'published' => true,
        ]);

        $response = $this->actingAs($user)->deleteJson("/api/nodes/{$node->nid}");
        $response->assertStatus(403);
    }
}
