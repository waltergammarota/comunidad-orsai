<?php

namespace App\Databases;

use Illuminate\Database\Eloquent\Model;

class CotizacionModel extends Model
{
    protected $table = 'cotizacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'precio',
        'user_id',
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
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    static public function getCurrentCotizacion()
    {
        return self::latest()->first();
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

}
