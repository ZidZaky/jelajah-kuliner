<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Account;

class PKLFactory extends Factory
{
    public function definition(): array
    {
        return [
            'idAccount' => Account::factory(), // sesuaikan dengan nama kolom di migration
            'namaPKL' => $this->faker->company,
            'desc' => $this->faker->paragraph,
            'picture' => null,
            'longitude' => $this->faker->randomFloat(8, -180, 180),
            'latitude' => $this->faker->randomFloat(8, -90, 90),
        ];
    }
}
