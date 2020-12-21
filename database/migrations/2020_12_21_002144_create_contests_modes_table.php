<?php

use App\Databases\ContestsModo;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestsModesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contests_modes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });
        $pozo = new ContestsModo();
        $pozo->name = 'pozo';
        $pozo->save();
        $completo = new ContestsModo();
        $completo->name = 'completo';
        $completo->save();
        $fijo = new ContestsModo();
        $fijo->name = 'fijo';
        $fijo->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contests_modes');
    }
}
