<?php

namespace App\Http\Controllers;

use App\Databases\CompraModel;
use App\Databases\ContestModel;
use App\Databases\Transaction;
use App\User;
use App\Utils\Mailer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TransparenciaController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->getUserData();
        $data['total'] = CompraModel::where('processed', 1)->sum('amount');
        $data['user'] = Auth::user();
        $baldeoymordida = Transaction::getFichasBaldeosYMordidas();
        $data['baldeosYMordidas'] = $this->changeNumberFormat($baldeoymordida);
        $fichasEnJuego = Transaction::getFichasEnJuego();
        $data['fichasEnJuego'] = $this->changeNumberFormat($fichasEnJuego);
        $fichasEnBilleteras = Transaction::getFichasEnBilleteras();
        $data['fichasEnBilleteras'] = $this->changeNumberFormat($fichasEnBilleteras);
        return view('transparencia.index', $data);
    }

    public function changeNumberFormat($number)
    {
        $number = number_format($number, 0, ',', '.');
        return $number;
    }

    public function transparencia_json(Request $request)
    {
        $start = $request->start;
        $limit = $request->length;
        $offset = $start;
        $data = [];
        $recordsTotal = 0;
        $recordsFiltered = 0;
        $params = $request->query('query') == "fichas" ? "fichas" : "dinero";
        $contests = ContestModel::all();
        switch ($params) {
            case "dinero":
                $txsQuery = DB::table('compras')->join('users', 'compras.user_id', '=', 'users.id')
                    ->join('productos', 'productos.id', '=', 'compras.producto_id')
                    ->where('compras.processed', '=', 1)->select(DB::raw('compras.*, users.*, productos.*, compras.user_id as comprador'));
                $txs = $txsQuery->offset($offset)->limit($limit)
                    ->orderBy('compras.created_at', 'desc')->get();
                foreach ($txs as $tx) {
                    $row = [];
                    $row['id'] = $tx->payment_id;
                    $row['description'] = $this->getDineroDescription($tx);
                    $row['date'] = Carbon::create($tx->created_at)->format("d/m/Y H:i");
                    $row['type'] = $this->changeNumberFormat($tx->amount);
                    array_push($data, $row);
                }
                $recordsTotal = CompraModel::where("processed", 1)->count();
                $recordsFiltered = $txsQuery->count();
                break;
            case "fichas":
                $txsQuery = Transaction::where("id", ">", 0);
                $txs = $txsQuery->offset($offset)->limit($limit)
                    ->orderBy('created_at', 'desc')->get();
                foreach ($txs as $tx) {
                    $row = [];
                    $row['id'] = $tx->id;
                    $row['description'] = $this->getFichasDescription($tx, $contests);
                    $row['date'] = $tx->created_at->format("d/m/Y H:i");
                    $row['type'] = $this->changeNumberFormat($tx->getAmountForReport());
                    array_push($data, $row);
                }
                $recordsTotal = Transaction::count();
                $recordsFiltered = $recordsTotal;
                break;
        }
        $response = [
            "draw" => $request->draw,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $data,
        ];
        return response()->json($response);
    }

    private function getDineroDescription($tx)
    {
        $userFrom = User::find($tx->comprador);
        $userName = $userFrom->getUserName();
        return "{$userName} hizo una donación a la Comunidad Orsai";
    }

    private function getFichasDescription($tx, $contests)
    {
        $pools = array_column($contests->toArray(), "pool_id");
        $userFrom = $tx->getFromUser()->first();
        $userTo = $tx->getToUser()->first();
        $from = $userFrom->getUserName();
        $to = $userTo->getUserName();
        if ($userFrom->id == 1) {
            return "{$to} recibió fichas de {$from}";
        }
        if (in_array($userTo->id, $pools)) {
            $contest_url = "concursos/{$contests->firstWhere("pool_id", $userTo->id)->id}/" . urlencode($contests->firstWhere("pool_id", $userTo->id)->name);
            return "{$from} se postuló al <a href='{
                $contest_url}'>{$contests->firstWhere("pool_id", $userTo->id)->name}</a>";
        }
        // TODO AGREGAR VOTACION LEYENDA
        return "{$from} envió al Usuario {$to}";
    }


    public function reportar(Request $request)
    {
        $request->validate([
            "tx_id" => 'required',
            "reclamo" => 'required'
        ]);
        $mailer = new Mailer();
        $mailer->sendReclamo($request->tx_id, $request->reclamo);
        return Redirect::to('transparencia');
    }
}
