<?php


namespace App\Databases;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FichasLog extends Model
{
    use SoftDeletes;

    protected $table = 'fichas_log';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'destinatarios',
        'cantidad_puntos',
        'cantidad_users',
        'description',
        'tipo'
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

    /**
     * Get the from User associated with a tx
     */
    public function owner()
    {
        return $this->hasOne('App\User', 'id', "user_id")->withTrashed();
    }

}
