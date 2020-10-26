<?php

namespace App\Console\Commands;

use App\Databases\NotificacionModel;
use App\Databases\PreferenciasModel;
use App\Notifications\GenericMailNotification;
use App\Notifications\GenericNotification;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class checkNotificaciones extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notificaciones:monitor';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Monitors notifications to send if any';

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
        $notifications = NotificacionModel::where('deliver_time', '<=', Carbon::now())->where('status', 0)->get();
        $this->info(json_encode(["cantidad" => count($notifications)]));
        foreach ($notifications as $notification) {
            $notification->status = 1;
            $notification->save();
            $this->sendPlatformNotifications($notification);
            $this->sendMailNotifications($notification);
            $notification->status = 2;
            $notification->save();
        }
    }

    private function sendPlatformNotifications($notification)
    {
        if ($notification->database == 1) {
            $listUsers = json_decode($notification->users);
            if (count($listUsers) == 1 && $listUsers[0] == 0) {
                $this->info(json_encode(["notification_id" => $notification->id, "users" => "all", "type" => "database"]));
                $preferencias = PreferenciasModel::where('plataforma', 1)->with('owner')->get();
                foreach ($preferencias as $preferencia) {
                    $user = $preferencia->owner;
                    if ($user != null) {
                        $this->info(json_encode(["user" => $user->id]));
                        Notification::send($user, new GenericNotification($notification));
                    }
                }
            }
        }
    }

    private function sendMailNotifications($notification)
    {
        if ($notification->mail == 1) {
            $listUsers = json_decode($notification->users);
            if (count($listUsers) == 1 && $listUsers[0] == 0) {
                $this->info(json_encode(["notification_id" => $notification->id, "users" => "all", "type" => "mail"]));
                $preferencias = PreferenciasModel::where('correo', 1)->with('owner')->get();
                foreach ($preferencias as $preferencia) {
                    $user = $preferencia->owner;
                    if ($user != null && $user->email_verified_at != null) {
                        $this->info(json_encode(["user" => $user->id]));
                        Notification::send($user, new GenericMailNotification($notification));
                    }
                }
            }
        }
    }


}
