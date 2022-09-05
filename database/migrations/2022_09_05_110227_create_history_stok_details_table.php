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
        Schema::create('history_stok_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('history_id');
            $table->unsignedBigInteger('barang_id');
            $table->unsignedBigInteger('sku_id');
            $table->integer('stok_baru')->nullable();
            $table->integer('stok_bekas')->nullable();
            $table->integer('update_stok_baru')->nullable();
            $table->integer('update_stok_bekas')->nullable();
            $table->timestamps();

            $table->foreign('history_id')->references('id')->on('history_stoks');
            $table->foreign('barang_id')->references('id')->on('barangs');
            $table->foreign('sku_id')->references('id')->on('skus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_stok_details');
    }
};
