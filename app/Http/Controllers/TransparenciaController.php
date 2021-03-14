<?php

namespace App\Http\Controllers;

use App\Databases\CompraModel; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TransparenciaController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->getUserData();
        $data['total'] = CompraModel::where('processed', 1)->sum('amount');
        $data['user'] = Auth::user();
        return view('transparencia.index', $data);
    }


    public function transparencia_json(Request $request)
    {
        $start = $request->start;
        $limit = $request->length;
        $offset = $start * $limit;
        $data = [];
        $txs = DB::table('compras')->join('users', 'compras.user_id', '=', 'users.id')
            ->join('productos', 'productos.id', '=', 'compras.producto_id')
            ->where('compras.processed', '=', 1)
            ->offset($start)->limit($limit)
            ->orderBy('compras.created_at', 'desc')->get();
        foreach ($txs as $tx) {
            $row = [];
            $row['id'] = $tx->payment_id;
            $row['description'] = $tx->name;
            $row['date'] = Carbon::create($tx->created_at)->format("d-m-Y H:i");
            $row['username'] = $tx->userName;
            $row['credit'] = $tx->amount;
            $row['debit'] = $tx->amount > 0 ? 0 : $tx->amount;
            array_push($data, $row);
        }
        $response = [
            "draw" => $request->draw,
            "recordsTotal" => 150,
            "recordsFiltered" => 70,
            "data" => $data,
        ];
        return response()->json($response);
    }
}
