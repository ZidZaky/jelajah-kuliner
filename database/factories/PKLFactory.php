<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PKL>
 */
class PKLFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $picture=[
            'Pentol.jpg',
            'Seblak.png',
        ];
        return [
            // 'namaPKL'=>$this->faker->firstName().' '.$this->faker->firstName(),
            'namaPKL'=>'evi',
            'desc'=>$this->faker->word(),
            'picture'=>$this->faker->randomElement($picture),
            'latitude'=>'-7.' . $this->faker->numerify('########'),
            'longitude'=>'-7.' . $this->faker->numerify('########'),
            'idAccount'=>null,
        ];
    }
}
