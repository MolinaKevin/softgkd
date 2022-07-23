<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameMetodoPagosInMovimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movimientos', function (Blueprint $table) {
            $table->dropForeign(['metodo_pagos_id']);
            $table->dropColumn('metodo_pagos_id');
			$table->integer('metodo_pago_id')->unsigned()->nullable();
            $table->foreign('metodo_pago_id')->references('id')->on('metodo_pagos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movimientos', function (Blueprint $table) {
            $table->dropForeign(['metodo_pago_id']);
            $table->dropColumn('metodo_pago_id');
        });
    }
}
