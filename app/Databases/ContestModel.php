<?php


namespace App\Databases;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContestModel extends Model
{

    use SoftDeletes;

    protected $table = 'contests';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'votes_end_date',
        'end_upload_app',
        'min_apps_qty'
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
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'votes_end_date' => 'datetime',
        'end_upload_app' => 'datetime',
    ];

    /**
     * Get the from User associated with a tx
     */
    public function owner()
    {
        return $this->hasOne('App\User', 'id', "user_id");
    }
}
