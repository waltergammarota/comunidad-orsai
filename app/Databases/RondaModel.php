<?php

namespace App\Databases;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RondaModel extends Model
{
    protected $table = 'rondas';

    protected $fillable = [
        'id',
        'contest_id',
        'cost',
        'title',
        'bajada',
        'body',
    ];

    protected $hidden = [];

    protected $casts = [
        "created_at" => 'datetime',
        "updated_at" => 'datetime',
    ];

    public function getRondaInputs()
    {
        $query = DB::table('rondas_inputs')
            ->join('inputs', 'rondas_inputs.input_id', '=', 'inputs.id')
            ->where('rondas_inputs.ronda_id', '=', $this->id)
            ->select(DB::raw('rondas_inputs.ronda_id, rondas_inputs.input_id, inputs.*'));

        return $query->get();
    }
}
