<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('descripcion');
            $table->dropColumn('display_name');
            $table->dropColumn('estado');
            $table->dropColumn('estado');
            $table->text('description')->nullable();
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->string('slug')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('slug');
            $table->dropColumn('description');
            $table->string('display_name')->nullable();
            $table->string('descripcion')->nullable();
            $table->boolean('estado')->default(0);
        });
    }
}
