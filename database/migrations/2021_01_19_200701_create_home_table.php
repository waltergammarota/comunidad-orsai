<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('home', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('description')->nullable();
        });  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('home', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->dropColumn('description'); 
        });
    }
}
