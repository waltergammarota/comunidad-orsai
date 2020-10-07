<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreferencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preferencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("user_id");
            $table->integer('plataforma')->default(0);
            $table->integer('correo')->default(0);
            $table->string('idioma')->default('Español');
            $table->string('moneda')->default('Pesos');
            $table->string('pago')->default('Paypal');
            $table->string('zona')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table(
            'preferencias',
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
        Schema::dropIfExists('preferencias');
    }
}
