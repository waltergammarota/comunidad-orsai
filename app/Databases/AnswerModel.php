<?php

namespace App\Databases;

use Illuminate\Database\Eloquent\Model;

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
}
