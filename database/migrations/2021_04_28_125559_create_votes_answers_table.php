<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers_votes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('answer_id');
            $table->unsignedBigInteger('cap_id');
            $table->unsignedBigInteger('form_id');
            $table->unsignedBigInteger('contest_id');
            $table->unsignedBigInteger('input_id');
            $table->integer('amount');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table(
            'answers_votes',
            function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('cap_id')->references('id')->on('contest_applications');
                $table->foreign('answer_id')->references('id')->on('answers');
                $table->index('form_id');
                $table->index('contest_id');
                $table->index('input_id');
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
        Schema::dropIfExists('answers_votes');
    }
}
