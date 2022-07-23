<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameMetodoPagosInPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pagos', function (Blueprint $table) {
            $table->dropForeign('metodo_pagos_id');
            $table->renameColumn('metodo_pagos_id', 'metodo_pago_id');

            $table->foreign('metodo_pago_id')->references('id')->on('metodo_pagos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pagos', function (Blueprint $table) {
            $table->dropForeign('metodo_pago_id');
            $table->renameColumn('metodo_pago_id', 'metodo_pagos_id');

            $table->foreign('metodo_pagos_id')->references('id')->on('metodo_pagos')->onDelete('cascade');
        });
    }
}
