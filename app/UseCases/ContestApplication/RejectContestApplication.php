<?php


namespace App\UseCases\ContestApplication;

use App\Classes\ContestApplication;
use App\Classes\User;
use App\Databases\ContestApplicationModel;
use App\Exceptions\CpaException;
use App\Repositories\ContestApplicationRepository;
use App\Repositories\UserRepository;
use App\UseCases\GenericUseCase;

class RejectContestApplication extends GenericUseCase
{
    public function __construct($userId, $cpaId, $comment)
    {
        $this->userRepo = new UserRepository();
        $this->comment = $comment;
        $this->userId = $userId;
        $this->user = $this->userRepo->find($userId);
        $this->cpaId = $cpaId;
        $this->cpaRepo = new ContestApplicationRepository(new ContestApplicationModel(), $this->userRepo);
    }

    public function execute()
    {
        if ($this->canRejectCpa($this->user)) {
            $this->cpaRepo->saveReject($this->cpaId, $this->userId);
            return $this->cpa;
        }
        throw new CpaException('User can not approve cpas - 40002', 40002);
    }

    private function canApproveCpa(User $user)
    {
        $action = "reject_cpa";
        return $user->can($action);
    }
}
