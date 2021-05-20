<?php


namespace App\Databases;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContestApplicationModel extends Model
{

    use SoftDeletes;

    protected $table = 'contest_applications';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'link',
        'user_id',
        'contest_id',
        'prize_amount',
        'prize_percentage',
        'bases',
        'condiciones',
        'order',
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
    public function owner()
    {
        return $this->hasOne('App\User', 'id', "user_id");
    }

    public function status()
    {
        return $this->hasMany('App\Databases\CpaLog', 'cap_id', "id")->orderBy('id', 'desc');
    }

    public function getCurrentStatus()
    {
        $status = $this->hasMany('App\Databases\CpaLog', 'cap_id', "id")->orderBy('id', 'desc')->first();
        if ($status) {
            return $status->status;
        }
        return null;
    }


    public function contest()
    {
        return $this->hasOne('App\Databases\ContestModel', 'id', "contest_id");
    }

    public function logos()
    {
        return $this->belongsToMany('App\Databases\FileModel', 'contest_applications_files', "cap_id", 'file_id')->withTimestamps()->where('type', '=', 'logo');
    }

    public function images()
    {
        return $this->belongsToMany('App\Databases\FileModel', 'contest_applications_files', "cap_id", 'file_id')->withTimestamps()->where('type', '=', 'image');
    }

    public function pdfs()
    {
        return $this->belongsToMany('App\Databases\FileModel', 'contest_applications_files', "cap_id", 'file_id')->withTimestamps()->where('type', "=", 'pdf');
    }


    public function answers()
    {
        return $this->hasMany(AnswerModel::class, 'cap_id', 'id');
    }

    static function getAnswersById($contest, $id)
    {
        $cpas = ContestApplicationModel::where('contest_id', $contest->id)->where('approved', 1)->with('answers.input');
        $cpas = $cpas->where('id', $id);
        $num_id = '';
        foreach ($cpas->get() as $cpa) {
            $num_id = str_pad($cpa->order, 3, 0, STR_PAD_LEFT);
        }
        return ($num_id);
    }

    static function getApplications($contest, $rondas, $userId, $currentRonda, $filters, $id = false)
    {
        $previousRondaVotes = VotesModel::getVotes($contest->id, $userId, $currentRonda->order - 1);
        $currentRondaVotes = VotesModel::getVotes($contest->id, $userId, $currentRonda->order);
        $cpas = ContestApplicationModel::where('contest_id', $contest->id)->where('approved', 1)->with('answers.input');
        if (array_key_exists('busqueda', $filters)) {
            $busqueda = $filters['busqueda'];
            $cpas = ContestApplicationModel::where('contest_id', $contest->id)->where('approved', 1)->whereHas('answers.input', function ($query) use ($busqueda) {
                $query->where('answer', 'like', "%{$busqueda}%");
            });
        }
        if (array_key_exists('etiquetas', $filters)) {
            $etiquetas = explode(";", $filters['etiquetas']);
            $input = InputModel::where('form_id', $contest->form_id)->where('type', 'select')->first();
            $answers = AnswerModel::select('id', 'cap_id')->where('input_id', $input->id)->where('contest_id', $contest->id)->whereIn('answer', $etiquetas)->get();
            $ids = $answers->map(function ($answer) {
                return $answer->cap_id;
            });
            $cpas->whereIn('id', $ids->toArray());
        }
        if ($currentRonda->order == 1 && array_key_exists('destrabados', $filters) && $filters['destrabados']) {
            $ids = $currentRondaVotes->map(function ($vote) {
                return $vote->cap_id;
            });
            $cpas->whereIn('id', $ids->toArray());
        }
        if (($currentRonda->order > 1 && !$id)) {
            $ids = $previousRondaVotes->map(function ($vote) {
                return $vote->cap_id;
            });
            $cpas->whereIn('id', $ids->toArray());
        }
        if ($id) {
            $cpas->where('id', $id);
        }
        $apps = $cpas->get();
        foreach ($apps as $cpa) {
            $cpa->votesAmount = $cpa->getVotesByUser($userId, $currentRonda->order);
            if ($currentRondaVotes->contains('cap_id', $cpa->id)) {
                $cpa->hasBeenVoted = 1;
            }
            foreach ($cpa->answers as $answer) {
                $answer->ronda = [];
                foreach ($rondas as $ronda) {
                    $inputs = $ronda->inputs;
                    if ($inputs->contains(function ($item) use ($answer) {
                        return $answer->input_id == $item->id;
                    })) {
                        $aux = $answer->ronda;
                        $aux[] = $ronda->order;
                        $answer->ronda = $aux;
                    }
                }
            }
        }
        return $apps->sort(function ($cpa) {
            if ($cpa->hasBeenVoted) {
                return -1;
            }
            return 1;
        });
    }

    public function getVotesByUser($userId, $order)
    {
        return VotesModel::getVotesCount($this->contest_id, $userId, $order, $this->id);
    }


    public function getAnswerByRonda($currentRonda, $key)
    {
        $answers = $this->answers->filter(function ($item) use ($currentRonda) {
            return in_array($currentRonda->order, $item->ronda);
        });
        $sorteredAnswers = collect([]);
        $inputs = $currentRonda->inputs;
        foreach ($inputs as $input) {
            $sorteredAnswers->push($answers->first(function ($item) use ($input) {
                return $item->input_id == $input->id;
            }));
        }

        $answer = $sorteredAnswers->slice($key, 1)->shift();
        $selectedInput = $answer ? $answer->input : false;
        return $selectedInput ? $selectedInput->toUserHtml($answer) : '';
    }

    static public function getCompleteCpa($capId)
    {
        return ContestApplicationModel::where('id', $capId)->with('answers.input')->first();
    }

    public function getTotalVotes()
    {
        return Transaction::where('cap_id', $this->id)->sum('amount');
    }

    public function getTotalUniqueVotes()
    {
        return Transaction::where('cap_id', $this->id)->groupBy('from')->count();
    }

    public function getTransactions()
    {
        return Transaction::where('cap_id', $this->id)->with('getFromUser')->orderByDesc('id')->get();
    }
}
