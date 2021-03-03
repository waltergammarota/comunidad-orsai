<?php


namespace App\Databases;

use App\Databases\CotizacionModel;
use Illuminate\Database\Eloquent\Model;

class ProductoModel extends Model
{
    protected $table = 'productos';

    private $cotizacion = 150;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'description',
        'price',
        'fichas',
        'visible'
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

    public function getPriceInUsd()
    {
        $cotizacion = CotizacionModel::getCurrentCotizacion();
        if ($this->dynamic_price == 1) {
            return $this->fichas * $cotizacion->precio;
        }
        return $this->price;

    }

    public function setCotizacion($cotizacion)
    {
        $this->cotizacion = $cotizacion;
    }

    public function getCotizacion()
    {
        return $this->cotizacion;
    }

    public function getPriceInArs()
    {
        $priceInUsd = $this->getPriceInUsd();
        return $priceInUsd * $this->cotizacion;
    }

}
