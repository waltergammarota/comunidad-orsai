<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContestApplicationsChapters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contest_applications_chapters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title');
            $table->longText('body');
            $table->integer('orden');
            $table->unsignedBigInteger('cap_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table(
            'contest_applications_chapters',
            function (Blueprint $table) {
                $table->foreign('cap_id')->references('id')->on('contest_applications');
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
        Schema::dropIfExists('contest_applications_chapters');
    }
}
