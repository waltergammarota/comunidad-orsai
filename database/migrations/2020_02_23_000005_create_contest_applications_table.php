<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\User;

class CreateContestApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'contest_applications',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('title');
                $table->string('description');
                $table->string('link')->nullable();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('contest_id');
                $table->unsignedBigInteger('approved_by_user')->nullable();
                $table->boolean('approved')->default(false);
                $table->dateTime('approved_in')->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );

        Schema::table(
            'contest_applications',
            function (Blueprint $table) {
                $table->foreign('contest_id')->references('id')->on('contests');
                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('approved_by_user')->references('id')->on('users');
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
        Schema::dropIfExists('contest_applications');
    }

}
