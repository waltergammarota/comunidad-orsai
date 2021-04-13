<?php

namespace App\Http\Controllers\Admin;

use App\Databases\DolarModel;
use App\Databases\MoneyTransactionModel;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class MoneyController extends Controller
{
    public function index()
    {
        $data['cotizacion'] = DolarModel::getDolarPrice();
        return view('admin.money.index', $data);
    }

    public function add(Request $request)
    {
        $request->validate([
            "amount" => "required",
            "data" => "required",
            "type" => "required"
        ]);
        $user = Auth::user();
        $tx = new MoneyTransactionModel([
            'user_id' => $user->id,
            'type' => $request->type,
            'data' => $request->data,
            'payment_id' => $request->payment_id,
            'currency' => 'USD',
            'cotizacion' => DolarModel::getDolarPrice(),
            'amount' => $request->amount,
            'fecha' => Carbon::parse($request->fecha)->format('Y-m-d H:i:s'),
        ]);
        $tx->save();
        return Redirect::to('admin/gestion-dinero');
    }


    public function dinero_json(Request $request)
    {
        $txs = MoneyTransactionModel::all();
        $items = array_map(function ($item) {
            return [
                'user' => User::find($item['user_id'])->userName,
                'type' => strtolower($item['type']) == "mint" ? "INGRESO" : "EGRESO",
                'description' => $item['data'],
                'payment_id' => $item['payment_id'],
                'amount' => $item['type'] == "mint" ? $item['amount'] : $item['amount'] * -1,
                'fecha' => $item['fecha']
            ];
        }, $txs->toArray());

        $data = [
            'draw' => $request->query('draw'),
            "recordsTotal" => MoneyTransactionModel::count(),
            "recordsFiltered" => MoneyTransactionModel::count(),
            'data' => $items
        ];
        return response()->json($data);
    }

}
