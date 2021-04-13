<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContestsTablePaymentValue extends Migration
{
    public function up()
    {
        Schema::table('contests', function (Blueprint $table) {
            $table->string('token_value');
        });
    }

    public function down()
    {
        Schema::table('contests', function (Blueprint $table) {
            $table->dropColumn('token_value');
        });
    }
}
