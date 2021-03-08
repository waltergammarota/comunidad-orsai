<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCostsContestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contests', function (Blueprint $table) {
            $table->integer('cost_per_cpa')->default(0);
            $table->integer('cost_jury')->default(75);
            $table->integer('vote_limit')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('contests', function (Blueprint $table) {
            $table->dropColumn('cost_per_cpa');
            $table->dropColumn('cost_jury');
            $table->dropColumn('vote_limit');
        });
    }
}
