<?php


namespace App\Console\Commands;

use App\Databases\BaldeoModel;
use App\Databases\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Baldeo extends Command
{
    protected $signature = "baldeo:mes";

    protected $description = "makes the baldeo for every user";

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = Carbon::now();
        $month = $today->format('m');
        $year = $today->format('Y');
        if (env('BALDEO_ENABLED', FALSE)) {
            if (!$this->hasBeenRun($month, $year)) {
                $this->info("Running baldeo for {$month} - {$year}");
                User::whereNotNull('email_verified_at')->chunk(100, function ($users) use ($month, $year) {
                    $log = [];
                    foreach ($users as $user) {
                        $balance = $user->getBalance();
                        $amount = round(floor($balance * env("PORCENTAJE_BALDEO", 10) / 100), 0);
                        $poolOrsai = 1;
                        if ($amount > 10) {
                            Transaction::createTransaction(
                                $user->id,
                                $poolOrsai,
                                $amount,
                                "Baldeo del mes {$month} - {$year}",
                                null,
                                'TRANSFER',
                                ["baldeo: {$month}-{$year}"]);
                            array_push($log, [
                                "previous_balance" => $balance,
                                "user" => $user->id,
                                "burn_amount" => $amount,
                                "current_balance" => $user->getBalance(),
                                "porcentaje_baldeo" => env("PORCENTAJE_BALDEO", 10)
                            ]);
                        }
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
                $this->info("Baldeo has been run in {$month} {$year}");
            }
        } else {
            $this->info("Baldeo is not enabled");
        }
    }

    private function hasBeenRun($month, $year)
    {
        $isAny = BaldeoModel::where("month", $month)->where("year", $year)->count();
        $this->info("Found: {$isAny}");
        return $isAny > 0;
    }
}
