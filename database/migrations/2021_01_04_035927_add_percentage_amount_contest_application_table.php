<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPercentageAmountContestApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'contest_applications',
            function (Blueprint $table) {
                $table->integer('prize_percentage')->default(0)->after('prize_amount');
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
            'contest_applications',
            function (Blueprint $table) {
                $table->dropColumn('prize_percentage');
            }
        );
    }
}
