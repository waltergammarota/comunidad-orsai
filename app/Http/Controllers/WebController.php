<?php


namespace App\Http\Controllers;

use App\Databases\ContenidoModel;
use App\Databases\ContestApplicationModel;
use App\Databases\ContestModel;
use App\Databases\Transaction;
use App\User;
use App\Utils\Mailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class WebController extends Controller
{
    public function index()
    {
        $data = $this->getUserData();
        $data['novedades'] = $this->getLatestNews(2);
        return view('index', $data);
    }

    private function getLatestNews($qty)
    {
        $novedades = ContenidoModel::where([
            "visible" => 1,
            "tipo" => "noticia"
        ])->with('images')->latest()->limit($qty)->get();
        $noticias = [];
        foreach ($novedades as $novedad) {
            $row = new \stdClass();
            $row->id = $novedad->id;
            $row->slug = $novedad->slug;
            $row->title = $novedad->title;
            $row->autor = $novedad->autor;
            $row->fecha_publicacion = $novedad->fecha_publicacion;
            $row->copete = $novedad->copete;
            $row->tipo = $novedad->tipo;
            $row->texto = $novedad->texto;
            $row->raw_images = $novedad->images()->get();
            foreach ($row->raw_images as $imagen) {
                $row->imagenes[] = url('storage/images/' . $imagen->name . "." . $imagen->extension);
            }
            $noticias[] = $row;
        }
        return $noticias;
    }

    public function restablecer_clave()
    {
        $data = $this->getUserData();
        return view('2021-restablecer-clave', $data);
    }

    public function ingresar()
    {
        if (Auth::check()) {
            return Redirect::to('panel');
        }
        $data = $this->getUserData();
        $data['totalusers'] = User::where('email_verified_at', '!=', null)->count();
        $data['sociosPosta'] = User::whereNotNull('email_verified_at')->whereNotNull('phone_verified_at')->count();
//        if(!session()->has('last_visited'))
//        {
//            $urlPrevious = url()->previous();
//            $urlBase = url()->to('/');
//            if(($urlPrevious != $urlBase . '/ingresar') && (substr($urlPrevious, 0, strlen($urlBase)) === $urlBase)) {
//                session(['last_visited' => $urlPrevious]);
//            }
//
//        }
        return view('2021-login', $data);
    }

    public function reenviar_mail_activacion()
    {
        $data = $this->getUserData();
        $data['title'] = "Reenviar mail activación";
        return view('2021-reenviar-mail-activacion', $data);
    }

    public function bases_concurso()
    {
        $data = $this->getUserData();
        return view('concurso-logo', $data);
    }

    public function concurso()
    {
        $data = $this->getUserData();
        $contest = ContestModel::find(1);
        if ($contest->start_date >= now()) {
            return view('concurso-logo', $data);
        }
        return Redirect::to('participantes');
    }

    public function fundacion()
    {
        $data = $this->getUserData();
        return view('fundacion.fundacion', $data);
    }

    public function plan()
    {
        $data = $this->getUserData();
        return view('fundacion.plan', $data);
    }

    public function consejo()
    {
        $data = $this->getUserData();
        return view('fundacion.consejo', $data);
    }

    public function donaciones()
    {
        $data = $this->getUserData();
        return view('fundacion.donaciones', $data);
    }

    public function historia()
    {
        $data = $this->getUserData();
        return view('fundacion.2021-historia', $data);
    }

    public function areas()
    {
        $data = $this->getUserData();
        return view('fundacion.areas', $data);
    }

    public function participantes(Request $request)
    {
        $contest = ContestModel::find(1);
        return $this->show_participantes($request);
        $hasWinner = $this->checkWinner(1);
        if ($contest->end_date < now()) {
            $userInfo = $this->getUserData();
            $cpasInfo = $this->getCpasInfo();
            $data = array_merge($userInfo, $cpasInfo);
            return view("concurso-finalizado", $data);
        }
        if ($contest->start_date < now() && $contest->end_date >= now() && $this->areEnoughApplications($contest)) {
        }
        return Redirect::to('bases-concurso');
    }

    private function areEnoughApplications($contest)
    {
        return ContestApplicationModel::where("approved", 1)->count() >= $contest->min_apps_qty;
    }

    private function checkWinner($contestId)
    {
        return ContestApplicationModel::where(["is_winner" => 1, "contest_id" => $contestId])->count();
    }

    public function logo()
    {
        $contest = ContestModel::find(1);
        if (!Auth::check()) {
            return Redirect::to('bases-concurso');
        }
        if ($contest->start_date >= now()) {
            return Redirect::to('concurso-logo');
        }
        if ($contest->start_date < now() && $contest->end_date >= now()) {
            return Redirect::to('participantes');
        }
        if (ContestApplicationModel::where("is_winner", 1)->first()) {
            return Redirect::to("concurso");
        }
    }

    public function getMore(Request $request)
    {
        $orden = $request->route('orden');
        $limit = $request->route('limit');
        $offset = $request->route('offset');
        $data['propuestas'] = $this->getPropuestas($orden, $limit, $offset);
        return view("propuestas", $data);
    }

    private function getPropuestas($orden, $limit = 20, $offset = 0, $request = false, $contestId = 1)
    {
        switch ($orden) {
            case "buscar":
                $propuestas = ContestApplicationModel::where('title', 'LIKE', '%' . $request->busqueda . '%')->where('contest_id', $contestId)->where('approved', 1)->with(
                    'logos'
                )->with('owner')->offset($offset)->limit($limit)->get();
                break;
            case "mas-vistos":
                $propuestas = ContestApplicationModel::where('approved', 1)->where('contest_id', $contestId)->orderBy('views', 'desc')->with(
                    'logos'
                )->with('owner')->offset($offset)->limit($limit)->get();
                break;
            case "mas-recientes":
                $propuestas = ContestApplicationModel::where('approved', 1)->where('contest_id', $contestId)->orderBy('created_at', 'desc')->with(
                    'logos'
                )->with('owner')->offset($offset)->limit($limit)->get();
                break;
            case "mas-votados":
                $propuestas = ContestApplicationModel::where('approved', 1)->where('contest_id', $contestId)->orderBy('votes', 'desc')->with(
                    'logos'
                )->with('owner')->offset($offset)->limit($limit)->get();
                break;
            case "random":
            default:
                $propuestas = ContestApplicationModel::where('approved', 1)->where('contest_id', $contestId)->inRandomOrder()->with(
                    'logos'
                )->with('owner')->offset($offset)->limit($limit)->get();
                break;
        }
        $data = [];
        foreach ($propuestas as $item) {
            $user = $item->owner()->first();
            if (Auth::check()) {
                $voted = Transaction::where(
                    ["from" => Auth::user()->id, "cap_id" => $item->id]
                )->count();
            }
            $voted = 0;
            $row = [
                "id" => $item->id,
                "title" => $item->title,
                "logos" => $item->logos()->limit(1)->get(),
                "avatar" => $user->avatar()->first(),
                "voted" => $voted,
                "user" => $user->name . " " . $user->lastName,
                "votes" => Transaction::where("cap_id", $item->id)->sum(
                    "amount"
                ),
            ];
            $data[] = $row;
        }
        return $data;
    }


    public function concurso_finalizado()
    {
        $userInfo = $this->getUserData();
        return view('concurso_finalizado', $userInfo);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show_participantes(Request $request)
    {
        $data = $this->getParticipantes($request);
        return view('participantes', $data);
    }

    private function isContestFinished($contestId)
    {
        $contest = ContestModel::find($contestId);
        return $contest->end_date < now();
    }

    private function hasWinner($contestId)
    {
        return ContestApplicationModel::where('contest_id', $contestId)->where('is_winner', 1)->count();
    }

    private function getTotal($orden, $request, $contestId = 1)
    {
        switch ($orden) {
            case "buscar":
                $total = ContestApplicationModel::where('title', 'LIKE', '%' . $request->busqueda . '%')->where('contest_id', $contestId)->where('approved', 1)->count();
                break;
            default:
                $total = ContestApplicationModel::where('approved', 1)->where('contest_id', $contestId)->count();
                break;
        }
        return $total;
    }

    public function contacto(Request $request)
    {
        $data = $this->getUserData();

        return view('2021-contacto', $data);
    }
    public function terminos(Request $request)
    {
        return Redirect::to('terminos-y-condiciones');
    }

    public function contacto_send(Request $request)
    {
        $request->validate([
            "name" => "required",
            "lastName" => "required",
            "email" => "required",
            "subject" => "required",
            "mensaje" => "required",
        ]);

        $mailer = new Mailer();
        $mailer->sendContactFormEmail($request->all());
        $request->session()->flash('alert', 'contact_data_sent');
        return Redirect::to('contacto');
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getParticipantes(Request $request, $contestId = 1): array
    {
        $userInfo = $this->getUserData();
        $cpasInfo = $this->getCpasInfo();
        $data = array_merge($userInfo, $cpasInfo);
        $orden = $request->route('orden');
        $page = $request->route('page') ? $request->route('page') : 1;
        $total = $this->getTotal($orden, $request, $contestId);
        $limit = 20;
        $offset = ($page - 1) * $limit;
        $totalPages = ceil($total / $limit);
        $data['total'] = $total;
        $data['offset'] = $offset;
        $data['limit'] = $limit;
        $data['totalPages'] = $totalPages;
        $data['current_page'] = $page;
        $data['previous_page'] = $page - 1;
        $data['next_page'] = ($page + 1) > $totalPages ? $totalPages : ($page + 1);
        $data['propuestas'] = $this->getPropuestas($orden, $limit, $offset, $request, $contestId);
        $data['orden'] = $orden;
        $data['busqueda'] = $request->busqueda;
        $data['isContestFinished'] = $this->isContestFinished($contestId);
        $data['hasWinner'] = $this->hasWinner($contestId);
        return $data;
    }
}
