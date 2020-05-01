<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\User;

class AddingContestWinner extends Migration
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
                $table->integer('is_winner')->default(0)->after('approved_in');

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
                $table->dropColumn('is_winner');

            }
        );
    }

}
