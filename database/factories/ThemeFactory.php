<?php

namespace Database\Factories;

use App\Models\Theme;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThemeFactory extends Factory
{
    protected $model = Theme::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
            'title' => $this->faker->unique()->word(),
            'regions' => ['header', 'footer', 'sidebar'],
            'assets' => json_encode([
                'css' => ['/themes/basic/style.css'],
                'js' => ['/themes/basic/script.js'],
            ]),
            'status' => 'available',
            'user_id' => null,
            'site_id' => null,
        ];
    }
}
