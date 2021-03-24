<?php


namespace App\Console\Commands;

use App\Databases\Transaction;
use App\User;
use Illuminate\Console\Command;

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
        User::whereNotNull('email_verified_at')->chunk(100, function ($users) {
            foreach ($users as $user) {
                $txs = Transaction::where('to', $user->id)->where('type', 'MINT')->get();
            }
        });
    }
}
