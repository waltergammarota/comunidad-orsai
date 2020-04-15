<?php


namespace App\UseCases\ContestApplication;

use App\Databases\ContestApplicationModel;
use App\Repositories\ContestApplicationRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use App\UseCases\GenericUseCase;
use App\User;

class TotalContestApplicationTokens extends GenericUseCase
{
    public function __construct()
    {
       $this->txRepo = new TransactionRepository(new UserRepository());
    }

    public function execute()
    {
        return $this->txRepo->getTotalSupply();
    }

}
