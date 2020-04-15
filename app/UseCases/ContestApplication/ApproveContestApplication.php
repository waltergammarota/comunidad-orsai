<?php


namespace App\UseCases\ContestApplication;


use App\Classes\ContestApplication;
use App\Classes\User;
use App\Databases\ContestApplicationModel;
use App\Exceptions\CpaException;
use App\Repositories\ContestApplicationRepository;
use App\Repositories\UserRepository;
use App\UseCases\GenericUseCase;

class ApproveContestApplication extends GenericUseCase
{
    public function __construct($user_id, $cpa_id)
    {
        $this->userRepo = new UserRepository();
        $this->cpaRepo = new ContestApplicationRepository(
            new ContestApplicationModel(), $this->userRepo
        );
        $this->cpa = $this->cpaRepo->find($cpa_id);
        $this->user = $this->userRepo->find($user_id);
    }

    public function execute()
    {
        if ($this->canApproveCpa($this->user)) {
            $this->cpa->setAsApprovedBy($this->user);
            $this->cpaRepo->saveApproval($this->cpa);
            return $this->cpa;
        }
        throw new CpaException('User can not approve cpas - 40002', 40002);
    }

    private function canApproveCpa(User $user)
    {
        $action = "approve_cpa";
        return $user->can($action);
    }
}
