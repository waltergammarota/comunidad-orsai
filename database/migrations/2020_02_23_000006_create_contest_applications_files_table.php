<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\User;

class CreateContestApplicationsFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'contest_applications_files',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('cap_id');
                $table->unsignedBigInteger('file_id');
                $table->timestamps();
                $table->softDeletes();
            }
        );

        Schema::table(
            'contest_applications_files',
            function (Blueprint $table) {
                $table->foreign('cap_id')->references('id')->on('contest_applications');
                $table->foreign('file_id')->references('id')->on('files');
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
        Schema::dropIfExists('contest_applications_files');
    }

}
