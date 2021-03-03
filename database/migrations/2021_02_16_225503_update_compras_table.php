<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table(
            'compras',
            function (Blueprint $table) {
                $table->string('status')->default("")->after('datos');
                $table->string('payment_id')->after('status');
                $table->text('external_reference')->after('payment_id');
                $table->text('payment_type')->after('payment_id');
                $table->text('order_id')->after('payment_type');
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
        //
        Schema::table('compras',
            function (Blueprint $table) {
                $table->dropColumn('status');
                $table->dropColumn('payment_id');
                $table->dropColumn('external_reference');
                $table->dropColumn('payment_type');
                $table->dropColumn('order_id');
            }
        );
    }
}
