<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngresableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingresables', function (Blueprint $table) {
            $table->integer('dispositivo_id')->unsigned()->nullable();
            $table->foreign('dispositivo_id')->references('id')->on('dispositivos')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->morphs('ingresable');

            $table->timestamps();

            $table->primary(['dispositivo_id', 'ingresable_id', 'ingresable_type'], 'dispositivo_ingresable_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ingresables');
    }
}
