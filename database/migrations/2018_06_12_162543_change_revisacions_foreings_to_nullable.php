<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeRevisacionsForeingsToNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('revisacions', function (Blueprint $table) {
            $table->integer('medico_id')->unsigned()->nullable()->change();
            $table->integer('user_id')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('revisacions', function (Blueprint $table) {
            $table->integer('medico_id')->unsigned()->change();
            $table->integer('user_id')->unsigned()->change();
        });
    }
}
