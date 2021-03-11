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
        'condiciones'
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
        return $this->belongsToMany(AnswerModel::class, 'answers', 'cpa_id', 'id');
    }


}
