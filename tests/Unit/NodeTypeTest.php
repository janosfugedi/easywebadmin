<?php
// tests/Unit/NodeTypeTest.php
namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NodeTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_node_types_seeded(): void {
        $this->seed(\Database\Seeders\NodeTypeSeeder::class);

        $this->assertDatabaseHas('node_types', ['type' => 'page']);
        $this->assertDatabaseHas('node_types', ['type' => 'blog']);
        $this->assertDatabaseHas('node_types', [
            'type' => 'page',
            'title' => 'Oldal',
        ]);
    }
}
