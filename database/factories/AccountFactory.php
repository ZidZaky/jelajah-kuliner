<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $status = ['PKL','Pelanggan'];
        return [
            'nama'=>$this->faker->name(),
            'email'=>$this->faker->firstname().'@example.com',
            'nohp'=>$this->faker->numerify('############'),
            'password'=>Hash::make('password'),
            'status'=>$this->faker->randomElement($status),
        ];
    }
}
