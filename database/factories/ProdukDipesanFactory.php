<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\produk_dipesan>
 */
class ProdukDipesanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'idPesanan'=>1,
            'idProduk'=>1,
            'JumlahProduk'=>1,
        ];
    }
}
