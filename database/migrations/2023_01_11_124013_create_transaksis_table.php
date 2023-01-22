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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->integer('status')->comment('1=masuk,2=keluar');
            $table->string('no_surat_jalan');
            $table->date('tanggal');
            $table->integer('asal_tujuan')->comment('1=project,2=gudang,3=client');
            $table->bigInteger('project_id')->nullable();
            $table->bigInteger('supplier_id')->nullable();
            $table->bigInteger('client_id')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('driver')->nullable();
            $table->string('nopol')->nullable();
            $table->string('penerima')->nullable();
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
        Schema::dropIfExists('transaksis');
    }
};
