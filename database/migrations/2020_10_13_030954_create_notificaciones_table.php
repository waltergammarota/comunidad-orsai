<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('subject')->nullable();
            $table->text('title')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('deliver_time')->nullable();
            $table->string('button_url')->nullable();
            $table->string('button_text')->nullable();
            $table->integer('mail')->nullable()->default(0);
            $table->integer('database')->nullable()->default(0);
            $table->longText('users')->nullable();
            $table->integer('template')->default(1);
            $table->integer('status')->default(0);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table(
            'notificaciones',
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
        Schema::dropIfExists('notificaciones');
    }
}
