<?php

namespace App\Console\Commands;

use App\Databases\InfoBipModel;
use Illuminate\Console\Command;

class sendSMSToUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send sms to user';

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
        $smsSender = new InfoBipModel();
        $phone = "541136998080";
        $smsSender->verifyPhone($phone, 2);
    }
}
