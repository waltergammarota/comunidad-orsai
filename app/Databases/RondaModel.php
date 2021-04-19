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
        'body',
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
}
