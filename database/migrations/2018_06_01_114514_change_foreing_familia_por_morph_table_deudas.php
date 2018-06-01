<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeForeingFamiliaPorMorphTableDeudas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deudas', function (Blueprint $table) {
            $table->dropForeign(['familia_id']);
            $table->dropColumn('familia_id');
            $table->morphs('adeudable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deudas', function (Blueprint $table) {
            $table->dropIndex(["adeudable_id", "adeudable_type"]);
            $table->dropColumn("adeudable_type");
            $table->dropColumn("adeudable_id");
            $table->integer('familia_id')->unsigned()->nullable();
            $table->foreign('familia_id')->references('id')->on('familias');
        });
    }
}
