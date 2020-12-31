<?php

use App\Databases\ContestModel;
use Illuminate\Database\Migrations\Migration;

class UpdateContestLogo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $firstContest = 1;
        $contest = ContestModel::find($firstContest);
        $contest->bajada_corta = "";
        $contest->bajada_completa = "";
        $contest->start_app_date = $contest->start_date;
        $contest->end_app_date = $contest->end_upload_app;
        $contest->start_vote_date = $contest->start_date;
        $contest->end_vote_date = $contest->votes_end_date;
        $contest->image = 0;
        $contest->type = 3;
        $contest->mode = 3;
        $contest->per_winner = json_encode(array_fill(0, 4, 0));
        $contest->amount_winner = 0;
        $contest->cant_winners = 0;
        $contest->cant_caracteres = 240;
        $contest->cant_capitulos = 0;
        $contest->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
