<?php


namespace App\UseCases\Contest;

use App\Classes\Contest;
use App\Classes\User;
use App\Repositories\ContestRepository;
use App\Classes\EditContestException;

class EditContest extends GenericUseCase
{

    private $id;
    private $contestData;
    private $contestRepository;


    public function __construct(
        $id,
        \stdClass $contestData,
        ContestRepository $contestRepository,
        User $editorUser
    ) {
        $this->id = $id;
        $this->contestData = $contestData;
        $this->editorUser = $editorUser;
        $this->contestRepository = $contestRepository;
    }

    public function execute()
    {
        $contest = $this->contestRepository->find($this->id);
        if ($this->canEditContest($this->editorUser, $contest)) {
            $contest->updateData($this->contestData);
            return $this->contestRepository->save($contest);
        }
        throw new EditContestException();
    }

    private function canEditContest(User $user, Contest $contest)
    {
        $action = "edit_contest";
        return $user->can($action) || ($user->getId() == $contest->getUser(
                )->getId());
    }


}
