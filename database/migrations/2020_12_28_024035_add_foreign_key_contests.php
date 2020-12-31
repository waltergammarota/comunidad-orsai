<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyContests extends Migration
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
                $table->foreign('type')->references('id')->on('contests_types');
                $table->foreign('mode')->references('id')->on('contests_modes');
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
                $table->dropForeign('contests_type_foreign');
                $table->dropForeign('contests_mode_foreign');
            }
        );
    }
}
