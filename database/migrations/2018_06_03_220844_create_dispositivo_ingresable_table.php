<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDispositivoIngresableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dispositivo_ingresable', function (Blueprint $table) {
            $table->integer('dispositivo_id')->unsigned();
            $table->foreign('dispositivo_id')->references('id')->on('dispositivos')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->morphs('ingresable');

            $table->timestamps();

            $table->primary(['dispositivo_id', 'ingresable_id', 'ingresable_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dispositivo_ingresable');
    }
}
