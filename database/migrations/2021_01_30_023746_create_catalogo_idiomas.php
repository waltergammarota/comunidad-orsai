<?php

use App\Databases\IdiomasModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogoIdiomas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogo_idiomas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        $idiomas = [
            "Inglés",
            "Español",
            "Italiano",
            "Francés",
            "Portugués",
            "Alemán"
        ];

        foreach ($idiomas as $idioma) {
            $model = new IdiomasModel(["name" => $idioma]);
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
        Schema::dropIfExists('catalogo_idiomas');
    }
}
