<?php

namespace App\Console\Commands;

use App\Databases\ContestApplicationModel;
use App\Databases\Transaction;
use App\User;
use Illuminate\Console\Command;

class CleanFakeEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:clean-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'blocks users given a domain and updates txs and applications';

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
        $emails = [
            "yopmail.com",
            "ngo1.com",
            "glenwoodave.com",
            "insertswork.com",
            "nedoz.com",
            "mozej.com",
            "mohmal.im",
            "nic58.com"
        ];
        foreach ($emails as $email) {
            $users = User::where('email', 'like', "%{$email}")->get();
            foreach ($users as $user) {
                $user->blocked = 1;
                $user->save();
                $this->info(json_encode(["user_id" => $user->id, "user_email" => $user->email, "blocked" => $user->blocked]));
                $transactions = Transaction::where('from', $user->id)->orWhere('to', $user->id)->get();
                foreach ($transactions as $tx) {
                    if ($tx->type == "TRANSFER" && $tx->cap_id > 0) {
                        $this->info(json_encode(["tx_id" => $tx->id, "cap_id" => $tx->cap_id]));
                        $cpa = ContestApplicationModel::withTrashed()->find($tx->cap_id);
                        $votes = $cpa->votes;
                        $cpa->votes = $cpa->votes - $tx->amount;
                        $cpa->save();
                        $this->info(json_encode(["cap_id" => $cpa->id, "amount" => $tx->amount, "votes_prev" => $votes, "votes" => $cpa->votes]));
                        Transaction::destroy($tx->id);
                    }
                }
                $this->info(json_encode(["user_id" => $user->id, "deleted" => 1]));
                User::destroy($user->id);
            }
            $this->info(count($users));
        }
    }

}
