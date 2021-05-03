<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAnswersVotesTable extends Migration
{
    public function up()
    {
        Schema::table('answers_votes', function (Blueprint $table) {
            $table->integer('order')->default(1);
            $table->index('order');
        });
    }

    public function down()
    {
        Schema::table('answers_votes', function (Blueprint $table) {
            $table->dropIndex('order');
            $table->dropColumn('order');
        });
    }
}
