<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSmsValidationUsersTable extends Migration
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
                $table->bigInteger('code')->default(0)->after('email_verified_at');
                $table->timestamp('phone_verified_at')->nullable()->after('code');
                $table->timestamp('sms_sent_at')->nullable()->after('phone_verified_at');
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('code');
            $table->dropColumn('phone_verified_at');
            $table->dropColumn('sms_sent_at');
        });
    }
}
