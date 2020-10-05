<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use App\User;

class ModifiesPoolName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->where('id', 1)->update(["name" => "Comunidad Orsai", "lastName" => "Comunidad Orsai", "userName" => "Comunidad Orsai"]);
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')->where('id', 1)->update(["name" => "pool", "lastName" => "pool", "userName" => "pool"]);
    }
}
