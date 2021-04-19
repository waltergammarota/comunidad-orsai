<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderRondasTable extends Migration
{
    public function up()
    {
        Schema::table('rondas', function (Blueprint $table) {
            $table->integer('order')->default(0)->after('solapa');
        });
    }

    public function down()
    {
        Schema::table('rondas', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
}
