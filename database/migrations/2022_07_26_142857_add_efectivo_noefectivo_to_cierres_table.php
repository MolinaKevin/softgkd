<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEfectivoNoefectivoToCierresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cierres', function (Blueprint $table) {
            $table->double('efectivo');
            $table->double('noEfectivo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cierres', function (Blueprint $table) {
            $table->dropColumn('efectivo');
            $table->dropColumn('noEfectivo');
        });
    }
}
