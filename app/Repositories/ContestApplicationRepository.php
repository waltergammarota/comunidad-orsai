<?php


namespace App\Repositories;

use App\Classes\ContestApplication;
use App\Databases\ContestApplicationModel;
use App\Databases\CpaLog;
use App\Databases\FileModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        $cpaLog = new CpaLog(
            [
                'status' => 'sent',
                'cap_id' => $contestApplicationDB->id
            ]
        );
        $cpaLog->save();
        $contestApplicationDB->images()->syncWithoutDetaching($imagesIds);
        $contestApplicationDB->logos()->syncWithoutDetaching($logosIds);
        $contestApplicationDB->pdfs()->syncWithoutDetaching($pdfIds);
        $contestApplication->setId($contestApplicationDB->id);
        $contestApplication->setCreatedAt($contestApplicationDB->created_at);
        $contestApplication->setUpdatedAt($contestApplicationDB->updated_at);
        return $contestApplication;
    }

    public function update(
        $cpaId,
        ContestApplication $contestApplication,
        Request $request
    ) {
        $contestApplicationDB = ContestApplicationModel::find($cpaId);
        $contestApplicationDB->title = $contestApplication->getTitle();
        $contestApplicationDB->description = $contestApplication->getDescription(
        );
        $contestApplicationDB->link = $contestApplication->getLink();
        $images = $contestApplication->getImages();
        $logo = $contestApplication->getLogo();
        $pdf = $contestApplication->getPdf();
        $imagesIds = $this->getIds($images);
        $logosIds = $this->getIds($logo);
        $pdfIds = $this->getIds($pdf);
        $contestApplicationDB->images()->syncWithoutDetaching($imagesIds);
        $contestApplicationDB->logos()->syncWithoutDetaching($logosIds);
        $contestApplicationDB->pdfs()->syncWithoutDetaching($pdfIds);
        $this->removePdf($request->pdf_deleted, $contestApplicationDB);
        $this->removeChangedImages($request, "images", $contestApplicationDB);
        $this->removeChangedLogo($request, "logo", $contestApplicationDB);
        //$this->removeChangedPdf($request, "pdf", $contestApplicationDB);
        $contestApplicationDB->save();
        $cpaLog = new CpaLog(
            [
                'status' => 'sent',
                'cap_id' => $contestApplicationDB->id
            ]
        );
        $cpaLog->save();
        return $contestApplicationDB->id;
    }

    private function removeChangedImages(Request $request, $type, $cpaDB)
    {
        $images = $cpaDB->images()->orderBy('id')->get();
        $uploaded = $request->file($type) ? $request->file($type) : [];
        foreach ($uploaded as $key => $file) {
            if ($file->isValid()) {
                if (isset($images[$key])) {
                    $imageToDelete = $images[$key];
                    $cpaDB->images()->detach($imageToDelete->id);
                    FileModel::destroy($imageToDelete->id);
                }
            }
        }
    }

    private function removePDf($deleteCommand, $cpaDB)
    {
        if ($deleteCommand == 1) {
            $pdf = $cpaDB->pdfs()->orderBy('id')->get()->first();
            $cpaDB->pdfs()->detach($pdf->id);
            FileModel::destroy($pdf->id);
        }
    }


    private function removeChangedPdf(Request $request, $type, $cpaDB)
    {
        $pdfs = $cpaDB->pdfs()->orderBy('id')->get();
        $uploaded = $request->file($type) ? $request->file($type) : [];
        foreach ($uploaded as $key => $file) {
            if ($file->isValid()) {
                $pdfToDelete = $pdfs[$key];
                $cpaDB->pdfs()->detach($pdfToDelete->id);
                FileModel::destroy($pdfToDelete->id);
            }
        }
    }

    private function removeChangedLogo(Request $request, $type, $cpaDB)
    {
        $logos = $cpaDB->logos()->orderBy('id')->get();
        $uploaded = $request->file($type) ? $request->file($type) : [];
        foreach ($uploaded as $key => $file) {
            if ($file->isValid()) {
                $imageToDelete = $logos[$key];
                $cpaDB->logos()->detach($imageToDelete->id);
                FileModel::destroy($imageToDelete->id);
            }
        }
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

    public function getDataFrom($id) {
        $cpaDB = $this->model->find($id);
        $data = $cpaDB->toArray();
        $data['logos'] = $cpaDB->logos()->orderBy('position')->get()->toArray();
        $data['images'] = $cpaDB->images()->orderBy('position')->get()->toArray();
        $data['pdfs'] = $cpaDB->pdfs()->orderBy('position')->get()->toArray();
        $data['owner'] = $cpaDB->owner()->first()->toArray();
        $data['current_status'] = CpaLog::where("cap_id", $id)->latest()->first()->status;
        return $data;
    }

    public function countCpas($contestId)
    {
        return DB::table('contest_applications')->where(
            ["contest_id" => $contestId, "approved" => 1]
        )->count();
    }

    public function statusApplication($contestId, $userId)
    {
        $cantidad = ContestApplicationModel::where(
            ["user_id" => $userId, "contest_id" => $contestId]
        )->count();
        if ($cantidad > 0) {
            $cpaDB = $this->getCpaByUser($userId, $contestId);
            return [
                "id" => $cpaDB->id,
                "status" => $this->getCurrentStatus($cpaDB->id)
            ];
        }
        return ["id" => 0, "status" => false];
    }

    private function getCurrentStatus($cap_id)
    {
        $status = CpaLog::where("cap_id", $cap_id)->orderBy(
            'created_at',
            'desc'
        )->first()->status;

        return $status;
    }

    public function findApplicationByUser($userId, $contestId)
    {
        $cpaDB = $this->getCpaByUser($userId, $contestId);
        $status = $cpaDB->status()->first()->status;
        if ($cpaDB) {
            return [
                "cap_id" => $cpaDB->id,
                "cap_title" => $cpaDB->title,
                "cap_description" => $cpaDB->description,
                "cap_link" => $cpaDB->link,
                "cap_user_id" => $cpaDB->user_id,
                "cap_contest_id" => $cpaDB->contest_id,
                "cap_current_status" => $status,
                "cap_approved" => $cpaDB->approved,
                "cap_approvedBy" => $cpaDB->approved_by_user,
                'cap_images' => $this->convertFiles(
                    $cpaDB->images()->orderBy('position')->get()
                ),
                'cap_logos' => $this->convertFiles(
                    $cpaDB->logos()->orderBy('position')->get()
                ),
                'cap_pdfs' => $this->convertFiles(
                    $cpaDB->pdfs()->orderBy('position')->get()
                ),
            ];
        }
        return [
            "cap_id" => 0,
            "cap_title" => "",
            "cap_description" => "",
            "cap_link" => "",
            "cap_user_id" => $userId,
            "cap_contest_id" => $contestId,
            "cap_approved" => null,
            "cap_approvedBy" => null,
            "cap_current_status" => 'draft'
        ];
    }

    private function convertFiles($files)
    {
        $data = [];
        foreach ($files as $file) {
            $arrayFile = [
                "file_id" => $file->id,
                "file_name" => $file->name,
                "file_original_name" => $file->original_name,
                "file_extension" => $file->extension,
                "file_type" => $file->type,
            ];
            array_push($data, $arrayFile);
        }
        return $data;
    }

    /**
     * @param $userId
     * @param $contestId
     * @return mixed
     */
    private function getCpaByUser($userId, $contestId)
    {
        $cpaDB = ContestApplicationModel::where(
            ["user_id" => $userId, "contest_id" => $contestId]
        )->first();
        return $cpaDB;
    }


}
