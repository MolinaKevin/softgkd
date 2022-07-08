<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDefaultCashFalseMetodoPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('metodo_pagos', function (Blueprint $table) {
            $table->dropColumn('cash');
            $table->boolean('cash')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('metodo_pagos', function (Blueprint $table) {
            $table->dropColumn('cash');
            $table->boolean('cash');
        });
    }
}
