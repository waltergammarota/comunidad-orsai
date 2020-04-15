<?php


namespace App\UseCases\Contest;

use App\Classes\Contest;
use App\Classes\EditContestException;
use App\Classes\User;
use App\Repositories\ContestRepository;


class PauseContest extends GenericUseCase
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
        if ($this->canPauseContest($this->user, $contest)) {
            $contest->pause();
            return $this->contestRepository->save($contest);
        }
        throw new EditContestException("User has no permission to pause this contest");
    }

    private function canPauseContest(User $user, Contest $contest)
    {
        $action = "pause_contest";
        return $user->can($action) || ($this->user->getId() == $contest->getUser(
                )->getId());
    }


}
