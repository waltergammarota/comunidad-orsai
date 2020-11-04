<?php

namespace App\Http\Controllers\Admin;

use App\Databases\ContestApplicationModel;
use App\Databases\ContestModel;
use App\Databases\Transaction;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Reference;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('email_verified_at', '!=', null)->count();
        $totalTransactions = Transaction::count();
        $totalApplication = ContestApplicationModel::count();
        $totalViews = ContestApplicationModel::sum('views');
        return view('admin.dashboard', compact('totalUsers', 'totalTransactions', 'totalApplication', 'totalViews'));
    }

    public function usuarios()
    {
        return view('admin.usuarios');
    }

    public function edit(Request $request)
    {
        $userId = $request->route('id');
        $user = User::find($userId);
        $balance = $this->getBalance($userId);
        return view('admin.usuarios-form', compact('user', 'balance'));
    }

    private function getBalance($userId)
    {
        $entrada = Transaction::where('to', $userId)->whereIn('type', ['TRANSFER', 'MINT'])->sum('amount');
        $salida = Transaction::where('from', $userId)->whereIn('type', ['TRANSFER'])->sum('amount');
        $quemados = Transaction::where('to', $userId)->whereIn('type', ['BURN'])->sum('amount');
        return $entrada - $salida - $quemados;
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
        $users = DB::select(DB::raw('select u.id,
               u.name,
               u.lastName,
               u.birth_date,
               u.email,
               if(u.email_verified_at is not null, "SI", "NO") as validado,
               if(u.blocked = 1, "SI", "NO")                   as bloqueado,
               u.country                                       as pais,
               u.provincia                                     as provincia,
               u.city                                          as ciudad,
               u.role                                          as rol,
               u.userName                                      as usuario,
               u.profesion                                     as profesion,
               u.description                                   as descripcion,
               u.facebook                                      as facebook,
               u.whatsapp                                      as whatsapp,
               u.twitter                                       as twitter,
               u.instagram                                     as instagram,
               (ingreso - egreso - quemado)                              as balance
        from (
                 select users.id, ifnull(sum(t2.amount), 0) as ingreso
                 from users
                          left join transactions t2
                                    on users.id = t2.`to` and t2.deleted_at is null and t2.type IN ("TRANSFER", "MINT")
                 where users.deleted_at is null
                 group by users.id) x1
                 join (
            select users.id, ifnull(sum(t1.amount), 0) as egreso
            from users
                     left join transactions t1 on users.id = t1.`from` and t1.deleted_at is null and t1.type IN ("TRANSFER")
            where users.deleted_at is null
            group by users.id) x2
                      on x1.id = x2.id
                 join(
            select users.id, ifnull(sum(t3.amount), 0) as quemado
            from users
                     left join transactions t3 on users.id = t3.`to` and t3.deleted_at is null and t3.type IN ("BURN")
            where users.deleted_at is null
            group by users.id) x3
                     on x2.id = x3.id
                 join users u on u.id = x1.id'));
        $data = [
            'draw' => $request->query('draw'),
            "recordsTotal" => User::count(),
            "recordsFiltered" => User::count(),
            'data' => $users
        ];
        return response()->json($data);
    }

    public function transaccionesPorUsuario(Request $request)
    {
        $userId = $request->userId;
        $txs = $this->getTransaccionesSimples($userId);
        $data = [
            'draw' => $request->query('draw'),
            'recordsTotal' => count($txs),
            'recordsFiltered' => count($txs),
            'data' => $txs
        ];

        return response()->json($data);
    }

    public function ascender(Request $request)
    {
        $userId = $request->id;
        $user = User::find($userId);
        $user->role = $user->role == "admin" ? "user" : "admin";
        $user->save();
        $data = ["success" => true, "message" => $user->role == "admin" ? "Usuario fue ascendido a admin" : "Usuario no es más admin"];
        return response()->json($data);
    }

    public function bloquear(Request $request)
    {
        $userId = $request->id;
        $user = User::find($userId);
        $user->blocked = $user->blocked == 0 ? 1 : 0;
        $user->save();
        $data = ["success" => true, "message" => $user->blocked == 1 ? "Usuario bloqueado" : "Usuario desbloqueado"];
        return response()->json($data);
    }

    public function eliminar(Request $request)
    {
        $userId = $request->id;
        $user = User::find($userId);
        $user->email = "deleted-" . $user->email;
        $user->save();
        User::destroy($userId);
        $data = ["success" => true];
        return response()->json($data);
    }

    public function transacciones_json(Request $request)
    {
        $data = [
            'draw' => $request->query('draw'),
            "recordsTotal" => Transaction::count(),
            "recordsFiltered" => Transaction::count(),
            'data' => $this->getTransaccionesSimples()
        ];
        return response()->json($data);
    }

    private function getTransaccionesSimples($userId = 0)
    {
        $txs = Transaction::with('getFromUser:id,name,lastName')->with('getToUser:id,name,lastName')->with('capId:id,title')->orderBy('id', 'desc');
        if ($userId > 0) {
            $txs = $txs->where('from', $userId)->orWhere('to', $userId);
        }
        return $txs->get();
    }


    public function postulaciones_json(Request $request)
    {
        $this->isAdmin();
        $data = [
            'draw' => $request->query('draw'),
            "recordsTotal" => ContestApplicationModel::count(),
            "recordsFiltered" => ContestApplicationModel::count(),
            'data' => ContestApplicationModel::with('owner')->with('status')->get()
        ];
        return response()->json($data);
    }

    public function contest_json(Request $request)
    {
        $data = [
            'draw' => $request->query('draw'),
            "recordsTotal" => ContestModel::count(),
            "recordsFiltered" => ContestModel::count(),
            'data' => ContestModel::all()
        ];
        return response()->json($data);
    }
}
