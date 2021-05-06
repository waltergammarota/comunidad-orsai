<?php

namespace App\Databases;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VotesModel extends Model
{
    protected $table = 'answers_votes';

    protected $fillable = [
        'id',
        'user_id',
        'answer_id',
        'cap_id',
        'form_id',
        'contest_id',
        'input_id',
        'amount',
        'order'
    ];

    protected $hidden = [];

    protected $casts = [
        "created_at" => 'datetime',
        "updated_at" => 'datetime',
    ];

    public function inputs()
    {
        return $this->hasManyThrough(InputModel::class, RondaInputModel::class, 'ronda_id', 'id');
    }

    static public function vote($args, $cost, $previousVotes)
    {
        $amount = $args['amount'];
        if (($amount + $previousVotes) > $cost) {
            $args['amount'] = $cost - $previousVotes;
        }
        if ($args['amount'] > 0) {
            $vote = new VotesModel($args);
            $vote->save();
            Transaction::createTransaction($args['user_id'], $args['pool_id'], $args['amount'], '', $args['cap_id'], 'TRANSFER');
        }
    }

    static public function getRondasWithVotes($contest, $userId)
    {
        $rondas = $contest->rondas()->with('inputs')->get();
        $votes = VotesModel::where('user_id', $userId)->where('contest_id', $contest->id)->groupBy('cap_id', 'order')->get();
        foreach ($rondas as $ronda) {
            $inputs = $ronda->inputs;
            $ronda->votes = 0;
            foreach ($votes as $vote) {
                if ($inputs->contains(function ($input) use ($vote) {
                    return $vote->input_id == $input->id;
                })) {
                    $ronda->votes++;
                }
            }
        }
        return $rondas;
    }

    static public function getRondasCounter($contestId, $userId)
    {
        $votes = VotesModel::select('order', DB::raw('sum(1) as cant'))->where('user_id', $userId)->where('contest_id', $contestId)->groupBy('order')->orderBy('order')->get();
        $rondasVotes = collect([]);
        for ($i = 0; $i < 3; $i++) {
            $ronda = new \stdClass();
            $ronda->order = $i + 1;
            $ronda->cpas = 0;
            if ($votes->get(0)) {
                $ronda->cpas = $votes[$i]->cant;
            }
            $rondasVotes->push($ronda);
        }
        return $rondasVotes;
    }

    static public function hasBeenVoted($answerId, $userId, $capId, $rondaOrder, $rondaCost)
    {
        $votes = VotesModel::where([
            "answer_id" => $answerId,
            "user_id" => $userId,
            "cap_id" => $capId,
            "order" => $rondaOrder
        ])->count();

        return $votes >= $rondaCost;
    }

    static public function getVotesCount($contestId, $userId, $order, $capId)
    {
        return VotesModel::where([
            'contest_id' => $contestId,
            'user_id' => $userId,
            'order' => $order,
            'cap_id' => $capId
        ])->sum('amount');
    }

    static public function getVotes($contestId, $userId, $order)
    {
        return VotesModel::where([
            'contest_id' => $contestId,
            'user_id' => $userId,
            'order' => $order
        ])->get();
    }

    static public function hasEnoughVotes($cpaId, $userId)
    {
        return VotesModel::where([
                "cap_id" => $cpaId,
                "user_id" => $userId,
            ])->count() >= 2;
    }
}
