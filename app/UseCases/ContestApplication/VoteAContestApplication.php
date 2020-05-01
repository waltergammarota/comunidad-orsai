<?php


namespace App\UseCases\ContestApplication;

use App\Databases\ContestApplicationModel;
use App\Databases\ContestModel;
use App\Databases\Transaction;
use App\UseCases\GenericUseCase;
use App\User;

class VoteAContestApplication extends GenericUseCase
{

    private $capId;
    private $userId;
    private $amount;
    private $cap;

    public function __construct($capId, $userId, $amount)
    {
        $this->capId = $capId;
        $this->userId = $userId;
        $this->amount = $amount;
    }

    public function execute()
    {
        $this->cap = ContestApplicationModel::find($this->capId);
        if ($this->checkIfContestIsActive()) {
            return $this->voteCap(
                $this->capId,
                $this->userId,
                $this->amount
            );
        }
        throw new \Exception("El Concurso no ha comenzado", "007");
    }

    private function checkIfContestIsActive()
    {
        $contest = ContestModel::find($this->cap->contest_id);
        return $contest->active == 1;
    }

    private function isVoterOwnerOf($userId)
    {
        if ($this->cap->owner()->first()->id == $userId) {
            return true;
        }
        return false;
    }

    private function voteCap($capId, $userId, $amount)
    {
        $ingreso = Transaction::where(["to" => $userId])->sum("amount");
        $egreso = Transaction::where(["from" => $userId])->sum("amount");
        $votesOnThisApplication = Transaction::where(["from" => $userId, "cap_id"=> $capId])->sum("amount");
        $maxLimitPerApplication = 450;
        $minLimitPerApplication = 50;
        if($votesOnThisApplication >= $maxLimitPerApplication) {
            $output = ["success" => false, "totalVotes" => $this->cap->votes, "available" => 0];
            return $output;
        }
        if($amount < $minLimitPerApplication || $amount > $maxLimitPerApplication) {
            $output = ["success" => false, "totalVotes" => $this->cap->votes, "available" => 450 - $votesOnThisApplication];
            return $output;
        }
        if ($ingreso >= ($egreso + $amount)) {
            $tx = new Transaction(
                [
                    'from' => $userId,
                    'to' => $this->cap->owner()->first()->id,
                    'type' => 'Transfer',
                    'amount' => $amount,
                    'data' => "Voto a propuesta id {$capId}",
                    'cap_id' => $this->cap->id,
                ]
            );
            $tx->save();
            $totalVotes = $this->cap->votes + $amount;
            $this->cap->votes = $totalVotes;
            $this->cap->save();
            $output = ["success" => true, "totalVotes" => $totalVotes, "available" => 450 - $votesOnThisApplication];
            return $output;
        }
        $output = ["success" => false, "totalVotes" => $this->cap->votes, "available" => 450 - $votesOnThisApplication];
        return $output;
    }

}
