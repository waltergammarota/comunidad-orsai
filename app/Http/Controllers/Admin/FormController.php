<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Databases\FormModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FormController extends Controller
{

    protected $rules = [
        "name" => 'required',
        "title" => 'required',
        "description" => 'required|max:1000'
    ];


    public function index()
    {
        $forms = FormModel::selectRaw('forms.id, forms.name, forms.title , forms.description , forms.created_at, COUNT(contests.form_id) AS contests')
            ->leftjoin('contests', 'forms.id', '=', 'contests.form_id')
            ->groupBy('forms.id', 'forms.name', 'forms.title', 'forms.description', 'forms.created_at')
            ->get();

        $data['forms'] = $forms;

        return view('admin.forms.index', $data);
    }


    public function create()
    {
        $form = new \stdClass();
        $form->name = '';
        $form->title = '';
        $form->description = '';

        $data['form'] = $form;
        $data['section_name'] = 'Crear Formulario';

        return view('admin.forms.form', $data);
    }


    public function store(Request $request)
    {
        $request->validate($this->rules);

        $form = new FormModel();
        $form->name = $request->name;
        $form->title = $request->title;
        $form->description = $request->description;
        $form->save();

        session()->flash('message', 'Formulario creado!');

        return Redirect::to(route('forms.edit', $form));
    }


    public function edit(Request $request)
    {
        $id = $request->route('id');

        $form = FormModel::find($id);
        $data['form'] = $form;
        $data['inputs'] = $form->getInputs();

        $data['section_name'] = 'Editar Formulario';

        return view('admin.forms.form', $data);
    }


    public function update(Request $request)
    {
        $form = FormModel::find($request->id);
        $request->validate($this->rules);

        $form->name = $request->name;
        $form->title = $request->title;
        $form->description = $request->description;
        $form->save();

        session()->flash('message', 'Formulario actualizado!');

        return Redirect::to(route('forms.edit', $form));
    }


    public function delete(Request $request)
    {
        $id = $request->route('id');
        $form = FormModel::find($id);
        $form->delete();

        session()->flash('message', 'Formulario borrado!');

        return Redirect::to(route('forms.index'));
    }
}
