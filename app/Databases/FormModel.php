<?php

namespace App\Databases;

use Illuminate\Database\Eloquent\Model;

class FormModel extends Model
{
    protected $table = 'forms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'title',
        'description',
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
        "created_at" => 'datetime',
        "updated_at" => 'datetime',
    ];


    public function inputs()
    {
        $inputs = InputModel::selectRaw('inputs.id, inputs.name, inputs.title , inputs.type, COUNT(DISTINCT rondas_inputs.id) AS rondas, COUNT(DISTINCT answers.id) AS answers')
            ->leftjoin('rondas_inputs', 'inputs.id', '=', 'rondas_inputs.input_id')
            ->leftjoin('answers', 'inputs.id', '=', 'answers.input_id')
            ->groupBy('inputs.id', 'inputs.name', 'inputs.title', 'inputs.type')
            ->where('inputs.form_id', $this->id);

        return $inputs->get();
    }

    // public function inputs()
    // {
    //     return $this->hasMany(InputModel::class, 'form_id');
    // }

    // public function getRules()
    // {
    //     $inputs = $this->inputs()->get();
    //     $rules = [];
    //     foreach ($inputs as $input) {
    //         $rules[$input->getInputName()] = $input->getRule();
    //     }
    //     return $rules;
    // }

    // public function getAttributes()
    // {
    //     // $inputs = $this->inputs()->get();
    //     $attributes = [];
    //     // foreach ($inputs as $input) {
    //     //     $attributes[$input->getInputName()] = strtolower($input->title);
    //     // }
    //     return $attributes;
    // }

}
