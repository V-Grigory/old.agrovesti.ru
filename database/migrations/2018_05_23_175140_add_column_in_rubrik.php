<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnInRubrik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rubriks', function (Blueprint $table) {
            $table->integer('on_main')->default(0);
            $table->integer('position_number')->default(0);
            $table->integer('template_number')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rubriks', function (Blueprint $table) {
            $table->dropColumn('on_main');
            $table->dropColumn('position_number');
            $table->dropColumn('template_number');
        });
    }
}
