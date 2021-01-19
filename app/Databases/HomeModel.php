<?php


namespace App\Databases;
 
use Illuminate\Database\Eloquent\Model; 

class HomeModel extends Model
{ 

    protected $table = 'home';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 
        'id',
        'description'
    ];   

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
 
}
