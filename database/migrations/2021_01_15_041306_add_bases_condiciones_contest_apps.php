<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBasesCondicionesContestApps extends Migration
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
                $table->dateTime('condiciones')->nullable()->before('votes');
                $table->dateTime('bases')->nullable()->before('votes');
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
                $table->dropColumn('condiciones');
                $table->dropColumn('bases');
            }
        );
    }
}