<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NullablesEnAsistencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asistencias', function (Blueprint $table) {
            $table->dropForeign(['dispositivo_id']);
            $table->dropForeign(['user_id']);
            $table->integer('dispositivo_id')->unsigned()->nullable()->change();
            $table->integer('user_id')->unsigned()->nullable()->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('dispositivo_id')->references('id')->on('dispositivos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asistencias', function (Blueprint $table) {
            $table->dropForeign(['dispositivo_id']);
            $table->dropForeign(['user_id']);
            $table->integer('dispositivo_id')->unsigned()->change();
            $table->integer('user_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('dispositivo_id')->references('id')->on('dispositivos')->onDelete('cascade');
        });
    }
}
