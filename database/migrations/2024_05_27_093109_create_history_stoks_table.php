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
        Schema::create('history_stoks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idProduk')->constrained('produks'); // Correct the table name here
            $table->foreignId('idPKL')->constrained('p_k_l_s'); // Correct the table name here
            $table->integer('stokAwal')->default(0)->nullable();
            $table->integer('stokAkhir')->default(0)->nullable();
            $table->integer('TerjualOnline')->default(0)->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_stoks');
    }
};
