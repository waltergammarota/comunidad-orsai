<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSolapaRondasTable extends Migration
{
    public function up()
    {
        Schema::table('rondas', function (Blueprint $table) {
            $table->string('solapa')->default('')->after('contest_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rondas', function (Blueprint $table) {
            $table->dropColumn('solapa');
        });
    }
}
