<?php

namespace App\Http\Controllers\Admin;

use App\Databases\ContenidoModel;
use App\Databases\ContestModel;
use App\Http\Controllers\Controller;
use App\Repositories\FileRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ContenidoController extends Controller
{
    public function index(Request $request)
    {
        if ($request->type == "pagina") {
            $data['title'] = "Páginas";
            $data['type'] = "pagina";
            return view('admin.noticias', $data);
        }
        $data['title'] = "Novedades";
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
        $imageKey = "";
        if ($image) {
            $imageKey = $image->pivot->id;
            $imageUrl = url('storage/images/' . $image->name . "." . $image->extension);
        }
        $concursos = ContestModel::all();
        return view('admin.noticias-form', compact('contenido', 'imageUrl', 'type', 'imageKey', 'concursos'));
    }

    public function contenidos_json(Request $request)
    {
        $tipo = $request->type;
        $data = [
            'draw' => $request->query('draw'),
            "recordsTotal" => ContenidoModel::where("tipo", $tipo)->count(),
            "recordsFiltered" => ContenidoModel::where("tipo", $tipo)->count(),
            'data' => ContenidoModel::where("tipo", $tipo)->orderBy("fecha_publicacion", "desc")->get()];
        return response()->json($data);
    }

    public function create(Request $request)
    {
        $contenido = null;
        $type = $request->type;
        $imageUrl = '';
        $now = Carbon::now()->format('Y-m-d');
        $concursos = ContestModel::all();
        return view('admin.noticias-form', compact('contenido', 'type', 'imageUrl', 'now', 'concursos'));
    }

    public function store(Request $request)
    {
        $noticia = $this->createPage($request);
        return Redirect::to('admin/contenidos/tipo/' . $noticia->tipo);
    }

    public function createPageByPost(Request $request)
    {
        $noticia = $this->createPage($request);
        return response()->json(["id" => $noticia->id]);
    }

    private function generateSlug($slug, $title, $id)
    {
        $auxSlug = $slug == null || $slug == '' ? $title : $slug;
        $slug = str_replace(" ", "-", $auxSlug);
        $qty = ContenidoModel::where("slug", $slug)->count();
        $ownerSlugId = $qty > 0 ? ContenidoModel::where("slug", $slug)->first()->id : 0;
        if ($qty == 0) {
            return $slug;
        }
        if ($qty == 1 && $id == $ownerSlugId) {
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
            'contest_id' => 'required'
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
        $noticia->publica = $request->publica;
        $noticia->contest_id = $request->contest_id;
        $noticia->save();
        $fileRepo = new FileRepository();
        $images = $fileRepo->getUploadedFiles('images', $request);
        $imagesIds = $this->convertToIds($images);
        if (count($imagesIds) > 0) {
            $noticia->images()->sync($imagesIds);
        }
        $type = $noticia->tipo;
        return Redirect::to('admin/contenidos/' . $request->id);
    }

    public function deleteImage(Request $request)
    {
        $imageId = $request->key;
        DB::table('contenido_files')->where('id', $imageId)->delete();
        echo json_encode(["message" => $imageId]);
    }

    public function eliminar(Request $request)
    {
        $noticiaId = $request->id;
        ContenidoModel::destroy($noticiaId);
        return response()->json(["success" => true]);
    }

    /**
     * @param Request $request
     * @return ContenidoModel
     */
    public function createPage(Request $request): ContenidoModel
    {
        $request->validate([
            "title" => "required",
            "fecha_publicacion" => "required|date",
            "tipo" => "required",
            "texto" => "required",
            'images' => 'array',
            'images.*' => 'image|max:5120',
            'contest_id' => 'required'
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
            "visible" => $request->visible,
            "publica" => $request->publica,
            'contest_id' => $request->contest_id
        ]);
        $noticia->save();
        $fileRepo = new FileRepository();
        $images = $fileRepo->getUploadedFiles('images', $request);
        $imagesIds = $this->convertToIds($images);
        $noticia->images()->sync($imagesIds);
        return $noticia;
    }
}
