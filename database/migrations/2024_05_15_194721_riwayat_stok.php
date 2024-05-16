<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('history_stok', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idProduk')->constrained('produks'); // Correct the table name here
            $table->integer('stokAwal');
            $table->integer('stokAkhir');
            $table->foreignId('idPKL')->constrained('p_k_l_s'); // Correct the table name here
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
