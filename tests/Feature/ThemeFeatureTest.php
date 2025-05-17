<?php

namespace Tests\Feature;

use App\Models\Theme;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThemeFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_list_available_themes()
    {
        $user = User::factory()->create();
        Theme::factory()->create(['status' => 'available']);
        Theme::factory()->create(['status' => 'disabled']);
        Theme::factory()->create(['status' => 'custom', 'user_id' => $user->id]);

        $response = $this->actingAs($user)->getJson('/api/themes');

        $response->assertStatus(200);
        $this->assertCount(2, $response->json('themes'));
    }

    public function test_user_can_view_available_theme()
    {
        $user = User::factory()->create();
        $theme = Theme::factory()->create(['status' => 'available']);

        $response = $this->actingAs($user)->getJson("/api/themes/{$theme->id}");

        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $theme->id]);
    }

    public function test_user_cannot_view_unavailable_theme()
    {
        $user = User::factory()->create();
        $theme = Theme::factory()->create(['status' => 'disabled']);

        $response = $this->actingAs($user)->getJson("/api/themes/{$theme->id}");

        $response->assertStatus(403);
    }

    public function test_user_can_view_own_custom_theme()
    {
        $user = User::factory()->create();
        $theme = Theme::factory()->create(['status' => 'custom', 'user_id' => $user->id]);

        $response = $this->actingAs($user)->getJson("/api/themes/{$theme->id}");

        $response->assertStatus(200);
        $response->assertJsonFragment(['id' => $theme->id]);
    }
}
