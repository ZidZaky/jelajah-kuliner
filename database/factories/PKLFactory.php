<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Account;

class PKLFactory extends Factory
{
    public function definition(): array
    {
        $picture=[
            '2af948bbcba2aec33fa3dabbbc78265c.jpg',
            '20e78080e5814fbba2721df2fa7e1d7a.jpg',
            '33c905c77ee8dcf67e9f87037ac62b72.jpg',
            '2673ffafa17717545759b63b4159679c.jpg',
            'f8761bed66c5f47ef22915a8dbcc3a49.jpg',
        ];
        return [
            'idAccount' => Account::factory(),
            'namaPKL' => $this->faker->company,
            'desc' => $this->faker->paragraph,
            'picture' => $this->faker->randomElement($picture),
'longitude' => $this->faker->randomFloat(8, 112.6, 112.8),
'latitude' => $this->faker->randomFloat(8, -7.4, -7.1),


        ];
    }
}
