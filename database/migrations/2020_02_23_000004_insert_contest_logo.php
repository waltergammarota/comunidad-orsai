<?php

use App\Databases\ContestModel;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;

use App\User;

class InsertContestLogo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $params = [
            "name" => "Concurso Logo",
            "start_date" => Carbon::createFromFormat('Y-m-d','2020-03-01'),
            "end_date" => Carbon::createFromFormat('Y-m-d','2020-12-01'),
            "active" => true,
        ];
        $contest = new ContestModel($params);
        $contest->user_id = 1;
        $contest->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        ContestModel::destroy(1);
    }
}
