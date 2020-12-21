<?php

namespace App\Http\Controllers\Admin;

use App\Databases\ProductoModel;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = "Productos";
        $data['dolar'] = $this->getDolarPrice();
        return view('admin.productos.index', $data);
    }

    public function productos_json(Request $request)
    {
        $productos = ProductoModel::all();
        $data = [
            'draw' => $request->query('draw'),
            "recordsTotal" => ProductoModel::count(),
            "recordsFiltered" => ProductoModel::count(),
            'data' => $productos
        ];
        return response()->json($data);
    }

    private function getDolarPrice()
    {
        $client = new Client();
        $url = "https://www.dolarsi.com/api/api.php?type=valoresprincipales";
        $response = $client->get($url);
        return json_decode($response->getBody());
    }

    public function create(Request $request)
    {
        $data['title'] = "Productos";
        $data['producto'] = null;
        return view('admin.productos.form', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => 'required',
            "price" => 'required|min:1|max:10000',
            "fichas" => 'required|min:1|max:10000',
            "description" => 'max:1000',
            "visible" => 'min:0|max:1'
        ]);
        $producto = new ProductoModel([
            "user_id" => Auth::user()->id,
            "name" => $request->name,
            "description" => $request->description,
            "price" => $request->price,
            "fichas" => $request->fichas,
            "visible" => $request->visible
        ]);
        $producto->save();
        return Redirect::to('admin/productos/' . $producto->id);
    }

    public function update(Request $request)
    {
        $request->validate([
            "name" => 'required',
            "price" => 'required|integer|between:1,10000',
            "fichas" => 'required|integer|between:1,10000',
            "description" => 'max:1000',
        ]);
        $producto = ProductoModel::find($request->id);
        $producto->user_id = Auth::user()->id;
        $producto->name = $request->name;
        $producto->description = $request->description;
        $producto->price = $request->price;
        $producto->visible = $request->visible ? 1 : 0;
        $producto->fichas = $request->fichas;
        $producto->save();
        return Redirect::to('admin/productos/' . $producto->id);
    }

    public function edit(Request $request)
    {
        $id = $request->route('id');
        $data['producto'] = ProductoModel::find($id);
        $data['title'] = "Productos";
        return view('admin.productos.form', $data);
    }
}