<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEspecialsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('especials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->double('precio');
            $table->integer('cantidad');
            $table->tinyInteger('date')->nullable()->default(0);
            $table->integer('porDia')->nullable();
            $table->boolean('limite')->default(false);
            $table->boolean('renovable')->default(false);
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
        Schema::drop('especials');
    }
}
