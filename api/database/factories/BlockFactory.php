<?php

namespace Database\Factories;

use App\Models\Block;
use App\Models\Site;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlockFactory extends Factory
{
    protected $model = Block::class;

    public function definition(): array
    {
        return [
            'site_id' => Site::factory(),
            'user_id' => User::factory(),
            'region' => $this->faker->randomElement(['header', 'footer', 'sidebar', 'content']),
            'status' => true,
            'weight' => $this->faker->numberBetween(0, 10),
            'custom' => 0,
            'visibility' => 0,
            'content' => '<p>' . $this->faker->paragraph() . '</p>',
            'title' => $this->faker->sentence(3),
        ];
    }
}
