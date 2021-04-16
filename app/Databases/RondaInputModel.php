<?php

namespace App\Databases;

use Illuminate\Database\Eloquent\Model;

class RondaInputModel extends Model
{
    protected $table = 'rondas_inputs';


    public function rondas()
    {
        return $this->belongsTo(RondaModel::class, 'ronda_id', 'id');
    }
}
