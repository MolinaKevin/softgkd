<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEspecialHorarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especial_horario', function (Blueprint $table) {
            $table->integer('especial_id')->unsigned();
            $table->integer('horario_id')->unsigned();

            $table->foreign('especial_id')->references('id')->on('especials')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('horario_id')->references('id')->on('horarios')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();

            $table->primary(['especial_id', 'horario_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('especial_horario');
    }
}
