<?php


namespace App\Console\Commands;

use App\Databases\BaldeoModel;
use App\Databases\ContestModel;
use App\Databases\Transaction;
use App\Notifications\GenericNotification;
use Illuminate\Support\Facades\Notification;
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
                        $isPozo = ContestModel::isPool($user->id);
                        if ($isPozo) {
                            $this->info("Is Pozo {$user->id}");
                            continue;
                        }
                        $balance = $user->getBalance();
                        $amount = round(floor($balance * env("PORCENTAJE_BALDEO", 10) / 100), 0);
                        $poolOrsai = 1;
                        $minimo = env('MORDIDA_MINIMO', 10);
                        if ($amount > $minimo) {
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

                        $this->sendNotification($user->id);
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


    private function sendNotification($userId)
    {
        $href = url('mis-fichas');
        $user = User::find($userId);

        $notification = new \stdClass();
        $notification->subject = "Aviso Baldeo";
        $notification->title = "¡Ojo, que se viene un baldeo!";
        $notification->description = "<p><a href='" . $href . "'>Revisá la fecha de vencimiento de tus fichas.</a></p>";
        $notification->button_url = '';
        $notification->button_text = '';
        $notification->user_id = 1;
        $notification->deliver_time = Carbon::now();
        $notification->id = 0;

        Notification::send($user, new GenericNotification($notification));
    }


    private function hasBeenRun($month, $year)
    {
        $isAny = BaldeoModel::where("month", $month)->where("year", $year)->count();
        $this->info("Found: {$isAny}");
        return $isAny > 0;
    }
}
