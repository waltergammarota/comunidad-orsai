<?php

namespace App;

use App\Databases\Transaction;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @method static count()
 */
class User extends Authenticable implements JWTSubject
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastName',
        'userName',
        'country',
        'provincia',
        'city',
        'birth_date',
        'profesion',
        'description',
        'facebook',
        'whatsapp',
        'twitter',
        'instagram',
        'email',
        'password',
        'email_verified_at',
        'role',
        'avatar',
        'coral_token',
        'phone_verified_at',
        'code',
        'sms_sent_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function avatar()
    {
        return $this->hasOne('App\Databases\FileModel', 'id', "avatar");
    }

<<<<<<< HEAD
    public function hasPhoneVerified()
    {
        return $this->phone_verified_at != null;
    }

    public function hasAvatar()
    {
        return $this->avatar()->first() != null;
    }

    public function getAvatarLink()
    {
        $avatar = $this->avatar()->first();
        return url('storage/images/' . $avatar->name . "." . $avatar->extension);
    }

=======
    public function hasAvatar()
    {
        return $this->avatar()->first() != null;
    }

    public function getAvatarLink()
    {
        $avatar = $this->avatar()->first();
        return url('storage/images/' . $avatar->name . "." . $avatar->extension);
    }

>>>>>>> c365291ebe8ae41c9e26f382c9464c803a5e3869

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getBalance()
    {

        $entrada = Transaction::where('to', $this->id)->whereIn('type', ['TRANSFER', 'MINT'])->sum('amount');
        $salida = Transaction::where('from', $this->id)->whereIn('type', ['TRANSFER'])->sum('amount');
        $quemados = Transaction::where('to', $this->id)->whereIn('type', ['BURN'])->sum('amount');
        return $entrada - $salida - $quemados;
    }

}
