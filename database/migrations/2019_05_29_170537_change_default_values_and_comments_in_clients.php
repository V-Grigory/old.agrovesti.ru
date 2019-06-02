<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDefaultValuesAndCommentsInClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {

            $table->string('status_activity')
                ->comment('Новый клиент, Пробный период, Активен, Заблокирован')
                ->default('Новый клиент')
                ->change();

            $table->string('status_pay')
                ->comment('Оплачено, Не оплачено')->default('Не оплачено')->change();

            $table->string('type')
                ->comment('Подписчик, Производитель, Трейдер')->default('Подписчик')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('status_activity')->comment('')->default('')->change();
            $table->string('status_pay')->comment('')->default('')->change();
            $table->string('type')->comment('')->default('')->change();
        });
    }
}