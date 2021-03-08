<?php

namespace App\Databases;

use Illuminate\Database\Eloquent\Model;

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


}
