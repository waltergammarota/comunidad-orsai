<?php

namespace App\Databases;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileModel extends Model
{
    use SoftDeletes;

    protected $table = 'files';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'name',
        'original_name',
        'extension',
        'size',
        'height',
        'width',
        'position'
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
    public function application()
    {
        return $this->belongsToMany('App\ContestApplicationModel','contest_applications_files', 'file_id')->withTimestamps();
    }
}
