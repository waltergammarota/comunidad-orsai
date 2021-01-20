<?php

namespace App\Http\Controllers\Admin; 
 
use App\Databases\HomeModel;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class HomeEditableController extends Controller
{
    public function index(Request $request)
    { 
        $title = "Página de Inicio";   
        $home = HomeModel::all();   
        return view('admin.home', compact('title','home'));
    }
    public function store(Request $request)
    {
        $datos1 = [ 
        	"id" => 0,
            "description1" => $request->description1 
        ];
        $datos2 = [ 
        	"id" => 1,
            "description2" => $request->description2
        ];
        $home1 = new HomeModel($datos1);
        $home1->save();

        $home2 = new HomeModel($datos2);
        $home2->save();
        return Redirect::to('admin/home');
    }
    public function edit(Request $request)
    { 
        $home = HomeModel::all();  
        return view('admin.home', compact('home'));
    } 
    public function update(Request $request)
    {
        $datos1 = [ 
        	"id" => 0,
            "description" => $request->description1 
        ];
        $datos2 = [ 
        	"id" => 1,
            "description" => $request->description2
        ]; 
        $home1 = HomeModel::find(0);
        $home1->fill($datos1);
        $home1->save();

        $home2 = HomeModel::find(1);
        $home2->fill($datos2);
        $home2->save(); 
        return Redirect::to('admin/home');

    }
}
