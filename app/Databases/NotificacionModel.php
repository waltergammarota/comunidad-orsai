<?php


namespace App\Databases;

use Carbon\Carbon;
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

    static public function create($data)
    {
        $users = $data->users ?? [0];
        $deliver_time = $data->deliver_time ?? Carbon::now();

        $notification = new NotificacionModel([
            "subject" => $data->subject,
            "title" => $data->title,
            "description" => $data->description,
            "deliver_time" => $deliver_time,
            "button_url" => "",
            "button_text" => "",
            "database" => 1,
            "users" => json_encode($users),
            "template" => "default",
            "status" => 0,
            "user_id" => 1
        ]);

        $notification->save();
        return $notification;
    }


}
