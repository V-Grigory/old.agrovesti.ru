<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
			Schema::table('articles', function (Blueprint $table) {
				$table->string('tag')->nullable();
				$table->string('subtitle')->nullable();
				$table->string('title_introduce')->nullable();
			});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
			Schema::table('articles', function (Blueprint $table) {
				$table->dropColumn('tag');
				$table->dropColumn('subtitle');
				$table->dropColumn('title_introduce');
			});
    }
}
