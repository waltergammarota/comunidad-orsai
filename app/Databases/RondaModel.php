<?php

namespace App\Databases;

use Illuminate\Database\Eloquent\Model;

class RondaModel extends Model
{
    protected $table = 'rondas';

    protected $fillable = [
        'id',
        'contest_id',
        'solapa',
        'cost',
        'title',
        'bajada',
        'order',
        'body',
    ];

    protected $hidden = [];

    protected $casts = [
        "created_at" => 'datetime',
        "updated_at" => 'datetime',
    ];

    public function inputs()
    {
        return $this->hasManyThrough(InputModel::class, RondaInputModel::class, 'ronda_id', 'id', 'id', 'input_id');
    }

    static public function getRonda($contestId, $rondaOrder)
    {
        return RondaModel::where('contest_id', $contestId)->where('order', $rondaOrder)->with('inputs')->first();
    }
}
