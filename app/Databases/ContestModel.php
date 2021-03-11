<?php


namespace App\Databases;


use Carbon\Carbon;
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
        'min_apps_qty',
        'bajada_corta',
        'bajada_completa',
        'start_app_date',
        'end_app_date',
        'start_vote_date',
        'end_vote_date',
        'image',
        'type',
        'mode',
        'per_winner',
        'amount_winner',
        'amount_usd',
        'cant_winners',
        'required_amount',
        'cant_caracteres',
        'cant_capitulos',
        'user_id',
        'winner_check',
        'cost_per_cpa',
        'cost_jury',
        'vote_limit',
        'form_id'

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
        'start_app_date' => 'datetime',
        'end_app_date' => 'datetime',
        'start_vote_date' => 'datetime',
        'end_vote_date' => 'datetime',
    ];

    /**
     * Get the from User associated with a tx
     */
    public function owner()
    {
        return $this->hasOne('App\User', 'id', "user_id");
    }

    public function logo()
    {
        return $this->hasOne('App\Databases\FileModel', 'id', "image")->first();
    }

    public function getMode()
    {
        return $this->hasOne('App\Databases\ContestsModo', 'id', "mode")->first();
    }

    public function getType()
    {
        return $this->hasOne('App\Databases\ContestsType', 'id', "type")->first();
    }

    public function hasPostulacionesAbiertas()
    {
        $result = $this->start_app_date <= Carbon::now() && $this->end_app_date > Carbon::now();
        return $result;
    }

    public function hasVotes()
    {
        return $this->start_vote_date <= Carbon::now() && $this->end_vote_date > Carbon::now();
    }

    public function hasEnded()
    {
        return $this->end_date < Carbon::now();
    }

    public function cantidadPostulaciones()
    {
        return ContestApplicationModel::where('contest_id', $this->id)->where('approved', 1)->count();
    }

    public function cantidadFichasEnJuego()
    {
        $contestId = $this->id;
        return Transaction::join('contest_applications', 'cap_id', '=', 'contest_applications.id')->where('contest_applications.contest_id', $contestId)->where('approved', 1)->sum('amount');
    }

    public function getBases()
    {
        return ContenidoModel::where('contest_id', $this->id)->first();
    }

    public function hasStarted()
    {
        return $this->start_date < now();
    }

    public function getStatus()
    {
        if ($this->hasEnded()) {
            return "finalizado";
        }
        if ($this->hasStarted() && !$this->hasEnded()) {
            return "abierto";
        }
        if ($this->hasVotes()) {
            return "abierto";
        }
        if ($this->hasPostulacionesAbiertas()) {
            return "abierto";
        }
        return "proximo";
    }

    static public function hasPostulacion($contestId, $userId)
    {
        $cpa = ContestApplicationModel::where("contest_id", $contestId)->where("user_id", $userId)->first();
        if ($cpa == null) {
            return false;
        }
        $status = $cpa->status()->first()->status;
        return $status != "draft";
    }

    public function rondas()
    {
        return $this->hasMany(RondaModel::class, 'contest_id');
    }

    public function form()
    {
        return $this->belongsTo(FormModel::class, 'form_id');
    }
}
