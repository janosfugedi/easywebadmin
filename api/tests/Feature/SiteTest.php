<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Site;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Theme;
class SiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_site()
    {
        $user = User::factory()->create();
        $theme = Theme::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/sites', [
            'title' => 'Teszt Site',
            'domain' => 'example.hu',
            'theme_id' => $theme->id,
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['site' => ['id', 'title', 'domain', 'theme_id']]);

        $this->assertDatabaseHas('sites', [
            'title' => 'Teszt Site',
            'domain' => 'example.hu',
            'user_id' => $user->id,
            'theme_id' => $theme->id,
        ]);
    }

    public function test_user_can_list_their_sites()
    {
        $user = User::factory()->create();
        $theme = Theme::factory()->create();
        Site::factory()->count(2)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->getJson('/api/sites');

        $response->assertStatus(200)
            ->assertJsonCount(2, 'sites');
    }

    public function test_guest_cannot_access_sites()
    {
        $response = $this->getJson('/api/sites');
        $response->assertStatus(401);

        $response = $this->postJson('/api/sites', [
            'title' => 'Teszt Site',
            'domain' => 'example.hu',
        ]);
        $response->assertStatus(401);
    }

    public function test_invalid_domain_is_rejected()
    {
        $user = User::factory()->create();
        $theme = Theme::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/sites', [
            'title' => 'Hibás domain',
            'domain' => 'krumpli',
            'theme_id' => $theme->id,
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['domain']);
    }
}
