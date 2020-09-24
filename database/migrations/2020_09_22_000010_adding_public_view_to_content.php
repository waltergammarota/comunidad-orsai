<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use App\User;

class AddingPublicViewToContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'contenidos',
            function (Blueprint $table) {
                $table->integer('publica')->default(0)->after('visible');
            }
        );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'contenidos',
            function (Blueprint $table) {
                $table->dropColumn('publica');
            }
        );
    }
}
