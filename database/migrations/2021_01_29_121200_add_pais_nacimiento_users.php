<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaisNacimientoUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'users',
            function (Blueprint $table) {
                $table->string('birth_country')->nullable()->after('birth_date');
                $table->string('passport')->nullable()->after('lastName');
                $table->string('linkedin')->nullable()->after('instagram');
                $table->string('portfolio')->nullable()->after('instagram');
                $table->string('web')->nullable()->after('instagram');
                $table->string('medium')->nullable()->after('instagram');
                $table->string('redes')->nullable()->after('instagram');
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
            'users',
            function (Blueprint $table) {
                $table->dropColumn('birth_country');
                $table->dropColumn('passport');
                $table->dropColumn('linkedin');
                $table->dropColumn('portfolio');
                $table->dropColumn('web');
                $table->dropColumn('medium');
                $table->dropColumn('redes');
            }
        );
    }
}
