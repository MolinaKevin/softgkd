<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFamiliaIdFieldForPagablesPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pagos', function (Blueprint $table) {
            $table->dropForeign(['familia_id']);
            $table->dropColumn('familia_id');
            $table->morphs('pagable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pagos', function (Blueprint $table) {
            $table->dropColumn('pagable_id');
            $table->dropColumn('pagable_type');
            $table->integer('familia_id')->unsigned();
            $table->foreign('familia_id')->references('id')->on('familias');
        });
    }
}
