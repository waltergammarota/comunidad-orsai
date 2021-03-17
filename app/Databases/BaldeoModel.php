<?php

namespace App\Databases;

use Illuminate\Database\Eloquent\Model;

class BaldeoModel extends Model
{
    protected $table = 'baldeo';

    protected $fillable = [
        'id',
        'log',
        'type',
        'month',
        'year'
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
        "log" => "array"
    ];

}
