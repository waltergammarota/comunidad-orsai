<?php

namespace App\Databases;

use App\Rules\MaxNubeWordsRule;
use App\Rules\MaxWordsRule;
use Illuminate\Database\Eloquent\Model;

class InputModel extends Model
{
    protected $table = 'inputs';

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
        'tutorial',
        'counter_type',  //word - char - none
        'counter_max',
        'type',
        'options',
        'form_id',
        'placeholder',
        'required',
        'cols',
        'filas'
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
        "options" => 'array'
    ];


    public function toHtml($answers = [])
    {
        $type = $this->type;
        switch ($type) {
            case "input":
                return $this->inputToHtml($answers);
            case "textarea":
                return $this->textAreaToHtml($answers);
            case "nube":
                return $this->nubeToHtml($answers);
            case "select":
                return $this->selectToHtml($answers);
            case "image":
                return $this->mediaToHtml($answers);
            case "audio":
                return $this->mediaToHtml($answers);
        }
    }


    private function getValue($answers)
    {
        $inputId = $this->id;
        $values = $answers->filter(function ($value) use ($inputId) {
            return $value->input_id == $inputId;
        });
        if (count($values) > 0) {
            return $values->first()->answer;
        }
        return "";
    }

    private function inputToHtml($answers)
    {
        $counter_type = $this->counter_type;
        $counterClass = "";
        $palabras = "";
        switch ($counter_type) {
            case "word":
                $counterClass = "count-words";
                $palabras = "palabras";
                break;
            case "char":
                $counterClass = "count-characters";
                $palabras = "caracteres";
                break;
        }
        $data = [
            "id" => $this->id,
            "tutorial" => $this->tutorial,
            "title" => $this->title,
            "description" => $this->description,
            "inputName" => $this->getInputName(),
            "value" => $this->getValue($answers),
            "counterClass" => $counterClass,
            "palabras" => $palabras,
            "placeholder" => $this->placeholder,
            "counter_max" => $this->counter_max
        ];
        $html = view('concursos.inputTextHtml', $data);
        return $html;
    }


    private function textAreaToHtml($answers)
    {
        $counter_type = $this->counter_type;
        $counterClass = "";
        $palabras = "";
        switch ($counter_type) {
            case "char":
                $counterClass = "count-words";
                $palabras = "caracteres";
                break;
            case "word":
                $counterClass = "count-characters";
                $palabras = "palabras";
                break;
        }
        $data = [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "inputName" => $this->getInputName(),
            "value" => $this->getValue($answers),
            "counterClass" => $counterClass,
            "palabras" => $palabras,
            "placeholder" => $this->placeholder,
            "counter_max" => $this->counter_max,
            "rows" => $this->filas,
            "cols" => $this->cols,
            "tutorial" => $this->tutorial
        ];
        $html = view('concursos.inputTextareaHtml', $data);
        return $html;
    }

    public function getInputName()
    {
        return 'input@' . $this->id;
    }

    private function selectToHtml($answers)
    {
        $data = [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "tutorial" => $this->tutorial,
            "inputName" => $this->getInputName(),
            "value" => $this->getValue($answers),
            "options" => $this->options
        ];
        $html = view('concursos.inputSelectHmtl', $data);
        return $html;
    }

    private function nubeToHtml($answers)
    {
        $data = [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "tutorial" => $this->tutorial,
            "inputName" => $this->getInputName(),
            "value" => $this->getValue($answers),
            "placeholder" => $this->placeholder,
            "counter_max" => $this->counter_max
        ];
        $html = view('concursos.inputNubeHtml', $data);
        return $html;
    }


    private function mediaToHtml($answers)
    {
        $counter_type = $this->counter_type;
        $counterClass = "";
        $palabras = "";
        switch ($counter_type) {
            case "word":
                $counterClass = "count-words";
                $palabras = "palabras";
                break;
            case "char":
                $counterClass = "count-characters";
                $palabras = "caracteres";
                break;
        }
        $data = [
            "id" => $this->id,
            "tutorial" => $this->tutorial,
            "title" => $this->title,
            "description" => $this->description,
            "inputName" => $this->getInputName(),
            "value" => $this->getValue($answers),
            "counterClass" => $counterClass,
            "palabras" => $palabras,
            "placeholder" => $this->placeholder,
            "counter_max" => $this->counter_max
        ];
        $html = view('concursos.inputMediaHtml', $data);
        return $html;
    }



    public function getRule()
    {
        $rawRules = [
            $this->required ? "required" : null,
            $this->counter_max > 0 && $this->counter_type == "char" ? "max:" . $this->counter_max : null,
            $this->counter_max > 0 && $this->counter_type == "word" && in_array($this->type, ["input", "textarea"]) ? new MaxWordsRule($this->counter_max) : null,
            $this->counter_max > 0 && $this->counter_type == "word" && $this->type == "nube" ? new MaxNubeWordsRule($this->counter_max) : null,
        ];
        $rules = array_filter($rawRules, function ($item) {
            return $item != null;
        });
        return $rules;
    }
}
