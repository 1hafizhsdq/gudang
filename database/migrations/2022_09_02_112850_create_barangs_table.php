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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_id');
            $table->unsignedBigInteger('satuan_id');
            $table->string('kode_barang')->nullable();
            $table->string('nama_barang')->nullable();
            $table->string('merk')->nullable();
            $table->string('type')->nullable();
            $table->integer('stok_total')->nullable();
            $table->text('foto')->nullable();
            $table->timestamps();

            $table->foreign('kategori_id')->references('id')->on('kategoris');
            $table->foreign('satuan_id')->references('id')->on('satuans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangs');
    }
};
