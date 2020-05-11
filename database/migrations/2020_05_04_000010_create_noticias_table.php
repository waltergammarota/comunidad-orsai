<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\User;

class CreateNoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'contenidos',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('slug');
                $table->text('title');
                $table->string('autor');
                $table->date('fecha_publicacion');
                $table->text('copete');
                $table->enum('tipo', ['noticia', 'pagina']);
                $table->longText('texto');
                $table->unsignedBigInteger('user_id');
                $table->integer('visible')->default(0)->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );

        Schema::create(
            'contenido_files',
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('contenido_id');
                $table->unsignedBigInteger('file_id');
                $table->timestamps();
                $table->softDeletes();
            }
        );

        Schema::table(
            'contenidos',
            function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users');
            }
        );

        Schema::table(
            'contenido_files',
            function (Blueprint $table) {
                $table->foreign('contenido_id')->references('id')->on('contenidos');
                $table->foreign('file_id')->references('id')->on('files');
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
        Schema::dropIfExists('contenido_files');
        Schema::dropIfExists('contenidos');
    }

}
