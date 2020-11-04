<?php

namespace App\Http\Controllers\Admin;

use App\Databases\ContestApplicationModel;
use App\Databases\ContestModel;
use App\Databases\FichasLog;
use App\Databases\Transaction;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Reference;

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

    private function sendToUsers($users, $amount, $data, $type)
    {
        foreach ($users as $userId) {
            $amountAux = $amount;
            $user = User::find($userId);
            if ($user != null) {
                if ($type == 'burn') {
                    $balance = $user->getBalance();
                    $amountAux = $amount <= $balance ? $amount : $balance;
                }
                if($amountAux == 0 || $user->email_verified_at == null) {
                    continue;
                }
                $tx = new Transaction([
                    "from" => 1,
                    "to" => $user->id,
                    "data" => $data,
                    "type" => $type,
                    "amount" => $amountAux >= 0? $amountAux: 0
                ]);
                $tx->save();
            }
        }
        $log = new FichasLog([
            'user_id' => Auth::user()->id,
            'destinatarios' => json_encode($users),
            'cantidad_puntos' => $amount,
            'cantidad_users' => count($users),
            'description' => $data
        ]);
        $log->save();
    }

    private function sendAllUsers($amount, $data, $type)
    {
        $idPool = 1;
        $users =User::select('id')->where('email_verified_at', '!=', 'null')->where('id', '>', $idPool)->get();
        $sum = 0;
        foreach ($users as $user) {
            $amountAux = $amount;
            if ($type == "burn") {
                $balance = $user->getBalance();
                $amountAux = $amount <= $balance ? $amount : $balance;
            }
            if($amountAux == 0 ) {
                continue;
            }
            $tx = new Transaction([
                "from" => 1,
                "to" => $user->id,
                "data" => $data,
                "type" => $type,
                "amount" => $amountAux >= 0? $amountAux: 0
            ]);
            $tx->save();
            $sum += $amount;
        }
        $log = new FichasLog([
            'user_id' => Auth::user()->id,
            'destinatarios' => 'Todos',
            'cantidad_puntos' => $amount,
            'cantidad_users' => User::count(),
            'description' => $data
        ]);
        $log->save();
    }

    public function search_users(Request $request)
    {
        $search = '%' . $request->search . '%';
        $users = User::where('name', 'like', $search)->orWhere('lastName', 'like', $search)->orWhere('email', 'like', $search)->take(10)->get();
        $options = [];
        foreach ($users as $user) {
            if($user->email_verified_at != null ) {
                $row = ['id' => $user->id, 'text' => "{$user->name} {$user->lastName} - {$user->email}"];
                array_push($options, $row);
            }
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
