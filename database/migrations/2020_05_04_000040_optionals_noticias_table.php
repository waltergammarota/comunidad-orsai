<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use App\User;

class OptionalsNoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("alter table contenidos modify slug varchar(191) null;");
        DB::statement("alter table contenidos modify autor varchar(191) null;");
        DB::statement("alter table contenidos modify copete text null;");
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("alter table contenidos modify slug varchar(191) not null;");
        DB::statement("alter table contenidos modify autor varchar(191) not null;");
        DB::statement("alter table contenidos modify copete text not null;");
    }

}
