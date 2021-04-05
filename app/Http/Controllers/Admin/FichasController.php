<?php

namespace App\Http\Controllers\Admin;

use App\Databases\CiudadModel;
use App\Databases\FichasLog;
use App\Databases\PaisModel;
use App\Databases\ProvinciaModel;
use App\Databases\Transaction;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class FichasController extends Controller
{
    public function index()
    {
        return view('admin.gestion-fichas');
    }

    public function send(Request $request)
    {
        $request->validate([
            "opcion" => "required",
            "amount" => "required",
            "data" => "required",
            "type" => "required"
        ]);
        $opcion = $request->opcion;

        switch ($opcion) {
            case 0:
                $this->sendAllUsers($request->amount, $request->data, $request->type);
                break;
            case 1:
                $this->sendToUsers($request->users, $request->amount, $request->data, $request->type);
                break;
            case 2:
                $this->sendToListUsers($request->filters, $request->amount, $request->data, $request->type);
                break;
        }

        return Redirect::to('admin/gestion-fichas');
    }

    private function sendToListUsers($filters, $amount, $data, $type)
    {
        $countries = array_key_exists('country', $filters) ? $filters['country'] : [];
        $provincias = array_key_exists('provincia', $filters) ? $filters['provincia'] : [];
        $cities = array_key_exists('city', $filters) ? $filters['city'] : [];
        $operacion = array_key_exists('operacion', $filters) ? $filters['operacion'] : 0;
        $balance = array_key_exists('balance', $filters) ? $filters['balance'] : 0;
        $users = User::where('email_verified_at', '!=', null);
        $profesion = array_key_exists('profesion', $filters) ? $filters['profesion'] : "";
        $startDate = array_key_exists('start', $filters['birth_date']) ? $filters['birth_date']['start'] : "";
        $endDate = array_key_exists('end', $filters['birth_date']) ? $filters['birth_date']['end'] : "";
        if (count($countries) > 0) {
            $users->whereIn('country', $countries);
        }
        if (count($provincias) > 0) {
            $users->whereIn('provincia', $provincias);
        }
        if (count($cities) > 0) {
            $users->whereIn('city', $cities);
        }
        if ($profesion != "") {
            $users->where('profesion', 'like', "%{$profesion}%");
        }
        if ($startDate != "") {
            $users->where("birth_date", ">=", $startDate);
        }
        if ($endDate != "") {
            $users->where("birth_date", "<", $endDate);
        }
        $filteredUsers = $users->get();
        $finalUsers = [];
        $sum = 0;
        foreach ($filteredUsers as $user) {
            $amountAux = $amount;
            $saldo = $user->getBalance();
            if ($operacion == 0) {
                if ($type == 'burn') {
                    $balance = $saldo();
                    $amountAux = $amount <= $balance ? $amount : $balance;
                }
                $tx = new Transaction([
                    "from" => 1,
                    "to" => $user->id,
                    "data" => $data,
                    "type" => $type,
                    "amount" => $amountAux >= 0 ? $amountAux : 0
                ]);
                $tx->save();
                $sum += $amountAux;
                $finalUsers[] = $user->id;
            }
            if ($operacion == 1) {
                if ($saldo == $balance) {
                    if ($type == 'burn') {
                        $balance = $saldo;
                        $amountAux = $amount <= $balance ? $amount : $balance;
                    }
                    $tx = new Transaction([
                        "from" => 1,
                        "to" => $user->id,
                        "data" => $data,
                        "type" => $type,
                        "amount" => $amountAux >= 0 ? $amountAux : 0
                    ]);
                    $tx->save();
                    $sum += $amountAux;
                    $finalUsers[] = $user->id;
                }
            }
            if ($operacion == 2) {
                if ($saldo > $balance) {
                    if ($type == 'burn') {
                        $balance = $saldo;
                        $amountAux = $amount <= $balance ? $amount : $balance;
                    }
                    $tx = new Transaction([
                        "from" => 1,
                        "to" => $user->id,
                        "data" => $data,
                        "type" => $type,
                        "amount" => $amountAux >= 0 ? $amountAux : 0
                    ]);
                    $tx->save();
                    $sum += $amountAux;
                    $finalUsers[] = $user->id;
                }
            }

            if ($operacion == 3) {
                if ($saldo < $balance) {
                    if ($type == 'burn') {
                        $balance = $saldo;
                        $amountAux = $amount <= $balance ? $amount : $balance;
                    }
                    $tx = new Transaction([
                        "from" => 1,
                        "to" => $user->id,
                        "data" => $data,
                        "type" => $type,
                        "amount" => $amountAux >= 0 ? $amountAux : 0
                    ]);
                    $tx->save();
                    $sum += $amountAux;
                    $finalUsers[] = $user->id;
                }
            }
        }
        $log = new FichasLog([
            'user_id' => Auth::user()->id,
            'destinatarios' => Str::substr(json_encode($finalUsers), 0, 256),
            'cantidad_puntos' => $amount,
            'cantidad_users' => count($finalUsers),
            'total_puntos' => $sum,
            'tipo' => $type == 'mint' ? 'entregar' : 'quitar',
            'description' => $data,
            'filtros' => json_encode([
                "paises" => $countries,
                "provincias" => $provincias,
                "ciudades" => $cities,
                "operacion" => $operacion,
                "balance" => $balance,
                "profesion" => $profesion,
                "desde" => $startDate,
                "hasta" => $endDate
            ])
        ]);
        $log->save();
    }

    private function sendToUsers($users, $amount, $data, $type)
    {
        $sum = 0;
        foreach ($users as $userId) {
            $amountAux = $amount;
            $user = User::find($userId);
            if ($user != null) {
                if ($type == 'burn') {
                    $balance = $user->getBalance();
                    $amountAux = $amount <= $balance ? $amount : $balance;
                }
                if ($amountAux == 0 || $user->email_verified_at == null) {
                    continue;
                }
                $tx = new Transaction([
                    "from" => 1,
                    "to" => $user->id,
                    "data" => $data,
                    "type" => $type,
                    "amount" => $amountAux >= 0 ? $amountAux : 0
                ]);
                $tx->save();
                $sum += $amountAux;
            }
        }
        $log = new FichasLog([
            'user_id' => Auth::user()->id,
            'destinatarios' => json_encode($users),
            'cantidad_puntos' => $amount,
            'cantidad_users' => count($users),
            'total_puntos' => $sum,
            'tipo' => $type == 'mint' ? 'entregar' : 'quitar',
            'description' => $data
        ]);
        $log->save();
    }

    private function sendAllUsers($amount, $data, $type)
    {
        $idPool = 1;
        User::select('id')->where('email_verified_at', '!=', 'null')->where('id', '>', $idPool)->chunk(250, function ($users) use ($amount, $data, $type) {
            $sum = 0;
            foreach ($users as $user) {
                $amountAux = $amount;
                if ($type == "burn") {
                    $balance = $user->getBalance();
                    $amountAux = $amount <= $balance ? $amount : $balance;
                }
                if ($amountAux == 0) {
                    continue;
                }
                $tx = new Transaction([
                    "from" => 1,
                    "to" => $user->id,
                    "data" => $data,
                    "type" => $type,
                    "amount" => $amountAux >= 0 ? $amountAux : 0
                ]);
                $tx->save();
                $sum += $amountAux;
            }
            $log = new FichasLog([
                'user_id' => Auth::user()->id,
                'destinatarios' => 'Todos',
                'cantidad_puntos' => $amount,
                'cantidad_users' => count($users),
                'total_puntos' => $sum,
                'tipo' => $type == 'mint' ? 'entrega' : 'quitar',
                'description' => $data
            ]);
            $log->save();
        });
    }

    public function search_users(Request $request)
    {
        $search = '%' . $request->search . '%';
        $users = User::where('name', 'like', $search)->orWhere('lastName', 'like', $search)->orWhere('email', 'like', $search)->take(10)->get();
        $options = [];
        foreach ($users as $user) {
            if ($user->email_verified_at != null) {
                $row = ['id' => $user->id, 'text' => "{$user->name} {$user->lastName} - {$user->email}"];
                array_push($options, $row);
            }
        }
        return response()->json(["results" => $options]);
    }

    public function search_paises(Request $request)
    {
        $search = '%' . $request->search . '%';
        $paises = PaisModel::where('nombre', 'like', $search)->get();
        $options = [];
        foreach ($paises as $pais) {
            $row = ['id' => utf8_encode($pais->nombre), 'text' => utf8_encode($pais->nombre)];
            array_push($options, $row);
        }
        return response()->json(["results" => $options]);
    }

    public function search_provincias(Request $request)
    {
        $search = '%' . $request->search . '%';
        $provincias = ProvinciaModel::where('nombre', 'like', $search)->get();
        $options = [];
        foreach ($provincias as $provincia) {
            $row = ['id' => utf8_encode($provincia->nombre), 'text' => utf8_encode($provincia->nombre)];
            array_push($options, $row);
        }
        return response()->json(["results" => $options]);
    }

    public function search_ciudades(Request $request)
    {
        $search = '%' . $request->search . '%';
        $ciudades = CiudadModel::where('nombre', 'like', $search)->get();
        $options = [];
        foreach ($ciudades as $ciudad) {
            $row = ['id' => utf8_encode($ciudad->nombre), 'text' => utf8_encode($ciudad->nombre)];
            array_push($options, $row);
        }
        return response()->json(["results" => $options]);
    }


    public function show_logs(Request $request)
    {
        $logs = FichasLog::all();
        $data = [];
        foreach ($logs as $log) {
            $row = [
                "id" => $log->id,
                "emisor" => $log->owner->name . " " . $log->owner->lastName,
                "destinatarios" => $log->destinatarios,
                "puntos" => $log->cantidad_puntos,
                "usuarios" => $log->cantidad_users,
                "description" => $log->description,
                "total_puntos" => $log->total_puntos,
                "tipo" => $log->tipo,
                "filtros" => $log->filtros,
                "created_at" => $log->created_at->format('d/m/Y H:i'),
            ];
            array_push($data, $row);
        }
        $data = [
            'draw' => $request->query('draw'),
            "recordsTotal" => FichasLog::count(),
            "recordsFiltered" => FichasLog::count(),
            'data' => $data
        ];
        return response()->json($data);
    }
}
