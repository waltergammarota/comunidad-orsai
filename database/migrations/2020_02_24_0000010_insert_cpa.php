<?php

use App\Databases\ContestApplicationModel;
use App\Databases\CpaLog;
use App\Databases\FileModel;
use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;

use App\User;
use Illuminate\Support\Facades\DB;

class InsertCpa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $params = [
            "title" => "Test de postulación",
            "description" => "test de descripción",
            "link" => "https://example.com",
            "user_id" => 1,
            "contest_id" => 1,
        ];
        $cpa = new ContestApplicationModel($params);
        $cpa->save();
        $logo = new FileModel(
            [
                "type" => 'logo',
                'name' => '15e93c85f17012',
                'original_name' => '15e93c85f17012.jpeg',
                'extension' => 'jpeg',
                'size' => 100,
                'height' => 100,
                'width' => 100,
                'position' => 0,
            ]
        );
        $logo->save();
        $pdf = new FileModel(
            [
                "type" => 'pdf',
                'name' => '15e93c85f182f6',
                'original_name' => '15e93c85f182f6.pdf',
                'extension' => 'pdf',
                'size' => 100,
                'height' => 100,
                'width' => 100,
                'position' => 0
            ]
        );
        $pdf->save();
        $ids = [];
        for ($i = 0; $i < 5; $i++) {
            $cpaFile = new FileModel(
                [
                    "type" => 'image',
                    'name' => '15e93c85f0f3d8',
                    'original_name' => '15e93c85f0f3d8.jpeg',
                    'extension' => 'jpeg',
                    'size' => 100,
                    'height' => 100,
                    'width' => 100,
                    'position' => $i
                ]
            );
            $cpaFile->save();
            array_push($ids, $cpaFile->id);
        }
        $logoIds = [$logo->id];
        $pdfIds = [$pdf->id];
        $cpa->logos()->syncWithoutDetaching($logoIds);
        $cpa->pdfs()->syncWithoutDetaching($pdfIds);
        $cpa->images()->syncWithoutDetaching($ids);
        $cpaLog = new CpaLog(["cap_id"=> 1,"status" => 'draft']);
        $cpaLog->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('contest_applications')->truncate();
        DB::table('contest_applications_files')->truncate();
        DB::table('contest_applications_log')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
