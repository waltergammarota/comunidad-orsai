<?php

namespace App\Console\Commands;

use App\User;
use App\Notifications\GenericNotification;
use App\Databases\ContestModel;
use App\Databases\ContestApplicationModel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class SendReminderApplication extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:application';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a reminder application';

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
        $contests = ContestModel::whereBetween('end_app_date',[Carbon::now()->addHour(-48),Carbon::now()->addHour(-47)])->get();

        foreach ($contests as $contest) {
            $cpas = ContestApplicationModel::where('contest_id', $contest->id)->get();

            foreach ($cpas as $cpa) {
                $app = ContestApplicationModel::find($cpa->id);

                if ($app->getCurrentStatus() == "draft") {

                    $user = User::find($cpa->user_id);

                    $this->sendNotification($user, $cpa->id);
                }
            }
        }
    }


    private function sendNotification($user, $cap_id)
    {
        $href = url('postulacion') . '/' . $cap_id;

        $notification = new \stdClass();
        $notification->subject = "Postulación #" . $cap_id ." Pendiente";
        $notification->title = "¡Tenés una postulación pendiente de envío!";
        $notification->description = "<p>Terminá de editarla para participar del Concurso. <a href='" . $href . "'>Hacelo desde acá</a></p>";
        $notification->button_url = '';
        $notification->button_text = '';
        $notification->user_id = 1;
        $notification->deliver_time = Carbon::now();
        $notification->id = 0;

        Notification::send($user, new GenericNotification($notification));
    }

}
