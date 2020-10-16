<?php


namespace App\Databases;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificacionModel extends Model
{

    use SoftDeletes;

    protected $table = 'notificaciones';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject',
        'title',
        'description',
        'deliver_time',
        'button_url',
        'button_text',
        'mail',
        'database',
        'users',
        'template',
        'status',
        'user_id'
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
        "deliver_time" => 'datetime'
    ];

    public function owner()
    {
        return $this->hasOne('App\User', 'id', "user_id");
    }

}
