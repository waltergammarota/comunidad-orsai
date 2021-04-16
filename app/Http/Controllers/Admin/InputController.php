<?php

namespace App\Http\Controllers\Admin;

use App\Databases\FormModel;
use App\Databases\InputModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class InputController extends Controller
{
    protected $rules = [
        "name" => 'required',
        "title" => 'required',
        "description" => 'max:1000'
    ];

    protected $types = [
        "input" => 'Input',
        "select" => 'Select',
        "textarea" => 'Textarea',
        "nube" => 'Nube',
        "image" => 'Imagen',
        "audio" => 'Audio'
    ];

    protected $counter_types = [
        "ninguno" => "none",
        "caracter" => "char",
        "palabra" => "word"
    ];


    public function index()
    {
        $data['title'] = "Inputs";
        return view('admin.inputs.index', $data);
    }

    public function inputs_json(Request $request)
    {
        $inputs = InputModel::all();
        $items = [];
        foreach ($inputs as $input) {
            $row = [
                "id" => $input->id,
                "name" => $input->name,
                "type" => $input->type,
                "created_at" => $input->created_at
            ];
            array_push($items, $row);
        }
        $data = [
            'draw' => $request->query('draw'),
            "recordsTotal" => InputModel::count(),
            "recordsFiltered" => InputModel::count(),
            'data' => $items
        ];
        return response()->json($data);
    }


    public function create(Request $request)
    {
        $id = $request->route('id');

        $data['form'] = FormModel::find($id);

        $input = new \stdClass();
        $input->name = ' ';
        $input->title = ' ';
        $input->description = ' ';
        $input->tutorial = ' ';
        $input->counter_type = 'none';
        $input->counter_max = 0;
        $input->type = 'input';
        $input->options = [""];
        $input->placeholder = ' ';
        $input->required  = 0;
        $input->filas = 0;
        $input->cols = 0;

        $data['title'] = "Inputs";
        $data['input'] = $input;

        $data['counter_types'] = $this->counter_types;
        $data['types'] = $this->types;

        $data['forms'] = FormModel::all();
        return view('admin.inputs.form', $data);
    }


    public function store(Request $request)
    {
        $request->validate($this->rules);

        $data = [
            "form_id" => $request->form_id,
            "name" => $request->name,
            "title" => $request->title,
            "description" => $request->description ?? '',
            "tutorial" => $request->tutorial ?? '',
            "counter_type" => $request->counter_type,
            "counter_max" => $request->counter_max,
            "type" => $request->type,
            "options" => $this->convertOptions($request->options),
            "placeholder" => $request->placeholder ?? '',
            'required' => $request->required,
            'filas' => $request->rows,
            'cols' => $request->cols
        ];
        $input = new InputModel($data);
        $input->save();

        session()->flash('message', 'Input creado!');

        return Redirect::to(route('forms.edit', $request->form_id));
    }

    private function convertOptions($options)
    {
        $items = explode(";", $options);
        return array_map(function ($item) {
            return trim($item);
        }, $items);
    }

    public function update(Request $request)
    {
        $request->validate($this->rules);

        $input = InputModel::find($request->id);
        $data = [
            "form_id" => $request->form_id,
            "name" => $request->name,
            "title" => $request->title,
            "description" => $request->description,
            "tutorial" => $request->tutorial,
            "counter_type" => $request->counter_type,
            "counter_max" => $request->counter_max,
            "type" => $request->type,
            "options" => $this->convertOptions($request->options),
            "placeholder" => $request->placeholder,
            'required' => $request->required,
            'filas' => $request->rows,
            'cols' => $request->cols
        ];
        $input->fill($data);
        $input->save();

        session()->flash('message', 'Input actualizado!');

        return Redirect::to(route('forms.edit', $request->form_id));
    }

    public function edit(Request $request)
    {
        $id = $request->route('id');

        $input = InputModel::find($id);

        $data['form'] = FormModel::find($input->form_id);

        $data['input'] = $input;
        $data['title'] = "Inputs";
        $data['counter_types'] = $this->counter_types;

        $data['types'] = $this->types;

        return view('admin.inputs.form', $data);
    }


    public function delete(Request $request)
    {
        $id = $request->input_id;
        $input = InputModel::find($id);
        $input->delete();

        session()->flash('message', $request->message);

        return Redirect::to(route('forms.edit', $request->form_id));
    }
}
