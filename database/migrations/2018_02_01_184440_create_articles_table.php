<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_rubriks');
            $table->string('name_ru', 300);
            $table->string('name_en', 300);
            $table->longText('article');
            $table->string('image', 300)->nullable();
            $table->integer('on_main')->default(0);
            $table->integer('need_pay')->default(0);
            $table->string('image_620_300', 300)->nullable();
            $table->string('image_300_620', 300)->nullable();
            $table->integer('on_month')->default(0)->nullable();
            $table->integer('on_month_2')->default(0)->nullable();
            $table->integer('on_month_3')->default(0)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
