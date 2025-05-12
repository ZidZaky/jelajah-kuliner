<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    // database/seeders/DatabaseSeeder.php
    public function run(): void
    {
        \App\Models\Account::factory(10)->create();
        \App\Models\PKL::factory(10)->create();
        \App\Models\Produk::factory(20)->create();

        // Membuat pesanan dan menambahkan produk ke dalamnya
        \App\Models\Pesanan::factory(15)->create(); // Ini akan memanggil factory dan memasukkan produk

        \App\Models\Ulasan::factory(30)->create();
        \App\Models\HistoryStok::factory(20)->create();
    }
}
