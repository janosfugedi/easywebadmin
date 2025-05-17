<?php

namespace Database\Factories;

use App\Models\Site;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SiteFactory extends Factory
{
    protected $model = Site::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'theme_id' => Theme::factory(),
            'domain' => $this->faker->unique()->domainName,
            'title' => $this->faker->company,
        ];
    }
}
