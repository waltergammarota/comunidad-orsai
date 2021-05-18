<?php

namespace App\Console\Commands;

use App\Databases\ContestApplicationModel;
use App\Databases\ContestModel;
use App\Databases\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class checkWinners extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contests:winners';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check winners of contests';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $contests = ContestModel::where('end_date', '<', Carbon::now())->where('winner_check', 0)->get();
        foreach ($contests as $contest) {
            $this->info($contest->name . " " . $contest->id . " " . $contest->mode);
            switch ($contest->mode) {
                case 1:
                    $this->info("pozo");
                    $pozo = User::find($contest->pool_id)->getBalance();
                    $winnersDistribution = json_decode($contest->per_winner);
                    $cpas = ContestApplicationModel::where('contest_id', $contest->id)->orderBy('votes', 'DESC')->take($contest->cant_winners)->get();
                    foreach ($cpas as $cpa) {
                        $counter = 0;
                        $cpa->is_winner = 1;
                        $prizeAmount = round($pozo * $winnersDistribution[$counter] / 100, 0);
                        $cpa->prize_amount = $prizeAmount;
                        $cpa->prize_percentage = $winnersDistribution[$counter];
                        $cpa->save();
                        $data = "Ganador concurso {$contest->name}";
                        $tx = new Transaction(
                            [
                                "from" => $contest->pool_id,
                                "to" => $cpa->user_id,
                                "amount" => $prizeAmount,
                                "type" => "TRANSFER",
                                "data" => $data
                            ]
                        );
                        $tx->save();
                        $counter++;
                        $this->info("user: {$cpa->user_id} - prize: {$prizeAmount}");
                    }
                    $contest->winner_check = 1;
                    $contest->save();
                    Transaction::createTransaction(1, $contest->pool_id, $pozo, "Finalización concurso {$contest->name}", null, "BURN", ["concurso: {$contest->id}"]);
                    break;
                case 2:
                    $this->info("completo");
                    $pozo = User::find($contest->pool_id)->getBalance();
                    $cpas = ContestApplicationModel::where('contest_id', $contest->id)->where('votes', '>=', $contest->required_amount)->get();
                    foreach ($cpas as $cpa) {
                        $cpa->is_winner = 1;
                        $cpa->prize_amount = $contest->prize_amount;
                        $cpa->save();
                    }
                    $contest->winner_check = 1;
                    $contest->save();
                    Transaction::createTransaction(1, $contest->pool_id, $pozo, "Finalización concurso {$contest->name}", null, "BURN", ["concurso: {$contest->id}"]);
                    break;
                case 3:
                    $this->info("fijo");
                    $pozo = User::find($contest->pool_id)->getBalance();
                    $cpa = ContestApplicationModel::where('contest_id', $contest->id)->max('votes');
                    if ($cpa) {
                        $cpa->is_winner = 1;
                        $cpa->prize_amount = $contest->prize_amount;
                        $cpa->save();
                    }
                    $contest->winner_check = 1;
                    $contest->save();
                    Transaction::createTransaction(1, $contest->pool_id, $pozo, "Finalización concurso {$contest->name}", null, "BURN", ["concurso: {$contest->id}"]);
                    break;
            }
        }
    }
}
