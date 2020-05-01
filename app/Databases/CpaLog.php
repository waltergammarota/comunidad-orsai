<?php


namespace App\Databases;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CpaLog extends Model
{

    use SoftDeletes;

    protected $table = 'contest_applications_log';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cap_id',
        'status',
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
    public function contest()
    {
        return $this->hasOne('App\Databases\ContestModel','id', "cap_id");
    }

    public function cpa()
    {
        return $this->hasOne('App\Databases\ContestApplicationModel','id', "cap_id");
    }

}
