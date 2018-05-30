<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterNombresHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('horarios', function (Blueprint $table) {
            $table->dropColumn('dia');
        });
        Schema::table('horarios', function (Blueprint $table) {
            $table->enum('dia', ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('horarios', function (Blueprint $table) {
            $table->dropColumn('dia');
        });
        Schema::table('horarios', function (Blueprint $table) {
            $table->enum('dia', ['SUNDAY','MONDAY','TUESDAY','WEDNESDAY','THURSDAY','FRIDAY','SATURDAY']);
        });
    }
}
