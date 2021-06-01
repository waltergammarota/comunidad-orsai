<?php


namespace App\Console\Commands;

use App\Databases\BaldeoModel;
use App\Databases\ContestModel;
use App\Databases\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Notifications\GenericNotification;
use Illuminate\Support\Facades\Notification;

class Mordida extends Command
{
    protected $signature = "mordida:dia";

    protected $description = "makes the mordida for every user every day";

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        if (env("MORDIDA_ENABLED", FALSE)) {
            User::whereNotNull('email_verified_at')->chunk(100,
                function ($users) {
                    $logs = [];
                    $contests = ContestModel::all();
                    DB::beginTransaction();
                    foreach ($users as $user) {
                        $isPozo = ContestModel::isPool($user->id);
                        if ($isPozo) {
                            $this->info("Is Pozo {$user->id}");
                            continue;
                        }
                        try {
                            $days = env('MORDIDA_DIAS', 90);
                            $query = Transaction::where('to', $user->id)
                                ->where('type', 'MINT')
                                ->whereDate('created_at', '<=', Carbon::now()->subDays($days)->format('Y-m-d H:i:s'))
                                ->where('processed', 0);
                            $mintAmount = $query->sum('amount');
                            if ($mintAmount > 0) {
                                $mintTxs = $query->get();
                                $this->info($mintTxs);
                                $burnQuery = Transaction::where(['to' => $user->id, 'type' => 'BURN', 'processed' => 0]);
                                $burnedAmount = $burnQuery->sum('amount');
                                $burnedTxs = $burnQuery->get();
                                $transferQuery = Transaction::where(['from' => $user->id, 'type' => 'TRANSFER', 'processed' => 0]);
                                $transferAmount = $transferQuery->sum('amount');
                                $transferTxs = $transferQuery->get();
                                $fecha = Carbon::now()->format('Y-m-d H:i:s');
                                $consumedAmount = $transferAmount + $burnedAmount + env('MORDIDA_MINIMO', 10);
                                $this->info($consumedAmount);
                                $this->info($mintAmount);
                                if ($mintAmount > $consumedAmount) {
                                    $tx = Transaction::createTransaction(1, $user->id, $mintAmount - $consumedAmount, "Mordida dia {$fecha}", null, 'BURN', ["mordida: {$fecha}"]);
                                    array_push($logs, $tx);
                                }
                                $this->sendNotification($user->id);
                                $this->markAsProcessed($burnedTxs);
                                $this->markAsProcessed($transferTxs);
                                $this->markAsProcessed($mintTxs);
                            }
                        } catch (\Exception $error) {
                            $this->info($error);
                            DB::rollBack();
                        }
                    }
                    DB::commit();
                });
        } else {
            $this->info("Mordida is not enabled");
        }
    }

    private function sendNotification($userId)
    {
        $href = url('mis-fichas');
        $user = User::find($userId);

        $notification = new \stdClass();
        $notification->subject = "Aviso Mordida";
        $notification->title = "¡Cuidado! Una mordida está cerca.";
        $notification->description = "<p><a href='" . $href . "'>Revisá el próximo vencimiento de tus fichas.</a></p>";
        $notification->button_url = '';
        $notification->button_text = '';
        $notification->user_id = 1;
        $notification->deliver_time = Carbon::now();
        $notification->id = 0;

        Notification::send($user, new GenericNotification($notification));
    }

    private function markAsProcessed($txs)
    {
        $txs->each(function ($tx) {
            $tx->processed = 1;
            $tx->save();
        });
    }
}

