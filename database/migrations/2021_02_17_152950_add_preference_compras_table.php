<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPreferenceComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('compras', function (Blueprint $table) {
            $table->string('internal_id')->nullable()->after('external_reference');
            $table->string('payment_processor')->nullable()->after('payment_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('compras', function (Blueprint $table) {
            $table->dropColumn('internal_id');
            $table->dropColumn('payment_processor');
        });
    }
}
