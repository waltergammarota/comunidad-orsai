<?php


namespace App\Http\Controllers;


use App\Databases\ContenidoModel;
use Illuminate\Http\Request;

class ContenidoController extends Controller
{
    public function index(Request $request) {
        $data = $this->getUserData();
        $slug = $request->route('slug');
        $page = $request->input('pagina')? $request->input('pagina'):1;
        if($slug== "" || $slug == null) {
            $data['noticias'] = $this->getNoticias($page);
            return view("noticias.noticias",$data);
        } else {
            $data['noticia'] = ContenidoModel::where(["slug"=> $slug, "visible" => 1])->first();
            return view("noticias.noticia",$data);
        }
    }

    private function getNoticias($page = 1) {
        $limit = 4;
        $offset = ($page - 1) * $limit;
        $data['noticias'] = ContenidoModel::where(["tipo"=> "noticia","visible"=>1])->whereDate('fecha_publicacion', '<=', date('Y-m-d'))->limit($limit)->offset($offset)->get();
        $data['previous'] = $page - 1;
        $data['current_page'] = $page;
        $data['next'] = ContenidoModel::where(["tipo"=> "noticia","visible"=>1])->whereDate('fecha_publicacion', '<=', date('Y-m-d'))->limit($limit)->offset($page * $limit)->count() > 0? $page + 1: $page;
        return $data;
    }
}
