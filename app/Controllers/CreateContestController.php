<?php


namespace App\Controllers;

use App\Classes\Contest;
use App\Databases\ContestModel;
use App\Repositories\ContestRepository;
use App\Repositories\UserRepository;
use App\UseCases\CreateContest;
use Carbon\Carbon;

class CreateContestController
{
    private $contestData;
    private $contestRepository;
    private $userRepository;

    public function __construct(Array $contestData)
    {
        $this->contestData = $contestData;
        $this->contestRepository = new ContestRepository(new ContestModel());
        $this->userRepository = new UserRepository();
    }

    public function execute() {
        $newContest = $this->createContest();
        return $this->present($newContest);
    }

    private function present(Contest $contest) {
        return [
            "id" => $contest->getId()
        ];
    }

    /**
     * @return Contest
     * @throws \App\Classes\CreateContestException
     */
    public function createContest(): Contest
    {
        $contestData = new \stdClass();
        $contestData->startDate = new Carbon($this->contestData['start_date']);
        $contestData->endDate = new Carbon($this->contestData['end_date']);
        $contestData->name = $this->contestData['name'];
        $contestData->user = $this->userRepository->find(
            $this->contestData['user_id']
        );
        $newCreateContest = new CreateContest(
            $contestData,
            $this->contestRepository
        );
        $newContest = $newCreateContest->execute();
        return $newContest;
    }


}
