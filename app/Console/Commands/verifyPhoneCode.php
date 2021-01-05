<?php

namespace App\Console\Commands;

use App\Databases\InfoBipModel;
use Illuminate\Console\Command;

class verifyPhoneCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:verify';

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
        $code = 858233;
        $response = $smsSender->verifyCode($code, 2);
        $this->info($response);
    }
}
