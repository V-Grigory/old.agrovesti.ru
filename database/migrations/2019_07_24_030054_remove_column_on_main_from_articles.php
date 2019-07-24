<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnOnMainFromArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
			Schema::table('articles', function (Blueprint $table) {
				$table->dropColumn('on_main');
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
				$table->integer('on_main')->default(0);
			});
			// после возврата, проставить on_main
			// update articles set on_main = 1 where features like '%on_main_in_old_site%'
    }
}
