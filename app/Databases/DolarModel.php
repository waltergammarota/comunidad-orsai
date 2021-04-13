<?php


namespace App\Databases;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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

    static public function getDolarPrice()
    {
        $cotizacion = DolarModel::latest()->first();
        $minutes = 60 * 6;
        if ($cotizacion && $cotizacion->fecha->diffInMinutes(Carbon::now()) < $minutes) {
            return $cotizacion->precio;
        }
        try {
            $client = new Client();
            $url = "https://www.dolarsi.com/api/api.php?type=valoresprincipales";
            $response = $client->get($url);
            $cotizaciones = json_decode($response->getBody());
            $cotizacion = array_filter($cotizaciones, function ($cotizacion) {
                return $cotizacion->casa->nombre == 'Dolar Bolsa';
            });
            if (count($cotizacion) > 0) {
                $precio = str_replace(',', '.', reset($cotizacion)->casa->venta);
                $dolarMep = new DolarModel([
                    "precio" => $precio,
                    "fecha" => Carbon::now()
                ]);
                $dolarMep->save();
                return $precio;
            }
        } catch (\Exception $error) {
            if ($cotizacion) {
                return $cotizacion->precio;
            }
            return 150;
        }
    }

}
