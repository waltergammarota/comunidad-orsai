<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateContestApplication extends Migration
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
                $table->integer('prize_amount')->default(0)->after('is_winner');
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
                $table->dropColumn('prize_amount');
            }
        );
    }
}
