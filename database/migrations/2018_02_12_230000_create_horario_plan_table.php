<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorarioPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horario_plan', function (Blueprint $table) {
            $table->integer('plan_id')->unsigned();
            $table->integer('horario_id')->unsigned();

            $table->foreign('plan_id')->references('id')->on('plans')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('horario_id')->references('id')->on('horarios')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->timestamps();

            $table->primary(['plan_id', 'horario_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horario_plan');
    }
}
