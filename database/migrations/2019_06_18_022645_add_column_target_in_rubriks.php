<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTargetInRubriks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
			Schema::table('rubriks', function (Blueprint $table) {
				$table->string('target')->default('old_site');
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
				$table->dropColumn('target');
			});
    }
}
