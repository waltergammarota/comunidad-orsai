<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFechaMoneyTransactions extends Migration
{
    public function up()
    {
        Schema::table('transactions_money', function (Blueprint $table) {
            $table->timestamp('fecha');
        });
    }

    public function down()
    {
        Schema::table('transactions_money', function (Blueprint $table) {
            $table->dropColumn('fecha');
        });
    }
}
