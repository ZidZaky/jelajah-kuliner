<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class HistoryStokFactory extends Factory
{
     public function definition(): array
    {
        return [
            'idProduk' => \App\Models\Produk::factory(),
            'idPKL' => \App\Models\PKL::factory(), // Menambahkan ID PKL
            'stokAwal' => $this->faker->numberBetween(10, 100),
            'stokAkhir' => $this->faker->numberBetween(0, 100),
            'TerjualOnline' => $this->faker->numberBetween(0, 50),
            'statusIsi' => $this->faker->numberBetween(0, 1),
        ];
    }
}
