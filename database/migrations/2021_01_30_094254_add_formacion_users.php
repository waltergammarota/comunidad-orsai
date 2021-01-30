<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFormacionUsers extends Migration
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
            'users',
            function (Blueprint $table) {
                $table->string('empresa')->default('')->after('linkedin');
                $table->string('ocupacion')->default('[]')->after('empresa');
                $table->string('formacion')->default('[]')->after('empresa');
                $table->string('sector')->default('')->after('empresa');
                $table->string('idiomas')->default('[]')->after('empresa');
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
        Schema::table(
            'users',
            function (Blueprint $table) {
                $table->dropColumn('empresa');
                $table->dropColumn('ocupacion');
                $table->dropColumn('formacion');
                $table->dropColumn('sector');
                $table->dropColumn('idiomas');
            }
        );
    }
}
