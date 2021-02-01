<?php

use App\Databases\FormacionModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogoFormacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogo_formacion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        $formaciones = [
            "SECUNDARIO COMPLETO",
            "SECUNDARIO INCOMPLETO",
            "TERCIARIO COMPLETO",
            "TERCIARIO INCOMPLETO",
            "UNIVERSITARIO INCOMPLETO",
            "UNIVERSITARIO COMPLETO",
            "POSGRADO COMPLETO",
            "POGRADO INCOMPLETO",
            "MÁSTER COMPLETO",
            "MÁSTER INCOMPLETO",
            "DOCTORADO COMPLETO",
            "DOCTORADO INCOMPLETO",
            "OTRO",
        ];
        foreach ($formaciones as $formacion) {
            $model = new FormacionModel(["name" => $formacion]);
            $model->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalogo_formacion');
    }
}
