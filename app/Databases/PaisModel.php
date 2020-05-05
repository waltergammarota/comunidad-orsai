<?php


namespace App\Databases;


use Illuminate\Database\Eloquent\Model;

class PaisModel extends Model
{

    protected $table = 'aux_paises';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'zona',
        'prefijoTel',
        'NElat',
        'NEIng',
        'SOlat',
        'SOlng',
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
    public function provincias()
    {
        return $this->hasMany('App\Databases\ProvinciaModel','id', "iso");
    }

}
