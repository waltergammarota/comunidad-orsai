<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('producto_id');
            $table->float('amount');
            $table->text("datos");
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table(
            'compras',
            function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('producto_id')->references('id')->on('productos');
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
        Schema::dropIfExists('compras');
    }
}
