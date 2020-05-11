<?php

namespace App\Http\Controllers\Admin;

use App\Databases\ContestApplicationModel;
use App\Databases\ContestModel;
use App\Databases\Transaction;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class AdminController extends Controller
{

    public function index()
    {
        $totalUsers = User::count();
        $totalTransactions = Transaction::count();
        $totalApplication = ContestApplicationModel::count();
        $totalViews = ContestApplicationModel::sum('views');
        return view('admin.dashboard', compact('totalUsers','totalTransactions','totalApplication','totalViews'));
    }

    public function usuarios()
    {
        return view('admin.usuarios');
    }

    public function transacciones()
    {
        return view('admin.transacciones');
    }

    public function postulaciones()
    {
        return view('admin.postulaciones');
    }

    public function concurso()
    {
        return view('admin.concurso');
    }

    public function usuarios_json(Request $request)
    {
        $data = [
            'draw' => $request->query('draw'),
            "recordsTotal" =>  User::count(),
            "recordsFiltered" =>  User::count(),
            'data' => User::all()];
        return response()->json($data);
    }

    public function bloquear(Request $request) {
        $userId = $request->id;
        $user = User::find($userId);
        $user->blocked = 1;
        $user->save();
        $data = ["success" => true];
        return response()->json($data);
    }

    public function eliminar(Request $request) {
        $userId = $request->id;
        $user = User::destroy($userId);
        $data = ["success" => true];
        return response()->json($data);
    }

    public function transacciones_json(Request $request)
    {
        $data = [
            'draw' => $request->query('draw'),
            "recordsTotal" =>  Transaction::count(),
            "recordsFiltered" =>  Transaction::count(),
            'data' => Transaction::with('getFromUser')->with('getToUser')->with('capId:id,title')->orderBy('id','desc')->get()
        ];
        return response()->json($data);
    }


    public function postulaciones_json(Request $request)
    {
        $this->isAdmin();
        $data = [
            'draw' => $request->query('draw'),
            "recordsTotal" =>  ContestApplicationModel::count(),
            "recordsFiltered" =>  ContestApplicationModel::count(),
            'data' => ContestApplicationModel::with('owner')->with('status')->get()
        ];
        return response()->json($data);
    }

    public function contest_json(Request $request)
    {
        $data = [
            'draw' => $request->query('draw'),
            "recordsTotal" =>  ContestModel::count(),
            "recordsFiltered" =>  ContestModel::count(),
            'data' => ContestModel::all()
        ];
        return response()->json($data);
    }

}
