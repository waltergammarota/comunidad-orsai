<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('precio', 8, 2)->default(0);
            $table->unsignedBigInteger("user_id");
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table(
            'cotizacion',
            function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('cotizacion');
    }
}
