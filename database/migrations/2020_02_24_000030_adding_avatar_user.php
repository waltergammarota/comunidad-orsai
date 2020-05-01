<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use App\User;

class AddingAvatarUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'users',
            function (Blueprint $table) {
                $table->unsignedBigInteger('avatar')->after('remember_token')->nullable();
            }
        );

        Schema::table(
            'users',
            function (Blueprint $table) {
                $table->foreign('avatar')->references('id')->on('files');
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
            'users',
            function (Blueprint $table) {
                $table->dropForeign('users_avatar_foreign');
                $table->dropColumn('avatar');
            }
        );
    }

}
