<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrivacidadUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dateTime('terminos')->nullable();
            $table->dateTime('privacidad')->nullable();
            $table->dateTime('cookies')->nullable();
            $table->integer('anonimo')->default(0);

        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('terminos');
            $table->dropColumn('privacidad');
            $table->dateTime('cookies');
            $table->integer('anonimo');

        });
    }
}
