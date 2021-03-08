<?php

namespace App\Databases;

use Illuminate\Database\Eloquent\Model;

class FormModel extends Model
{
    protected $table = 'forms';

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
    ];


    public function inputs()
    {
        return $this->hasMany(InputModel::class, 'form_id');
    }

}
