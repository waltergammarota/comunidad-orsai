<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRequiredAmountContestsTable extends Migration
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
                $table->integer('required_amount')->default(0)->after('cant_winners');
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
        Schema::table(
            'contests',
            function (Blueprint $table) {
                $table->dropColumn('required_amount');
            }
        );
    }
}
