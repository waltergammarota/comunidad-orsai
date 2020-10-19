<?php

namespace App\Console\Commands;

use App\User;
use App\Utils\Mailer;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SendReminderActivationEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:activation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a reminder mail to all users that have no activate their accounts';

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
        $lastId = $this->getLastId();
        $users = User::where("email_verified_at", null)->where("created_at", "<=", Carbon::now()->subDays(5))->where('id', '>', $lastId)->get();
        $array = [];
        $mailer = new Mailer();
        foreach ($users as $user) {
            $token = md5($user->id . $user->email . $user->created_at);
            $data = [
                "email" => $user->email,
                "name" => $user->name,
                "lastName" => $user->lastName,
                "subject" => "Activá tu cuenta para ser miembro de la Comunidad",
                "mensaje" => "Registrate",
                "token" => $token
            ];
            $mailer->sendReminderActivationEmail($data);
            array_push($array, $user->email);
            $lastId = $user->id;
        }
        DB::table('activation_control')
            ->updateOrInsert(
                [
                    'user_id' => $lastId,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
        $this->info(json_encode($array));

    }

    private function getLastId()
    {
        $row = DB::table('activation_control')->latest()->first();
        $this->info(json_encode($row));
        return $row == null ? 0 : $row->user_id;
    }
}
