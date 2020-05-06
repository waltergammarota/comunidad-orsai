<?php

namespace App\Http\Controllers\Admin;

use App\Databases\ContenidoModel;
use App\Http\Controllers\Controller;
use App\Repositories\FileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ContenidoController extends Controller
{
    public function index() {
        $this->isAdmin();
        return view('admin.noticias');
    }

    public function edit(Request $request) {
        $this->isAdmin();
        $id = $request->route('id');
        $noticia = ContenidoModel::find($id);
        $image = $noticia->images()->first();
        $imageUrl = "";
        if($image) {
            $imageUrl = url('storage/images/'.$image->name.".".$image->extension);
        }
        return view('admin.noticias-form',compact('noticia','imageUrl'));
    }

    public function noticias_json(Request $request) {
        $this->isAdmin();
        $data = [
            'draw' => $request->query('draw'),
            "recordsTotal" =>  ContenidoModel::count(),
            "recordsFiltered" =>  ContenidoModel::count(),
            'data' => ContenidoModel::all()];
        return response()->json($data);
    }

    public function create(Request $request) {
        $this->isAdmin();
        $noticia = null;
        return view('admin.noticias-form',compact('noticia'));
    }

    public function store(Request $request) {
        $request->validate([
            "title" => "required",
            "autor" => "required",
            "fecha_publicacion" => "required|date",
            "copete" => "required",
            "tipo" => "required",
            "texto" => "required",
            'images' => 'array',
            'images.*' => 'image|max:5120',
        ]);

        $slug = str_replace(" ", "-", $request->title);
        $noticia = new ContenidoModel([
            "title"=> $request->title,
            "autor"=> $request->autor,
            "fecha_publicacion"=> $request->fecha_publicacion,
            "copete"=> $request->copete,
            "tipo"=> $request->tipo,
            "texto"=> $request->texto,
            "slug" => $slug,
            "user_id" => Auth::user()->id,
            "visible" => $request->visible
        ]);

        $noticia->save();
        $fileRepo = new FileRepository();
        $images = $fileRepo->getUploadedFiles('images',$request);
        $imagesIds = $this->convertToIds($images);
        $noticia->images()->sync($imagesIds);
        return Redirect::to('admin/noticias');
    }

    private function convertToIds($images) {
        $data = [];
        foreach($images as $image) {
            $data[] = $image->getId();
        }
        return $data;
    }

    public function update(Request $request) {
        $request->validate([
            "title" => "required",
            "autor" => "required",
            "fecha_publicacion" => "required|date",
            "copete" => "required",
            "tipo" => "required",
            "texto" => "required",
        ]);

        $slug = str_replace(" ", "-", $request->title);
        $noticia = ContenidoModel::find($request->id);
        $noticia->slug = $slug;
        $noticia->title = $request->title;
        $noticia->autor = $request->autor;
        $noticia->fecha_publicacion = $request->fecha_publicacion;
        $noticia->copete = $request->copete;
        $noticia->tipo = $request->tipo;
        $noticia->texto = $request->texto;
        $noticia->user_id = Auth::user()->id;
        $noticia->visible = $request->visible;
        $noticia->save();
        $fileRepo = new FileRepository();
        $images = $fileRepo->getUploadedFiles('images',$request);
        $imagesIds = $this->convertToIds($images);
        if(count($imagesIds) > 0) {
            $noticia->images()->sync($imagesIds);
        }
        return Redirect::to('admin/noticias');
    }
}
