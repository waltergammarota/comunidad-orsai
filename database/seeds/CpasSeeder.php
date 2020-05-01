<?php

use App\Databases\ContestApplicationModel;
use App\Databases\CpaLog;
use App\Databases\FileModel;
use Illuminate\Database\Seeder;

class CpasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $limit = 5;
        for ($i = 0; $i < $limit; $i++) {
            $params = [
                "title" => $faker->sentence(
                    $nbWords = 6,
                    $variableNbWords = true
                ),
                "description" => $faker->paragraph(
                    $nbSentences = 1,
                    $variableNbSentences = true
                ),
                "link" => $faker->url,
                "user_id" => 2,
                "contest_id" => 1,
                "views" => rand(0,100),
                "votes" => rand(0,100),
                "approved_by_user" => 1,
                "approved" => 1,
                "approved_in" => now(),
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
            $cpaLog = new CpaLog(["cap_id" => $cpa->id, "status" => 'approved']);
            $cpaLog->save();
        }
    }
}
