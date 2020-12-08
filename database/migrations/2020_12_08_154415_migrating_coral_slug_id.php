<?php

use App\Databases\ContenidoModel;
use Illuminate\Database\Migrations\Migration;

class MigratingCoralSlugId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $contenidos = ContenidoModel::all();
        foreach ($contenidos as $contenido) {
            $contenido->coral_id = $contenido->slug;
            $contenido->save();
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $contenidos = ContenidoModel::all();
        foreach ($contenidos as $contenido) {
            $contenido->coral_id = null;
            $contenido->save();
        }
    }
}
