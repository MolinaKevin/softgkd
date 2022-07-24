<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCajeableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('cajeables', function (Blueprint $table) {
            $table->integer('caja_id')->unsigned()->nullable();
            $table->foreign('caja_id')->references('id')->on('cajas')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->morphs('cajeable');

            $table->timestamps();

            $table->primary(['caja_id', 'cajeable_id', 'cajeable_type'], 'caja_cajeable_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cajeables');
    }
}
