<?php

namespace Database\Factories;

use App\Models\Node;
use App\Models\User;
use App\Models\Site;
use Illuminate\Database\Eloquent\Factories\Factory;

class NodeFactory extends Factory
{
    protected $model = Node::class;

    public function definition(): array
    {
        return [
            'type' => 'page',
            'site_id' => Site::factory(),
            'user_id' => User::factory(),
            'published' => false,
        ];
    }
}
