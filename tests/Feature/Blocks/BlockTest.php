<?php

namespace Tests\Feature\Blocks;

use App\Models\Block;
use App\Models\Site;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlockTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_block(): void
    {
        $user = User::factory()->create();
        $site = Site::factory()->create();

        $payload = [
            'region' => 'header',
            'status' => true,
            'weight' => 0,
            'custom' => 0,
            'visibility' => 0,
            'title' => 'Fejléc',
            'content' => '<h1>Cégem</h1>',
            'site_id' => $site->id,
        ];

        $response = $this->actingAs($user)->postJson('/api/blocks', $payload);

        $response->assertStatus(201)
            ->assertJsonFragment([
                'title' => 'Fejléc',
                'region' => 'header',
            ]);

        $this->assertDatabaseHas('block', [
            'title' => 'Fejléc',
            'region' => 'header',
            'status' => true,
        ]);
    }

    public function test_user_can_update_block(): void
    {
        $user = User::factory()->create();
        $block = Block::factory()->create(['user_id' => $user->id]);

        $payload = [
            'title' => 'Frissített blokk',
            'content' => '<p>Frissítve</p>',
            'region' => 'footer',
        ];

        $response = $this->actingAs($user)->putJson("/api/blocks/{$block->bid}", $payload);

        $response->assertStatus(200)
            ->assertJsonFragment(['title' => 'Frissített blokk']);

        $this->assertDatabaseHas('block', [
            'bid' => $block->bid,
            'title' => 'Frissített blokk',
        ]);
    }

    public function test_user_can_list_own_blocks(): void
    {
        $user = User::factory()->create();
        Block::factory()->count(2)->create(['user_id' => $user->id]);
        Block::factory()->count(2)->create(); // más userhez

        $response = $this->actingAs($user)->getJson('/api/blocks');

        $response->assertStatus(200);
        $this->assertCount(2, $response->json('blocks'));
    }

    public function test_user_can_delete_own_block(): void
    {
        $user = User::factory()->create();
        $block = Block::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->deleteJson("/api/blocks/{$block->bid}");

        $response->assertStatus(200);
        $this->assertSoftDeleted('block', ['bid' => $block->bid]);
    }

    public function test_user_cannot_delete_others_block(): void
    {
        $user = User::factory()->create();
        $block = Block::factory()->create(); // más userhez

        $response = $this->actingAs($user)->deleteJson("/api/blocks/{$block->bid}");

        $response->assertStatus(403);
    }
}
