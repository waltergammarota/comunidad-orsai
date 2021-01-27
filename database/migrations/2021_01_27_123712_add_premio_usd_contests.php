<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPremioUsdContests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'contests',
            function (Blueprint $table) {
                $table->integer('amount_usd')->default(0)->after('amount_winner');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table(
            'contests',
            function (Blueprint $table) {
                $table->dropColumn('amount_usd');
            }
        );
    }
}
