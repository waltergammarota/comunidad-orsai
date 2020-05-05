<?php


namespace App\Databases;


use Illuminate\Database\Eloquent\Model;

class ProvinciaModel extends Model
{

    protected $table = 'aux_provincias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pais',
        'nombre',
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

    /**
     * Get the from User associated with a tx
     */
    public function ciudades()
    {
        return $this->hasMany('App\Databases\CiudadModel','idProvincia', "iso");
    }

}
