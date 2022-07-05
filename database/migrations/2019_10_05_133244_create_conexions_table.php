<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConexionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conexions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('concepto');

            $table->integer('dispositivo_id')->unsigned();
            $table->foreign('dispositivo_id')->references('id')->on('dispositivos');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('conexions');
    }
}
