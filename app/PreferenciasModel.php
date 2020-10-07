<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PreferenciasModel extends Model
{
    use SoftDeletes;

    protected $table = "preferencias";

    protected $fillable = [
        "plataforma",
        "correo",
        "idioma",
        "moneda",
        "pago",
        "zona"
    ];

    protected $hidden = [];

    protected $casts = [];

    public function owner()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

}
