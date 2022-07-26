<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCierresTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cierres', function (Blueprint $table) {
            $table->increments('id');
            $table->date('at');

            $table->integer('cerrador_id')->unsigned()->nullable();
            $table->foreign('cerrador_id')->references('id')->on('users');
            $table->integer('caja_id')->unsigned()->nullable();
            $table->foreign('caja_id')->references('id')->on('cajas');

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
        Schema::drop('cierres');
    }
}
