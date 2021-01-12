<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class deleteUsersPhones extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:delete-phones';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes users phones numbers so they can start the validation process';

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
        DB::table('users')->update([
            "phone_verified_at" => null,
            "prefijo" => 0,
            "whatsapp" => null,
            "code" => 0,
            "sms_sent_at" => null,
            "socio_fundador" => 0
        ]);
    }
}
