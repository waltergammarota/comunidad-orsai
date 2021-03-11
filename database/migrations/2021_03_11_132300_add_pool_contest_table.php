<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPoolContestTable extends Migration
{
    public function up()
    {
        Schema::table('contests', function (Blueprint $table) {
            $table->unsignedBigInteger("pool_id")->default(0);
        });
    }

    public function down()
    {
        Schema::table('contests', function (Blueprint $table) {
            $table->dropColumn('pool_id');
        });
    }
}
