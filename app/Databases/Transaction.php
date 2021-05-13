<?php


namespace App\Databases;


use Carbon\Carbon;
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
        return Transaction::where('to', 1)->sum('amount');
    }

    public function getAmountForReport()
    {
        switch ($this->from) {
            case 1:
                return $this->amount;
            default:
                return $this->amount * -1;
        }
    }


    static public function getNextBaldeoDate($user)
    {
        $day = env('BALDEO_DIA', 1);
        $currentMonth = Carbon::now()->format('m');
        $nextMonth = ($currentMonth + 1) == 12 ? 1 : $currentMonth + 1;
        $currentYear = Carbon::now()->format('Y');
        $year = $currentMonth == 12 ? $currentYear + 1 : $currentYear;
        $balance = $user->getBalance();
        $porcentaje = env("PORCENTAJE_BALDEO", 10);
        return
            ["fechaProximoBaldeo" => Carbon::create($year, $nextMonth, $day),
                "balance" => round(ceil($balance * (1 - ($porcentaje / 100))),0)
            ];
    }

    static public function getNextMordida($user)
    {
        $days = env('MORDIDA_DIAS', 90);
        $lastTx = Transaction::where(['to' => $user->id,
            'type' => 'MINT', 'processed' => 0])->first();
        $mintedTxs = Transaction::where(['to' => $user->id,
            'type' => 'MINT',
            'processed' => 0])->sum('amount');
        $burnedTxs = Transaction::where(['to' => $user->id, 'type' => 'BURN', 'processed' => 0])->sum('amount');
        $transfers = Transaction::where(['from' => $user->id, 'type' => 'TRANSFER', 'processed' => 0])->sum('amount');
        $resto = $mintedTxs - $burnedTxs - $transfers;
        $puntosAQuemar = $user->getBalance() - $resto;
        $minimo = env('MORDIDA_MINIMO', 10);
        return ['fechaProximaMordida' => $lastTx ? $lastTx->created_at->addDays($days)->format('d/m/Y') : false,
            'mintedTxs' => $mintedTxs,
            'burnedTxs' => $burnedTxs,
            'transfers' => $transfers,
            'resto' => $puntosAQuemar > $minimo ? $puntosAQuemar : $minimo
        ];
    }
}
