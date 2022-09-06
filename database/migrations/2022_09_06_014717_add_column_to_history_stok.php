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
        Schema::table('history_stoks', function (Blueprint $table) {
            $table->date('tanggal')->nullable();
            $table->text('deskripsi')->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->string('driver')->nullable();
            $table->string('nopol')->nullable();
            $table->string('penerima')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('history_stoks', function (Blueprint $table) {
            //
        });
    }
};
