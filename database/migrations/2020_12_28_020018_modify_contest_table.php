<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyContestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'contests',
            function (Blueprint $table) {
                $table->text('bajada_corta')->default("")->after('name')->nullable();
                $table->longText('bajada_completa')->default("")->after('bajada_corta')->nullable();
                $table->timestamp('start_app_date')->after('end_date')->nullable();
                $table->timestamp('end_app_date')->after('start_app_date')->nullable();
                $table->timestamp('start_vote_date')->after('end_app_date')->nullable();
                $table->timestamp('end_vote_date')->after('start_vote_date')->nullable();
                $table->unsignedBigInteger('image')->after('end_vote_date');
                $table->unsignedBigInteger('type')->after('image');
                $table->integer('cant_capitulos')->default(1)->after('type');
                $table->integer('cant_caracteres')->default(240)->after('type');
                $table->unsignedBigInteger('mode')->after('type');
                $table->integer('cant_winners')->after('mode');
                $table->text('per_winner')->after('mode');
                $table->integer('amount_winner')->after('per_winner');
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
            'contests',
            function (Blueprint $table) {
                $table->dropColumn('bajada_corta');
                $table->dropColumn('bajada_completa');
                $table->dropColumn('start_app_date');
                $table->dropColumn('end_app_date');
                $table->dropColumn('start_vote_date');
                $table->dropColumn('end_vote_date');
                $table->dropColumn('image');
                $table->dropColumn('type');
                $table->dropColumn('cant_capitulos');
                $table->dropColumn('cant_caracteres');
                $table->dropColumn('mode');
                $table->dropColumn('cant_winners');
                $table->dropColumn('per_winner');
                $table->dropColumn('amount_winner');
            }
        );
    }
}
