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
            if ($this->hasUserPhoneActivated()) {
                return $this->voteCap(
                    $this->capId,
                    $this->userId,
                    $this->amount
                );
            }
            throw new \Exception('No tienes el teléfono activado', "107");
        }
        throw new \Exception("El Concurso no ha comenzado", "007");
    }

    private function hasUserPhoneActivated()
    {
        $user = User::find($this->userId);
        return $user->phone_verified_at != null;
    }

    private function checkIfContestIsActive()
    {
        $contest = ContestModel::find($this->cap->contest_id);
        return $contest->hasVotes();
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

        $ingreso = Transaction::where(["to" => $userId])->whereIn('type', ['MINT', 'TRANSFER'])->sum("amount");
        $egreso = Transaction::where(["from" => $userId])->whereIn('type', ['TRANSFER'])->sum("amount");
        $quemado = Transaction::where(['to' => $userId])->whereIn('type', ['BURN'])->sum("amount");
        $votesOnThisApplication = Transaction::where(["from" => $userId, "cap_id" => $capId])->sum("amount");
        $maxLimitPerApplication = 450;
        $minLimitPerApplication = 50;
        $balance = $ingreso - $egreso - $quemado;
        if ($votesOnThisApplication >= $maxLimitPerApplication) {
            $output = ["success" => false, "totalVotes" => $this->cap->votes, "available" => 0, "balance" => $balance];
            return $output;
        }
        if ($amount < $minLimitPerApplication || $amount > $maxLimitPerApplication) {
            $output = ["success" => false, "totalVotes" => $this->cap->votes, "available" => $maxLimitPerApplication - $votesOnThisApplication, "balance" => $balance];
            return $output;
        }
        $available = $maxLimitPerApplication - $votesOnThisApplication;
        if (($balance - $amount) > 0 && $available >= $amount) {
            $tx = new Transaction(
                [
                    'from' => $userId,
                    'to' => 1,
                    'type' => 'Transfer',
                    'amount' => $amount,
                    'data' => "Fichas a propuesta ID {$capId}",
                    'cap_id' => $this->cap->id,
                ]
            );
            $tx->save();
            $totalVotes = $this->cap->votes + $amount;
            $this->cap->votes = $totalVotes;
            $this->cap->save();
            $output = ["success" => true, "totalVotes" => $totalVotes, "available" => 450 - $votesOnThisApplication, "balance" => $balance - $amount];
            return $output;
        }
        $output = ["success" => false, "totalVotes" => $this->cap->votes, "available" => 450 - $votesOnThisApplication, "balance" => $balance];
        return $output;
    }

}
