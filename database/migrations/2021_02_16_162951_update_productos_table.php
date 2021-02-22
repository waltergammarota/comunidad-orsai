<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductosTable extends Migration
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
            'productos',
            function (Blueprint $table) {
                $table->integer('dynamic_price')->default(0)->after('price');
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
            'productos',
            function (Blueprint $table) {
                $table->dropColumn('dynamic_price');
            }
        );
    }
}
