<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableFichasLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichas_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->longText('destinatarios');
            $table->bigInteger('cantidad_puntos');
            $table->integer('cantidad_users');
            $table->text('description');
            $table->string('tipo');
            $table->bigInteger('total_puntos');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table(
            'fichas_log',
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
        Schema::dropIfExists('fichas_log');
    }
}
