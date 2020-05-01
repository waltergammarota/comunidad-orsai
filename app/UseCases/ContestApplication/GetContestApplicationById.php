<?php


namespace App\UseCases\ContestApplication;

use App\Databases\ContestApplicationModel;
use App\Repositories\ContestApplicationRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use App\UseCases\GenericUseCase;
use App\User;

class GetContestApplicationById extends GenericUseCase
{

    private $propuestaId;

    public function __construct($propuestaId)
    {
        $this->propuestaId = $propuestaId;
        $this->userRepo = new UserRepository();
        $this->cpaRepo = new ContestApplicationRepository(
            new ContestApplicationModel(), $this->userRepo
        );
    }

    public function execute()
    {
        return $this->cpaRepo->getDataFrom($this->propuestaId);
    }

}
