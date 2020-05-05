<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\User;

class InsertAdminUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $params = [
            "name" => "pool",
            "lastName" => "pool",
            "userName" => "pool",
            "country" => "Argentina",
            "email" => "pool@gmail.com",
            "role" => "admin",
            "password" => password_hash("pool202@", PASSWORD_DEFAULT),
            "email_verified_at" => now()
        ];
        $user = new User($params);
        $user->save();

        $params = [
            "name" => "system",
            "lastName" => "admin",
            "userName" => "admin",
            "country" => "Argentina",
            "email" => "admin@gmail.com",
            "role" => "admin",
            "password" => password_hash("test", PASSWORD_DEFAULT),
            "email_verified_at" => now()
        ];
        $user = new User($params);
        $user->save();
        $params = [
            "name" => "test1",
            "lastName" => "user",
            "userName" => "user",
            "country" => "Argentina",
            "email" => "test1@test.com",
            "role" => "user",
            "password" => password_hash("test1", PASSWORD_DEFAULT),
            "email_verified_at" => now()
        ];
        $user = new User($params);
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        User::destroy(1);
        User::destroy(2);
    }
}
