<?php

use App\Databases\SectorModel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogoSectores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogo_sectores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
            $table->softDeletes();
        });

        $sectores = [
            "ABASTECIMIENTO Y LOGÍSTICA",
            "ADMINISTRACIÓN",
            "ADMINISTRACIÓN, CONTABILIDAD Y FINANZAS",
            "ADUANA Y COMERCIO EXTERIOR",
            "AÉREO",
            "AGROPECUARIO",
            "ALIMENTACIÓN",
            "AMBIENTE",
            "ARQUITECTURA",
            "ARTE Y CULTURA",
            "ARTESANAL",
            "ATENCIÓN AL CLIENTE, CALL CENTER Y TELEMARKETING",
            "AUTOMOTRIZ",
            "BANCA / FINANCIERA",
            "BIOTECNOLOGÍA",
            "COMERCIAL, VENTAS Y NEGOCIOS",
            "COMERCIO EXTERIOR",
            "COMUNICACIÓN",
            "COMUNICACIONES",
            "CONSTRUCCIÓN",
            "CONSULTORÍA",
            "CONSUMO MASIVO",
            "DISEÑO",
            "EDITORIAL",
            "EDUCACIÓN, DOCENCIA E INVESTIGACIÓN",
            "ENERGÍA",
            "ENTRETENIMIENTO",
            "FINANCIERO",
            "GANADERÍA",
            "GASTRONOMÍA",
            "GOBIERNO",
            "HIGIENE Y SEGURIDAD",
            "HOTELERÍA",
            "IMPRENTA",
            "INDUSTRIAL",
            "INGENIERÍAS",
            "INMOBILIARIA",
            "IT, SISTEMAS Y TELECOMUNICACIONES",
            "JURÍDICO / LEGALES",
            "LEGALES",
            "MARKETING Y PUBLICIDAD",
            "MEDIOS",
            "MINERÍA / PETRÓLEO / GAS",
            "OFICIOS",
            "ONG",
            "OTRO",
            "PAPELERO",
            "PESCA",
            "PRODUCCIÓN Y MANUFACTURA",
            "QUÍMICA",
            "RETAIL",
            "RRHH",
            "SALUD, MEDICINA Y FARMACIA",
            "SECRETARIA Y RECEPCIÓN",
            "SEGURIDAD",
            "SEGUROS",
            "SEGUROS",
            "SIDERURGIA",
            "TELECOMUNICACIONES",
            "TEXTIL",
            "TRANSPORTE",
            "TURISMO",
            "TURISMO",
        ];

        foreach ($sectores as $sector) {
            $model = new SectorModel(["name" => $sector]);
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
        Schema::dropIfExists('catalogo_sectores');
    }
}
