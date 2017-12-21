<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeudasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deudas', function (Blueprint $table) {
            $table->increments('id');
            $table->double('precio', 10, 2);
            $table->integer('familia_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('familia_id')->references('id')->on('familias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('deudas');
    }
}
