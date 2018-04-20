<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('phone')->unique();
            $table->string('type')->default('user')->comment('user-пользователь сайта, farmer-производитель, trader-трейдер');
            $table->string('i_name')->nullable();
            $table->string('o_name')->nullable();
            $table->string('f_name')->nullable();
            $table->string('email')->nullable();
            $table->string('company')->nullable();
            $table->string('short_company')->nullable();
            $table->string('range_pay')->nullable();
            $table->string('status_pay')->default('notpaid')->comment('paid, notpaid');
            $table->string('status_activity')->default('active')->comment('active, inactive');
            $table->string('type_data')->default('normal');

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
        Schema::dropIfExists('clients');
    }
}
