<?php

namespace App\Controllers;


use App\Classes\ContestApplication;
use App\Databases\ContestApplicationModel;
use App\Databases\ContestModel;
use App\Repositories\ContestApplicationRepository;
use App\Repositories\ContestRepository;
use App\Repositories\FileRepository;
use App\Repositories\UserRepository;
use App\UseCases\ContestApplication\CreateContestApplication;
use Illuminate\Http\Request;

class CreateContestApplicationController {

    private $createContestApplication;

    public function __construct($data, Request $request)
    {
        $userRepository = new UserRepository();
        $contestRepository = new ContestRepository(new ContestModel());
        $contestApplicationRepository = new ContestApplicationRepository(new ContestApplicationModel());
        $fileRepository = new FileRepository();
        $this->createContestApplication = new CreateContestApplication($data, $request, $userRepository, $contestRepository,$contestApplicationRepository, $fileRepository);
    }

    public function execute() {
        $cpa = $this->createContestApplication->execute();
        return $cpa->getId();
    }
}
