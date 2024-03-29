<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTipoPagoToMetodoPagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('metodo_pagos', function (Blueprint $table) {
			$table->integer('tipo_pago_id')->unsigned()->nullable();
            $table->foreign('tipo_pago_id')->references('id')->on('tipo_pagos');
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
            $table->dropForeign(['tipo_pago_id']);
            $table->dropColumn('tipo_pago_id');
        });
    }
}
