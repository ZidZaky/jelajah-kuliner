<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('namaProduk');
            $table->longText('desc');
            $table->string('harga');
            $table->string('stok');
            $table->string('jenisProduk');
            $table->string('foto');
            // $table->foreignId('idPKL')->constrained('PKLS'); // Correct the table name here
            $table->foreignId('idAccount')->constrained('p_k_l_s'); // Correct the table name here


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produks');
    }
};
