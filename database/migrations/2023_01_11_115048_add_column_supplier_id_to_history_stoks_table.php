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
            $table->bigInteger('supplier_id')->nullable();
            $table->bigInteger('client_id')->nullable();
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
            $table->dropColumn('supplier_id');
            $table->dropColumn('client_id');
        });
    }
};
