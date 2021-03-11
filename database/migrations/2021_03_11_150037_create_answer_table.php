<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('form_id');
            $table->unsignedBigInteger('contest_id');
            $table->unsignedBigInteger('input_id');
            $table->unsignedBigInteger('cap_id');
            $table->unsignedBigInteger('user_id');
            $table->longText('answer');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table(
            'answers',
            function (Blueprint $table) {
                $table->foreign('form_id')->references('id')->on('forms');
                $table->foreign('contest_id')->references('id')->on('contests');
                $table->foreign('input_id')->references('id')->on('inputs');
                $table->foreign('cap_id')->references('id')->on('contest_applications');
                $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('answers');
    }
}
