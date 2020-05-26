<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\User;

class AddMoreDatesContestTable extends Migration
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
                $table->timestamp('votes_end_date')->default(now())->after('end_date');
                $table->integer('min_apps_qty')->default(10)->after('votes_end_date');
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
                $table->dropColumn('votes_end_date');
                $table->dropColumn('min_apps_qty');
            }
        );
    }
}
