<?php


namespace App\UseCases;

use App\Classes\Contest;
use App\Classes\CreateContestException;
use App\Classes\User;
use App\Repositories\ContestRepository;

class CreateContest extends GenericUseCase
{

    private $contest;
    private $contestRepository;


    public function __construct(
        \stdClass $contestData,
        ContestRepository $contestRepository
    ) {

        $this->contest = new Contest($contestData->name, $contestData->startDate, $contestData->endDate, $contestData->user);
        $this->contestRepository = $contestRepository;
    }

    public function execute()
    {
        $user = $this->contest->getUser();
        if($this->canCreateContest($user)) {
            return $this->contestRepository->save($this->contest);
        }
        throw new CreateContestException();
    }

    private function canCreateContest(User $user) {
        $action = "create_contest";
        return $user->can($action);
    }


}
