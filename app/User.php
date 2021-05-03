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
        'passport',
        'userName',
        'country',
        'provincia',
        'city',
        'birth_date',
        'birth_country',
        'profesion',
        'description',
        'facebook',
        'twitter',
        'whatsapp',
        'instagram',
        'linkedin',
        'portfolio',
        'web',
        'medium',
        'redes',
        'prefijo',
        'email',
        'password',
        'email_verified_at',
        'role',
        'avatar',
        'coral_token',
        'phone_verified_at',
        'code',
        'sms_sent_at',
        'empresa',
        'idiomas',
        'sector',
        'formacion',
        'ocupacion',
        'anonimo',
        'cookies',
        'privacidad',
        'terminos'
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
        'sms_sent_at' => 'datetime',
        'idiomas' => 'array',
        'formacion' => 'array',
        'ocupacion' => 'array'
    ];

    public function avatar()
    {
        return $this->hasOne('App\Databases\FileModel', 'id', "avatar");
    }

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

    public function getPhone()
    {
        return $this->prefijo . $this->whatsapp;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getUserName()
    {
        $userID = $this->getID();
        if ($this->anonimo == 0 && $this->deleted_at == null) {
            if ($this->name != 'Comunidad Orsai') {
                $data = '<a href="' . url("/perfil-usuario/$userID") . '">' . $this->name . ' ' . $this->lastName . '</a>';
                return $data;
            }
        }
        return $this->name;
    }

    public function getVotesInContest($contestId)
    {
        return Transaction::where('type', 'TRANSFER')->where('to', $contestId)->sum('amount');
    }

}
