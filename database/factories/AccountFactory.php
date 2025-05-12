<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
class AccountFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'nohp' => $this->faker->phoneNumber(),
            'password' => Hash::make('password'), // default password
            'status' => $this->faker->randomElement(['aktif', 'nonaktif']),
        ];
    }
}
