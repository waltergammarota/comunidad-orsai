<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'transactions',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('from');
                $table->unsignedBigInteger('to');
                $table->enum('type', ['MINT','BURN', 'TRANSFER']);
                $table->integer('amount');
                $table->integer('cap_id')->nullable();
                $table->text('data');
                $table->timestamps();
                $table->softDeletes();
            }
        );

        Schema::table(
            'transactions',
            function (Blueprint $table) {
                $table->foreign('from')->references('id')->on('users');
                $table->foreign('to')->references('id')->on('users');
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
        Schema::dropIfExists('transactions');
    }
}
