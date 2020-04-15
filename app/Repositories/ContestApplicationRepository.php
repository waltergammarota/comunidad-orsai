<?php


namespace App\Repositories;

use App\Classes\ContestApplication;
use App\Databases\ContestApplicationModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ContestApplicationRepository extends GenericRepository
{
    private $model;
    private $userRepo;

    public function __construct(
        ContestApplicationModel $contestApplicactionModel,
        UserRepository $userRepo = null
    ) {
        $this->model = $contestApplicactionModel;
        $this->userRepo = $userRepo;
    }

    public function save(ContestApplication $contestApplication)
    {
        $contestApplicationDB = new ContestApplicationModel(
            [
                "title" => $contestApplication->getTitle(),
                "description" => $contestApplication->getDescription(),
                "link" => $contestApplication->getLink(),
                "user_id" => $contestApplication->getUser()->getId(),
                "contest_id" => $contestApplication->getContest()->getId()
            ]
        );
        $contestApplicationDB->save();
        $images = $contestApplication->getImages();
        $logo = $contestApplication->getLogo();
        $pdf = $contestApplication->getPdf();
        $imagesIds = $this->getIds($images);
        $logosIds = $this->getIds($logo);
        $pdfIds = $this->getIds($pdf);
        $contestApplicationDB->images()->sync($imagesIds);
        $contestApplicationDB->logos()->sync($logosIds);
        $contestApplicationDB->pdfs()->sync($pdfIds);
        $contestApplication->setId($contestApplicationDB->id);
        $contestApplication->setCreatedAt($contestApplicationDB->created_at);
        $contestApplication->setUpdatedAt($contestApplicationDB->updated_at);
        return $contestApplication;
    }

    private function getIds($objects)
    {
        $ids = [];
        foreach ($objects as $object) {
            $id = $object->getId();
            array_push($ids, $id);
        }
        return $ids;
    }

    public function saveApproval(ContestApplication $cpa)
    {
        $cpaDB = $this->model->find($cpa->getId());
        $cpaDB->approve_in = true;
        $cpaDB->approved_by_user = $cpa->getApprovedBy()->getId();
        $cpaDB->approved_in = Carbon::now();
        $cpaDB->save();
    }

    public function find($id)
    {
        $cpaDB = $this->model->find($id);
        $cpa = new ContestApplication();
        $cpa->setId($cpaDB->id);
        return $cpa;
    }

    public function countCpas($contestId)
    {
        return DB::table('contest_applications')->where(
            "contest_id",
            $contestId
        )->count();
    }

    public function findApplicationByUser($userId, $contestId)
    {
        $cpaDB = ContestApplicationModel::where(
            ["user_id" => $userId, "contest_id" => $contestId]
        )->first();
        if ($cpaDB) {
            return [
                "cpa_id" => $cpaDB->id,
                "title" => $cpaDB->title,
                "description" => $cpaDB->title,
                "link" => $cpaDB->title,
                "user_id" => $cpaDB->user_id,
                "contest_id" => $cpaDB->contest_id,
                "approved" => $cpaDB->approved,
                "approvedBy" => $cpaDB->approved_by_user,
            ];
        }
        return [
            "id" => 0,
            "title" => "",
            "description" => "",
            "link" => "",
            "user_id" => $userId,
            "contest_id" => $contestId,
            "approved" => null,
            "approvedBy" => null,
        ];
    }


}
