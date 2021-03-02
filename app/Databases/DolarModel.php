<?php


namespace App\Databases;

use Illuminate\Database\Eloquent\Model;

class DolarModel extends Model
{
    protected $table = 'dolar_mep';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'precio',
        'fecha'
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
        "fecha" => 'datetime',
        "created_at" => 'datetime',
        "updated_at" => 'datetime'
    ];

}
