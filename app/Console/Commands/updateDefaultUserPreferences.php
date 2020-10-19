<?php

namespace App\Console\Commands;

use App\Databases\PreferenciasModel;
use App\User;
use Illuminate\Console\Command;

class updateDefaultUserPreferences extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:update-default-preferences';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates default users preferences';

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
        $users = User::all();
        foreach ($users as $user) {
            $this->createDefaultPreference($user);
        }
    }

    /**
     * @param $user
     */
    public function createDefaultPreference($user)
    {
        $hasPreferencias = PreferenciasModel::where('user_id', $user->id)->count();
        if ($hasPreferencias == 0) {
            $preferencia = new PreferenciasModel([
                "plataforma" => 1,
                "correo" => 1,
                "idioma" => "Español",
                "moneda" => "Peso Argentino (ARS)",
                "pago" => "Mercado Pago Argentina",
                "zona" => "America/Argentina/Buenos_Aires",
            ]);
            $preferencia->user_id = $user->id;
            $preferencia->save();
            $this->info(json_encode(["user" => $user->id]));
        }
    }
}
