<?php

namespace App\Http\Controllers\Admin;

use App\Databases\ContenidoModel;
use App\Http\Controllers\Controller;
use App\Repositories\FileRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class ContenidoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->type == "pagina") {
            $data['title'] = "Páginas";
            $data['type'] = "pagina";
            return view('admin.noticias', $data);
        }
        $data['title'] = "Noticias";
        $data['type'] = "noticia";
        return view('admin.noticias', $data);
    }

    public function edit(Request $request)
    {
        $id = $request->route('id');
        $contenido = ContenidoModel::find($id);
        $image = $contenido->images()->first();
        $type = $contenido->tipo;
        $imageUrl = "";
        if ($image) {
            $imageUrl = url('storage/images/' . $image->name . "." . $image->extension);
        }
        return view('admin.noticias-form', compact('contenido', 'imageUrl', 'type'));
    }

    public function contenidos_json(Request $request)
    {
        $tipo = $request->type;
        $data = [
            'draw' => $request->query('draw'),
            "recordsTotal" => ContenidoModel::where("tipo", $tipo)->count(),
            "recordsFiltered" => ContenidoModel::where("tipo", $tipo)->count(),
            'data' => ContenidoModel::where("tipo", $tipo)->get()];
        return response()->json($data);
    }

    public function create(Request $request)
    {
        $contenido = null;
        $type = $request->type;
        return view('admin.noticias-form', compact('contenido', 'type'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "title" => "required",
            "fecha_publicacion" => "required|date",
            "tipo" => "required",
            "texto" => "required",
            'images' => 'required|array',
            'images.*' => 'image|max:5120',
        ]);
        $slug = $this->generateSlug($request->slug, $request->title, 0);
        $noticia = new ContenidoModel([
            "title" => $request->title,
            "slug" => $slug,
            "autor" => $request->autor,
            "fecha_publicacion" => $request->fecha_publicacion,
            "copete" => $request->copete,
            "tipo" => $request->tipo,
            "texto" => $request->texto,
            "slug" => $slug,
            "user_id" => Auth::user()->id,
            "visible" => $request->visible
        ]);
        $noticia->save();
        $fileRepo = new FileRepository();
        $images = $fileRepo->getUploadedFiles('images', $request);
        $imagesIds = $this->convertToIds($images);
        $noticia->images()->sync($imagesIds);
        return Redirect::to('admin/contenidos/tipo/' . $noticia->tipo);
    }

    private function generateSlug($slug, $title, $id)
    {
        $auxSlug = $slug == null || $slug == '' ? $title : $slug;
        $slug = str_replace(" ", "-", $auxSlug);
        $qty = ContenidoModel::where("slug", $slug)->count();
        $ownerSlugId = $qty > 0? ContenidoModel::where("slug", $slug)->first()->id: 0;
        if ($qty == 0) {
            return $slug;
        }
        if($qty == 1 && $id == $ownerSlugId) {
            return $slug;
        }
        return "{$slug}-{$qty}";

    }

    private function convertToIds($images)
    {
        $data = [];
        foreach ($images as $image) {
            $data[] = $image->getId();
        }
        return $data;
    }

    public function update(Request $request)
    {
        $request->validate([
            "title" => "required",
            "fecha_publicacion" => "required|date",
            "tipo" => "required",
            "texto" => "required",
        ]);

        $slug = $this->generateSlug($request->slug, $request->title, $request->id);
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
        $images = $fileRepo->getUploadedFiles('images', $request);
        $imagesIds = $this->convertToIds($images);
        if (count($imagesIds) > 0) {
            $noticia->images()->sync($imagesIds);
        }
        $type = $noticia->tipo;
        return Redirect::to('admin/contenidos/tipo/' . $type);
    }

    public function eliminar(Request $request)
    {
        $noticiaId = $request->id;
        ContenidoModel::destroy($noticiaId);
        return response()->json(["success" => true]);
    }
}
