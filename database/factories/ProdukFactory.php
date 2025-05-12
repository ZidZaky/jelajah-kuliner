<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
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
            "namaProduk"=>$this->faker->word(3),
            "desc"=>$this->faker->word(15),
            "harga"=>$this->faker->randomDigit(7),
            "stokSaatIni"=>$this->faker->randomDigit(2),
            "jenisProduk"=>$this->faker->randomElement(['Makanan','Minuman']),
            "fotoProduk"=>$this->faker->randomElement($picture),
            'idPKL'=>null,

        ];
    }
}
