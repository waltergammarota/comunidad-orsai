<?php

namespace App\Console\Commands;

use App\User;
use App\Notifications\GenericNotification;
use App\Databases\ContestModel;
use App\Databases\ContestApplicationModel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class SendReminderApplicationDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:applicationdaily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a reminder Public application';

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

        /* Cierre de postulaciones */
        $this->handleCloseApplications();

        /* Anuncio ganador de un concurso */
        $this->handleWinnerApplications();

        $contests = ContestModel::whereBetween('start_vote_date',[Carbon::now(),Carbon::now()->addHour(24)])->get();
        $users = User::whereNotNull('email_verified_at')->get();

        foreach ($contests as $contest) {
            $cpas = ContestApplicationModel::where('contest_id', $contest->id)->get();

            /* Postulación pública */
            foreach ($cpas as $cpa) {
                $app = ContestApplicationModel::find($cpa->id);

                if ($app->getCurrentStatus() == "approved") {
 
                    $href = url('concursos/' . $contest->id . '/' . $contest->getUrlName() . '/ronda/1?id='.$cpa->id);
               
                    $notification = new \stdClass();
                    $notification->subject = "Inicio de Votaciones";
                    $notification->title = "¡Compartí tu postulación!";
                    $notification->description = "<p>Compartí tu postulación y sumá fichas para ganar el ".$contest->name.".</p>";
                    $notification->button_url = $href;
                    $notification->button_text = 'Compartir mi postulación';
                    $notification->user_id = 1;
                    $notification->deliver_time = Carbon::now();
                    $notification->id = 0;

                    $this->sendNotification($cpa->user_id, $notification);
                }
            }

            /* Anuncio Votaciones abiertas */
            foreach ($users as $user) {
                $href = url('concursos/' . $contest->id . '/' . $contest->getUrlName() . '/ronda/1'); 

                $notification = new \stdClass();
                $notification->subject = "Votaciones abiertas";
                $notification->title = "Votaciones abiertas";
                $notification->description = "<p>Arrancan las apuestas del ". $contest->name .".<br/>¡Ponele fichas a las postulaciones que quieras!</p>";
                $notification->button_url = $href;
                $notification->button_text = 'Ir a Votaciones';
                $notification->user_id = 1;
                $notification->deliver_time = Carbon::now();
                $notification->id = 0;

                $this->sendNotification($user->id, $notification);
            }
        }
    }


    private function handleCloseApplications()
    {
        $contests = ContestModel::whereBetween('end_app_date',[Carbon::now()->addHour(-24),Carbon::now()])->get();
        $users = User::whereNotNull('email_verified_at')->get();

        foreach ($contests as $contest) {

            foreach ($users as $user) {
                $href = route('concursos-show', [$contest->id, preg_replace('/\s+/', '-', $contest->getUrlName())]);

                $notification = new \stdClass();
                $notification->subject = "Cierre Postulaciones";
                $notification->title = "¡Último día del Concurso!";
                $notification->description = "<p>Último día para participar en el " . $contest->name .".</p>";
                $notification->button_url = $href;
                $notification->button_text = 'Cargá tu postulación';
                $notification->user_id = 1;
                $notification->deliver_time = Carbon::now();
                $notification->id = 0;

                $this->sendNotification($user->id, $notification);
            }
        }
    }

    private function handleWinnerApplications()
    {
        $contests = ContestModel::whereBetween('end_vote_date',[Carbon::now()->addHour(-24),Carbon::now()])->get();
        $users = User::whereNotNull('email_verified_at')->get();

        foreach ($contests as $contest) {

            foreach ($users as $user) {
                $href = url('estadisticas/' . $contest->id . '/' . $contest->getUrlName());

                $notification = new \stdClass();
                $notification->subject = "Concurso Finalizado";
                $notification->title = "¡Concurso Finalizado!";
                $notification->description = "<p>Ya finalizó el ".$contest->name.".</p>";
                $notification->button_url = $href;
                $notification->button_text = 'Mirá quiénes ganaron';
                $notification->user_id = 1;
                $notification->deliver_time = Carbon::now();
                $notification->id = 0;

                $this->sendNotification($user->id, $notification);
            }
        }
    }

    private function sendNotification($userId, $notification)
    {
        $user = User::find($userId);
        Notification::send($user, new GenericNotification($notification));
    }
}
