<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnFromArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['image_620_300', 'image_300_620', 'on_month', 'on_month_2', 'on_month_3']);
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
            $table->string('image_620_300', 300)->nullable();
            $table->string('image_300_620', 300)->nullable();
            $table->integer('on_month')->default(0)->nullable();
            $table->integer('on_month_2')->default(0)->nullable();
            $table->integer('on_month_3')->default(0)->nullable();
        });
    }
}
