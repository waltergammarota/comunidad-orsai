<?php

namespace App\Http\Controllers\Admin;

use App\Databases\CotizacionModel;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CotizacionController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = "Cotizaciones";
        return view('admin.cotizaciones.index', $data);
    }

    public function cotizaciones_json(Request $request)
    {
        $cotizaciones = CotizacionModel::orderBy('created_at', 'desc')->with('user:id,email')->get();
        $data = [
            'draw' => $request->query('draw'),
            "recordsTotal" => CotizacionModel::count(),
            "recordsFiltered" => CotizacionModel::count(),
            'data' => $cotizaciones
        ];
        return response()->json($data);
    }

    public function create(Request $request)
    {
        $data['title'] = "Cotizaciones";
        $data['cotizacion'] = null;
        return view('admin.cotizaciones.form', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            "precio" => 'required',
        ]);
        $cotizacion = new CotizacionModel([
            "user_id" => Auth::user()->id,
            "precio" => $request->precio,
        ]);
        $cotizacion->save();
        return Redirect::to('admin/cotizaciones/');
    }
}
