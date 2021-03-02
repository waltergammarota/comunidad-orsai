<?php

namespace App\Databases;

use Illuminate\Database\Eloquent\Model;

class CompraModel extends Model
{
    protected $table = 'compras';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'producto_id',
        'amount',
        'status',
        'payment_id',
        'payment_processor',
        'payment_type',
        'order_id',
        'external_reference',
        'internal_id',
        'datos',
        'processed',
        'delivered',
        'price_ars'
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
        'updated_at' => 'datetime',
        'datos' => 'array'
    ];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function producto()
    {
        return $this->hasOne('App\Databases\ProductoModel', 'id', 'producto_id');
    }
}
