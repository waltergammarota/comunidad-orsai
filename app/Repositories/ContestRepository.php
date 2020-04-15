<?php


namespace App\Repositories;


use App\Classes\Contest;
use App\Databases\ContestModel;
use Illuminate\Support\Facades\DB;

class ContestRepository extends GenericRepository
{
    private $contestModel;

    public function __construct(ContestModel $contestModel)
    {
        $this->contestModel = $contestModel;
    }

    public function save(Contest $contest)
    {
        $this->contestModel->name = $contest->getName();
        $this->contestModel->start_date = $contest->getStartDate();
        $this->contestModel->end_date = $contest->getEndDate();
        $this->contestModel->user_id = $contest->getUser()->getId();
        if ($contest->getId() != null && $contest->getId() > 0) {
            $this->contestModel->id = $contest->getId();
            $this->contestModel->exists = true;
        }
        $this->contestModel->save();
        return $this->mapDBPropsToContestClass($this->contestModel, $contest);
    }

    private function mapDBPropsToContestClass(
        ContestModel $contestModel,
        Contest $oldContest
    ) {
        return $this->mapDBToClass($contestModel, $oldContest);
    }

    public function deleteAllContests()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('contests')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function find($id)
    {
        $contestModel = ContestModel::find($id);
        $userRepo = new UserRepository();
        $user = $userRepo->find($contestModel->user_id);
        $contest = new Contest($contestModel->name, $contestModel->start_date, $contestModel->end_date, $user);
        $contest->setId($contestModel->id);
        $contest->setCreatedAt($contestModel->created_at);
        $contest->setUpdatedAt($contestModel->updated_at);
        return $contest;
    }

}
