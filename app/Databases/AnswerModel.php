<?php

namespace App\Databases;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AnswerModel extends Model
{
    protected $table = 'answers';

    protected $fillable = [
        'id',
        'form_id',
        'contest_id',
        'input_id',
        'cap_id',
        'user_id',
        'answer'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    protected $casts = [
        "created_at" => 'datetime',
        "updated_at" => 'datetime',

    ];

    public function contest()
    {
        return $this->hasOne(ContestModel::class, 'contest_id');
    }

    public function input()
    {
        return $this->belongsTo(InputModel::class, 'input_id');
    }

    public function form()
    {
        return $this->hasOne(FormModel::class, 'form_id');
    }

    static public function getAnswer($contestId, $inputId, $cpaId)
    {
        return AnswerModel::where('contest_id', $contestId)->where('input_id', $inputId)->where('cap_id', $cpaId)->first();
    }

    static public function getAnswersByOrder($contestId, $order, $ids)
    {
        if ($ids == "") {
            return collect([]);
        }
        return collect(DB::select("select ri.id, ri.input_id, r.order, a.answer, a.cap_id from rondas r
            join rondas_inputs ri on r.id = ri.ronda_id
            join answers a on a.input_id = ri.input_id and a.contest_id = {$contestId}
            where r.order = {$order}
            and cap_id IN ({$ids})
            and r.contest_id = {$contestId}
            order by ri.id"));
    }
}
