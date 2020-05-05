<?php

use App\Databases\ContestModel;
use App\Databases\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;

use App\User;

class InsertTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $params = [
            "from" => 1,
            "to" => 3,
            "type" => 'MINT',
            "amount" => 750,
            "data" => "welcome"
        ];
        $tx = new Transaction($params);
        $tx->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Transaction::destroy(1);
    }
}
