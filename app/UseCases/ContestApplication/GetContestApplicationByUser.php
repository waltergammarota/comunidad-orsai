<?php


namespace App\UseCases\ContestApplication;

use App\Databases\ContestApplicationModel;
use App\Repositories\ContestApplicationRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use App\UseCases\GenericUseCase;
use App\User;

class GetContestApplicationByUser extends GenericUseCase
{
    public function __construct($userId, $contestId)
    {
        $this->userRepo = new UserRepository();
        $this->userId = $userId;
        $this->contestId = $contestId;
        $this->cpaRepo = new ContestApplicationRepository(new ContestApplicationModel(), $this->userRepo);
    }

    public function execute()
    {
        return $this->cpaRepo->findApplicationByUser($this->userId, $this->contestId);
    }

}
