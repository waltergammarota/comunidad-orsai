<?php


namespace App\UseCases\ContestApplication;

use App\Classes\ContestApplication;
use App\Classes\User;
use App\Databases\ContestApplicationModel;
use App\Exceptions\CpaException;
use App\Repositories\ContestApplicationRepository;
use App\Repositories\UserRepository;
use App\UseCases\GenericUseCase;

/**
 * @property ContestApplicationRepository $cpaRepo
 */
class CountContestApplication extends GenericUseCase
{
    public function __construct($contestId)
    {
        $this->userRepo = new UserRepository();
        $this->cpaRepo = new ContestApplicationRepository(
            new ContestApplicationModel(),
            $this->userRepo
        );
        $this->contestId = $contestId;
    }

    public function execute()
    {
        return $this->cpaRepo->countCpas($this->contestId);
    }
}
