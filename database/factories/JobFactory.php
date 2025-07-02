<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    protected $model = Job::class;

    public function definition(): array
    {
        $sectors = ['Kiyovu', 'Nyamirambo', 'Kimihurura', 'Gisozi', 'Kagugu', 'Rusororo', 'Gikondo', 'Kicukiro', 'Nyarugenge', 'Remera'];

        return [
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(),
            'company' => $this->faker->company(),
            'location' => 'Prince District, ' . $this->faker->randomElement($sectors),
            'user_id' => User::inRandomOrder()->first()->id ?? 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
