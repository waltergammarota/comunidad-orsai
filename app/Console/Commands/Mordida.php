<?php


namespace App\Console\Commands;

use App\Databases\BaldeoModel;
use App\Databases\Transaction;
use App\User;
use Illuminate\Console\Command;

class Baldeo extends Command
{
    protected $signature = "baldeo:mes {month} {year}";

    protected $description = "makes the baldeo for every user";

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $month = $this->argument("month");
        $year = $this->argument("year");
        if (env('BALDEO_ENABLED', FALSE)) {
            $this->info("Running baldeo for {$month} - {$year}");
            User::whereNotNull('email_verified_at')->chunk(100, function ($users) use ($month, $year) {
                $log = [];
                foreach ($users as $user) {
                    $balance = $user->getBalance();
                    $amount = round(floor($balance * env("PORCENTAJE_BALDEO", 10) / 100), 0);
                    $poolOrsai = 1;
                    if ($amount > 0) {
                        Transaction::createTransaction(
                            $user->id,
                            $poolOrsai,
                            $amount,
                            "Baldeo del mes {$month} - {$year}",
                            null,
                            'TRANSFER',
                            ["baldeo"]);
                    }
                    array_push($log, [
                        "previous_balance" => $balance,
                        "user" => $user->id,
                        "burn_amount" => $amount,
                        "current_balance" => $user->getBalance()
                    ]);
                }
                $baldeoLog = new BaldeoModel([
                    "log" => $log,
                    "type" => "baldeo",
                    "month" => $month,
                    "year" => $year
                ]);
                $baldeoLog->save();
            });
        } else {
            $this->info("Baldeo is not enabled");
        }
    }
}
