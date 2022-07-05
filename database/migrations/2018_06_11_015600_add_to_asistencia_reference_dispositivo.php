<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToAsistenciaReferenceDispositivo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asistencias', function (Blueprint $table) {
            $table->dropColumn('actividad');
            $table->integer('dispositivo_id')->unsigned();
            $table->foreign('dispositivo_id')->references('id')->on('dispositivos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asistencias', function (Blueprint $table) {
            $table->dropForeign(['dispositivo_id']);
            $table->dropColumn('dispositivo_id');
            $table->string('actividad')->default('No especificado');
        });
    }
}
