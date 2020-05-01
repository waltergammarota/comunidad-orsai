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
        'cap_id'
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

    /**
     * Get the from User associated with a tx
     */
    public function getFromUser()
    {
        return $this->hasOne('App\User','id', "from");
    }

    /**
     * Get the to User associated with a tx
     */
    public function getToUser()
    {
        return $this->hasOne('App\User', 'id', "to");
    }

    public function capId() {
        return $this->hasOne('App\Databases\ContestApplicationModel', 'id', 'cap_id');
    }
}
