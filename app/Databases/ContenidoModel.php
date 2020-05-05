<?php


namespace App\Databases;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContenidoModel extends Model
{

    use SoftDeletes;

    protected $table = 'contenidos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
        'autor',
        'fecha_publicacion',
        'copete',
        'tipo',
        'texto',
        'user_id',
        'visible'
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
        "fecha_publicacion" => 'date'
    ];

    /**
     * Get the from User associated with a tx
     */
    public function owner()
    {
        return $this->hasOne('App\User','id', "user_id");
    }

    public function images()
    {
        return $this->belongsToMany('App\Databases\FileModel','contenido_files', "contenido_id", 'file_id')->withTimestamps()->where('type','=','image');
    }

}
