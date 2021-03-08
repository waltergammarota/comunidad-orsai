<?php

namespace App\Http\Controllers\Admin;

use App\Databases\CotizacionModel;
use App\Databases\FormModel;
use App\Databases\InputModel;
use App\Databases\ProductoModel;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class InputController extends Controller
{
    public function index(Request $request)
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
        $data['title'] = "Inputs";
        $data['input'] = null;
        $data['counter_types'] = [
            "ninguno" => "none",
            "caracter" => "char",
            "palabra" => "word"
        ];
        $data['types'] = [
            "input", "select", "textarea", "nube"
        ];
        $data['forms'] = FormModel::all();
        return view('admin.inputs.form', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => 'required',
            "title" => 'required',
            "description" => 'max:1000',
            'form_id' => 'required'
        ]);
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
            "placeholder" => $request->placeholder
        ];
        $input = new InputModel($data);
        $input->save();
        return Redirect::to('admin/inputs/' . $input->id);
    }

    private function convertOptions($options)
    {
        $items = explode(",", $options);
        return array_map(function ($item) {
            return trim($item);
        }, $items);
    }

    public function update(Request $request)
    {
        $request->validate([
            "name" => 'required',
            "title" => 'required',
            "description" => 'max:1000',
            'form_id' => 'required'
        ]);
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
            "placeholder" => $request->placeholder
        ];
        $input->fill($data);
        $input->save();
        return Redirect::to('admin/inputs/' . $input->id);
    }

    public function edit(Request $request)
    {
        $id = $request->route('id');
        $data['input'] = InputModel::find($id);
        $data['title'] = "Inputs";
        $data['counter_types'] = [
            "ninguno" => "none",
            "caracter" => "char",
            "palabra" => "word"
        ];
        $data['types'] = [
            "input", "select", "textarea", "nube"
        ];
        $data['forms'] = FormModel::all();
        return view('admin.inputs.form', $data);
    }
}
