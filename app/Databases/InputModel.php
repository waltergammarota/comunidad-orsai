<?php

namespace App\Databases;

use Illuminate\Database\Eloquent\Model;

class InputModel extends Model
{
    protected $table = 'inputs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'title',
        'description',
        'tutorial',
        'counter_type',  //word - char - none
        'counter_max',
        'type',
        'options',
        'form_id',
        'placeholder'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        "created_at" => 'datetime',
        "updated_at" => 'datetime',
        "options" => 'array'
    ];

}
