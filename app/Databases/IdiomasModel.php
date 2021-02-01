<?php


namespace App\Databases;

use Illuminate\Database\Eloquent\Model;

class IdiomasModel extends Model
{
    protected $table = 'catalogo_idiomas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name'
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
    protected $casts = [];

    public function getNombreAttribute($value)
    {
        return utf8_decode($value);
    }
}
