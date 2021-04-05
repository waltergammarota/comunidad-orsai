<?php


namespace App\Databases;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MoneyTransactionModel extends Model
{
    use SoftDeletes;

    protected $table = "transactions_money";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'type',
        'data',
        'payment_id',
        'currency',
        'cotizacion',
        'amount',
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
        "tags" => "array",
        "created_at" => 'datetime',
        "updated_at" => 'datetime',
        "fecha" => 'datetime',
    ];

    /**
     * Get the from User associated with a tx
     */
    public function getFromUser()
    {
        return $this->hasOne('App\User', 'id', "from")->withTrashed();
    }

    /**
     * Get the to User associated with a tx
     */
    public function getToUser()
    {
        return $this->hasOne('App\User', 'id', "to")->withTrashed();
    }

    static public function createMoneyTransaction($from, $amount, $data, $type = "MINT", $currency = "USD", $payment_id = "")
    {
        $tx = new MoneyTransactionModel([
            'user_id' => $from,
            'type' => $type,
            'amount' => $amount,
            'data' => $data,
            'currency' => $currency,
            'cotizacion' => DolarModel::getDolarPrice(),
            'payment_id' => $payment_id
        ]);
        $tx->save();
        return $tx;
    }

}
