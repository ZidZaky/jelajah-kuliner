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
    public function run()
    {
        // \App\Models\User::factory(10)->create();

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
    }
}
