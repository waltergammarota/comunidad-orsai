<?php

use App\Databases\ContestsType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestsTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contests_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
        });
        $narrativaCorta = new ContestsType();
        $narrativaCorta->name = 'narrativa corta';
        $narrativaCorta->save();
        $narrativaLarga = new ContestsType();
        $narrativaLarga->name = 'narrativa larga';
        $narrativaLarga->save();
        $imagen = new ContestsType();
        $imagen->name = 'imagen';
        $imagen->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contests_types');
    }
}
