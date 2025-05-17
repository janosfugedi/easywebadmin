<?php

namespace Database\Factories;

use App\Models\NodeType;
use Illuminate\Database\Eloquent\Factories\Factory;

class NodeTypeFactory extends Factory
{
    protected $model = NodeType::class;


    public function definition (): array
    {
        return [
            'type'   => $this->faker->unique()->word,
            'name'   => $this->faker->words(2, true),
            'schema' => ['title' => 'string', 'body' => 'text'], // lehetőleg mindig JSON-olható
        ];
    }
}
