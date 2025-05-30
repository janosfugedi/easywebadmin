<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_and_get_token (): void
    {
        $password = 'secret123';

        $user = User::factory()->create([
            'email'    => 'teszt@example.com',
            'password' => bcrypt($password),
        ]);

        $response = $this->postJson('/api/login', [
            'email'    => 'teszt@example.com',
            'password' => $password,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['token', 'user' => ['id', 'name', 'email']]);
    }
}
