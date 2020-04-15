<?php


namespace App\UseCases\Contest;

use App\Classes\Contest;
use App\Classes\EditContestException;
use App\Classes\User;
use App\Repositories\ContestRepository;

class StartContest extends GenericUseCase
{

    private $id;
    private $contestRepository;


    public function __construct(
        $id,
        User $user,
        ContestRepository $contestRepository
    ) {
        $this->id = $id;
        $this->user = $user;
        $this->contestRepository = $contestRepository;
    }

    public function execute()
    {
        $contest = $this->contestRepository->find($this->id);
        if ($this->canStartContest($this->user, $contest)) {
            $contest->start();
            return $this->contestRepository->save($contest);
        }
        throw new EditContestException("User has no permission to start this contest.");
    }

    private function canStartContest(User $user, Contest $contest)
    {
        $action = "start_contest";
        return $user->can($action) || ($this->user->getId() == $contest->getUser(
                )->getId());
    }


}
