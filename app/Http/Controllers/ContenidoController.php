<?php


namespace App\Http\Controllers;

use App\Databases\CommentsModel;
use App\Databases\ContenidoModel;
use App\Databases\HomeModel;
use App\User;
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
        $data['sociosPosta'] = User::whereNotNull('email_verified_at')->whereNotNull('phone_verified_at')->count();
        $data['sociosBeta'] = User::whereNotNull('email_verified_at')->count() - $data['sociosPosta'];

        if (Auth::check()) {
            $emailWasValidated = Auth::user()->email_verified_at != null;
            if (!$emailWasValidated) {
                return Redirect::to('panel');
            }
        }

        $slug = $request->route('slug');
        $page = $request->input('pagina') ? $request->input('pagina') : 1;
        if ($slug == null) {
            $homes = HomeModel::all();
            $data['home1'] = "";
            $data['home2'] = "";
            if (count($homes) > 1) {
                $data['home1'] = $homes[0]->description;
                $data['home2'] = $homes[1]->description;
            }
            return view("2021-home", $data);
        } else {
            if ($slug == "novedades") {
                $data['noticias'] = $this->getNoticias($page);
                return view("noticias.2021-noticias", $data);
            } else {
                $contenido = ContenidoModel::where(["slug" => $slug, "visible" => 1])->first();
                if ($contenido == null) {
                    abort(404);
                }
                if (($contenido->publica == 0 && !Auth::check())) {
                    session(["last_visited" => url("novedades/{$slug}")]);

                    return Redirect::to('ingresar');
                }
                $data['coral_token'] = $this->generateToken();
                if ($contenido->tipo == "noticia") {
                    $data['noticia'] = $contenido;
                    return view("noticias.2021-noticia", $data);
                }

                $data['pagina'] = $contenido;
                return view("2021-pagina", $data);
            }
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
        $data['noticias'] = CommentsModel::getCommentsData($data['noticias']);
        $data['previous'] = $page - 1;
        $data['current_page'] = $page;
        $data['next'] = ContenidoModel::where(["tipo" => "noticia", "visible" => 1])->whereDate('fecha_publicacion', '<=', date('Y-m-d'))->limit($limit)->offset($page * $limit)->count() > 0 ? $page + 1 : $page;
        return $data;
    }
}
