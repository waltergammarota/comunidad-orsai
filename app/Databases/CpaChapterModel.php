<?php

namespace App\Databases;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CpaChapterModel extends Model
{
    use SoftDeletes;

    protected $table = 'contest_applications_chapters';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "title",
        "body",
        "cap_id",
        "orden"
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


    public function cpa()
    {
        return $this->hasOne('Databases\ContestApplicationModel', 'id', "cap_id");
    }
}
