<?php

namespace App\Console\Commands;

use App\User;
use App\Notifications\GenericNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class SendReminderDonate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:donate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a reminder donate';

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
        $users = User::whereNotNull('email_verified_at')->whereBetween('email_verified_at',[Carbon::now()->addDays(-90),Carbon::now()->addDays(-89)])->get();

        $array = [];

        foreach ($users as $user) {
            $usr = User::find($user->id);
            $this->sendNotification($usr);

            $array[] = [$user->id, $user->email, $user->created_at];
        }

        $startDateTime = Carbon::now()->addDays('-90');
        $endDateTime = Carbon::now()->addDays('-89');

        print_r(json_encode([$startDateTime,$endDateTime,$array]));
    }


    private function sendNotification($user)
    {
        $href = url('donar');

        $notification = new \stdClass();
        $notification->subject = "Sumá tu donación";
        $notification->title = "¡Sumá tu donación!";
        $notification->description = "<p>Sumá tu donación a Comunidad Orsai para que la rueda de proyectos culturales siga girando. <a href='" . $href . "'>Hacelo desde acá</a></p>";
        $notification->button_url = '';
        $notification->button_text = '';
        $notification->user_id = 1;
        $notification->deliver_time = Carbon::now();
        $notification->id = 0;

        Notification::send($user, new GenericNotification($notification));
    }

}
