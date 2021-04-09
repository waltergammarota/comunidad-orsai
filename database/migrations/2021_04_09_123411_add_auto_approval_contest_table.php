<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAutoApprovalContestTable extends Migration
{
    public function up()
    {
        Schema::table('contests', function (Blueprint $table) {
            $table->integer('auto_approval')->default(0);
        });
    }

    public function down()
    {
        Schema::table('contests', function (Blueprint $table) {
            $table->dropColumn('auto_approval');
        });
    }
}
