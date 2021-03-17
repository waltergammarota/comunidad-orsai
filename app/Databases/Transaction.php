<?php


namespace App\Databases;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'from',
        'to',
        'type',
        'amount',
        'data',
        'cap_id',
        "tags"
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
        "tags" => "array"
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

    public function capId()
    {
        return $this->hasOne('App\Databases\ContestApplicationModel', 'id', 'cap_id');
    }

    static public function createTransaction($from, $to, $amount, $data, $cap_id = null, $type = "MINT", $tags = [])
    {
        $tx = new Transaction([
            'from' => $from,
            'to' => $to,
            'type' => $type,
            'amount' => $amount,
            'data' => $data,
            'cap_id' => $cap_id,
            "tags" => $tags
        ]);
        $tx->save();
        return $tx;
    }

    static public function getFichasEnJuego()
    {
        $pools = ContestModel::select('pool_id')->whereNotIn('pool_id', [0])->get();
        return Transaction::whereIn('to', $pools)->sum('amount');
    }

    static public function getFichasEnBilleteras()
    {
        return Transaction::whereIn("type", ['MINT'])->sum('amount') - Transaction::whereIn("type", ["BURN"])->sum('amount');
    }

    static function getFichasBaldeosYMordidas()
    {
        return Transaction::where('tags', 'like', "%baldeo%")->orWhere('tags', 'like', '%mordida%')->sum('amount');
    }

    public function getAmountForReport()
    {
        switch ($this->from) {
            case 1:
                return $this->amount;
            case 2:
                return $this->amount * -1;
        }
    }
}
