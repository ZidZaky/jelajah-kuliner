<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Account;
use App\Models\PKL;
use App\Models\Produk;

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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $akun = Account::factory()->count(1)->create();

        //buat akun pkl
        $pkl = PKL::factory()->create([
            'idAccount'=>$akun[0]->id,
        ]);
        //buat 1 product
        $product = Produk::factory()->create([
            'idPKL'=>$pkl->id,
        ]);
        // Membuat pesanan dan menambahkan produk ke dalamnya
        \App\Models\Pesanan::factory(15)->create(); // Ini akan memanggil factory dan memasukkan produk

        \App\Models\Ulasan::factory(30)->create();
        \App\Models\HistoryStok::factory(20)->create();
    }
}
