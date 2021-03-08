<?php

use App\Databases\FormModel;
use App\Databases\InputModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateFormCuentoCorto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $form = new FormModel();
        $form->name = "Form cuento corto";
        $form->title = "Cuento corto";
        $form->description = "cuento corto";
        $form->save();
        // LEIT MOTIV
        $leitMotiv = new InputModel();
        $leitMotiv->form_id = $form->id;
        $leitMotiv->name = "Leit Motiv - cuento corto";
        $leitMotiv->title = "Leit motiv";
        $leitMotiv->description = "Si tuvieras que vendernos tu cuento en una frase corta, ¿qué pondrías?";
        $leitMotiv->tutorial = "https://www.youtube.com/watch?v=A9ThfU5JnEw";
        $leitMotiv->counter_type = "word";
        $leitMotiv->counter_max = 12;
        $leitMotiv->type = "input";
        $leitMotiv->options = [];
        $leitMotiv->placeholder = "[TEXTO]";
        $leitMotiv->save();
        // DESCRIPCION
        $descripcion = new InputModel();
        $descripcion->form_id = $form->id;
        $descripcion->name = "Descripción - cuento corto";
        $descripcion->title = "Descripción";
        $descripcion->description = "Explicá tu cuento en un tuit, pero sin espoilers.";
        $descripcion->tutorial = "";
        $descripcion->counter_type = "char";
        $descripcion->counter_max = 280;
        $descripcion->type = "input";
        $descripcion->options = [];
        $descripcion->placeholder = "[PÁRRAFO]";
        $descripcion->save();
        // NUBE DE TAGS
        $nube = new InputModel();
        $nube->form_id = $form->id;
        $nube->name = "Nube de tags - cuento corto";
        $nube->title = "Nube de tags";
        $nube->description = "Agregá hasta cinco palabras que orienten tu historia.";
        $nube->tutorial = "";
        $nube->counter_type = "words";
        $nube->counter_max = 5;
        $nube->type = "nube";
        $nube->placeholder = "";
        $nube->options = [];
        $nube->save();
        // CATEGORIA
        $categoria = new InputModel();
        $categoria->form_id = $form->id;
        $categoria->name = "categoria - cuento corto";
        $categoria->title = "Categoría";
        $categoria->description = "Ayudá a que el jurado encuentre tu cuento por tema.";
        $categoria->tutorial = "";
        $categoria->counter_type = "none";
        $categoria->counter_max = 0;
        $categoria->type = "select";
        $categoria->options = [
            "Opción 1", "Opción 2", "Opción 3"
        ];
        $categoria->placeholder = "";
        $categoria->save();
        // TITULO DEL CUENTO
        $titulo = new InputModel();
        $titulo->form_id = $form->id;
        $titulo->name = "Titulo - cuento corto";
        $titulo->title = "Título del cuento";
        $titulo->description = "Acá te dejamos a solas (que la inspiración te ayude).";
        $titulo->tutorial = "";
        $titulo->counter_type = "char";
        $titulo->counter_max = 72;
        $titulo->type = "input";
        $titulo->options = [];
        $titulo->placeholder = "[TEXTO]";
        $titulo->save();
        // CUENTO
        $cuento = new InputModel();
        $cuento->form_id = $form->id;
        $cuento->name = "cuento - cuento corto";
        $cuento->title = "El cuento";
        $cuento->description = "No permitimos estilos ni HTML para que no te distraigas.";
        $cuento->tutorial = "";
        $cuento->counter_type = "word";
        $cuento->counter_max = 600;
        $cuento->type = "textarea";
        $cuento->options = [];
        $cuento->placeholder = "[PÁRRAFO]";
        $cuento->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('inputs')->truncate();
        DB::table('forms')->truncate();
    }
}
