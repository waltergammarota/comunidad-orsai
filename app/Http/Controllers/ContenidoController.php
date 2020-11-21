<?php


namespace App\Http\Controllers;

use App\Databases\ContenidoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Nowakowskir\JWT\TokenDecoded;

class ContenidoController extends Controller
{
    public function index(Request $request)
    {
        $data = $this->getUserData();
        if (Auth::check()) {
            $emailWasValidated = Auth::user()->email_verified_at != null;
            if (!$emailWasValidated) {
                return Redirect::to('panel');
            }
        }

        $slug = $request->route('slug');
        $page = $request->input('pagina') ? $request->input('pagina') : 1;
        if ($slug == "novedades" || $slug == null) {
            $data['noticias'] = $this->getNoticias($page);
            return view("noticias.noticias", $data);
        } else {
            $contenido = ContenidoModel::where(["slug" => $slug, "visible" => 1])->first();
            if ($contenido == null) {
                session(['last_values' =>  $data]);
                abort(404);
            }
            if (($contenido->publica == 0 && !Auth::check())) {
                return Redirect::to('ingresar');
            }
            $data['coral_token'] = $this->generateToken();
            if ($contenido->tipo == "noticia") {
                $data['noticia'] = $contenido;
                return view("noticias.noticia", $data);
            }

            $data['pagina'] = $contenido;
            return view("pagina-template", $data);
        }
    }

    private function generateToken()
    {
        $key = env("CORAL_SECRET");
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->coral_token == "") {
                $id = DB::select(DB::raw('SELECT UUID() as id'));
                if (count($id) > 0) {
                    $user->coral_token = $id[0]->id;
                    $user->save();
                }
            }
            $email = $user->email;
            $username = $user->name . " " . $user->lastName;
            $coral_token = $user->coral_token;
            $payload = [
                "user" => [
                    "id" => $coral_token,
                    "email" => $email,
                    "username" => $username,
                    "role" => "COMMENTER"
                ]
            ];
            $tokenDecoded = new TokenDecoded(['alg' => 'HS256'], $payload);
            return $tokenDecoded->encode($key);
        }
        return "";
    }

    private function getNoticias($page = 1)
    {
        $limit = 50;
        $offset = ($page - 1) * $limit;
        $data['noticias'] = ContenidoModel::where(["tipo" => "noticia", "visible" => 1])->whereDate('fecha_publicacion', '<=', date('Y-m-d'))->limit($limit)->offset($offset)->orderBy('fecha_publicacion', 'desc')->get();
        $data['previous'] = $page - 1;
        $data['current_page'] = $page;
        $data['next'] = ContenidoModel::where(["tipo" => "noticia", "visible" => 1])->whereDate('fecha_publicacion', '<=', date('Y-m-d'))->limit($limit)->offset($page * $limit)->count() > 0 ? $page + 1 : $page;
        return $data;
    }
}
