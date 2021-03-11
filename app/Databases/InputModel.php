<?php

namespace App\Databases;

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
        'rows'
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
            case "char" :
                $counterClass = "count-characters";
                $palabras = "caracteres";
                break;
        }
        $value = $this->getValue($answers);
        $html = '
            <div class="form_ctrl">
              <div class="input_err">
                <div class="label-two-columns">
                  <div class="left">
                    <label class="text_medium" for="motivo">' . $this->title . '</label>
                    <span class="disclaimer">' . $this->description . '</span>
                  </div>
                  <div class="right">
                    <a href="' . $this->tutorial . '" target="_blank">Ver tutorial</a>
                  </div>
                </div>
                <div class="content-input">
                  <input type="text" name="' . $this->getInputName() . '" id="' . $this->getInputName() . '" class="' . $counterClass . '" data-max="' . $this->counter_max . '" placeholder="' . $this->placeholder . '" value="' . $value . '">';
        if ($palabras != "") {
            $html .= '<div class="content-count-words">Te quedan <span class="count-words-text"> ' . $this->counter_max . ' </span> ' . $palabras . '</div>';
        }
        $html .= '</div>
              </div>
            </div>';
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
                $palabras = "palabras";
                break;
            case "word" :
                $counterClass = "count-characters";
                $palabras = "caracteres";
                break;
        }
        $html = '
            <div class="form_ctrl">
              <div class="input_err">
                <div class="label-two-columns">
                  <div class="left">
                    <label class="text_medium" for="motivo">' . $this->title . '</label>
                    <span class="disclaimer">' . $this->description . '</span>
                  </div>
                </div>
                <div class="content-input">
                    <textarea type="text" name="' . $this->getInputName() . '" id="' . $this->getInputName() . '" class="' . $counterClass . '" data-max="' . $this->counter_max . '" cols="' . $this->cols . '" rows="' . $this->rows . '" placeholder="' . $this->placeholder . '">' . $this->getValue($answers) . '</textarea>';
        if ($palabras != "") {
            $html .= '<div class="content-count-words">Te quedan <span class="count-words-text"> ' . $this->counter_max . ' </span> ' . $palabras . '</div>';
        }
        $html .= '</div>
              </div>
            </div>';
        return $html;
    }

    public function getInputName()
    {
        return 'input@' . $this->id;
    }

    private function selectToHtml($answers)
    {
        $html = '<div class="form_ctrl">
              <div class="input_err">
                <div class="label-two-columns">
                  <div class="left">
                    <label class="text_medium" for="categoria">' . $this->title . '</label>
                    <span class="disclaimer">' . $this->description . '</span>
                  </div>
                  <div class="right">
                    <a href="' . $this->tutorial . '" target="_blank">Ver tutorial</a>
                  </div>
                </div>
                <div class="content-input">
                  <select name="' . $this->getInputName() . '" id="' . $this->getInputName() . '">
                    <option value="" selected="true" disabled="disabled">Elegir</option>';
        foreach ($this->options as $option) {
            $selected = "";
            if ($option == $this->getValue($answers)) {
                $selected = "selected";
            }
            $html .= '<option value="' . $option . '"' . $selected . '>' . $option . '</option>';
        }
        $html .= '</select>
                </div>
              </div>
            </div>';
        return $html;
    }


    private function nubeToHtml($answers)
    {
        $html = '<div class="form_ctrl">
              <div class="input_err">
                <div class="label-two-columns">
                  <div class="left">
                    <label class="text_medium" for="tags">' . $this->title . '</label>
                    <span class="disclaimer">' . $this->description . '</span>
                  </div>
                  <div class="right">
                    <a href="' . $this->tutorial . '" target="_blank">Ver tutorial</a>
                  </div>
                </div>
                <div class="content-input">
                  <input type="text" name="' . $this->getInputName() . '" id="tags" class="tags" value="' . $this->getValue($answers) . '">
                  <div class="content-count-words">Separá las palabras con comas</div>
                </div>
              </div>
            </div>';
        return $html;
    }

    public function getRule()
    {
        return $this->required ? "required" : '';

    }

}
