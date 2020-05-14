<?php


namespace App\Http\Controllers;


use App\Databases\ContestApplicationModel;
use App\Databases\ContestModel;
use App\Databases\Transaction;
use App\Utils\Mailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class WebController extends Controller
{
    public function index()
    {
        $data = $this->getUserData();
        return view('index', $data);
    }

    public function restablecer_clave()
    {
        $data = $this->getUserData();
        return view('restablecer-clave', $data);
    }

    public function ingresar()
    {
        if (Auth::check()) {
            return Redirect::to('panel');
        }
        $data = $this->getUserData();
        return view('ingresar', $data);
    }

    public function reenviar_mail_activacion()
    {
        $data = $this->getUserData();
        $data['title'] = "Reenviar mail activación";
        return view('reenviar-mail-activacion', $data);
    }

    public function terminos()
    {
        $data = $this->getUserData();
        $data['title'] = "Términos y condiciones";
        return view('terminos', $data);
    }

    public function privacidad()
    {
        $data = $this->getUserData();
        $data['title'] = "Privacidad";
        return view('privacidad', $data);
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
        return view('fundacion.fundacion-orsai', $data);
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
        return view('fundacion.historia', $data);
    }

    public function areas()
    {
        $data = $this->getUserData();
        return view('fundacion.areas', $data);
    }

    public function participantes(Request $request)
    {
        $contest = ContestModel::find(1);
        $hasWinner = $this->checkWinner(1);
        if ($contest->end_date < now()) {
            $userInfo = $this->getUserData();
            $cpasInfo = $this->getCpasInfo();
            $data = array_merge($userInfo, $cpasInfo);
            return view("concurso-finalizado", $data);
        }
        if ($this->checkWinner(1) > 0) {
            return Redirect::to('concurso');
        }
        if ($contest->start_date < now() && $contest->end_date >= now()) {
            return $this->show_participantes($request);
        }
        return Redirect::to('concurso-logo');

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

    private function getPropuestas($orden, $limit = 8, $offset = 0, $request = false)
    {

        switch ($orden) {
            case "buscar":
                $propuestas = ContestApplicationModel::where('title', 'LIKE', '%' . $request->busqueda . '%')->where('approved', 1)->with(
                    'logos'
                )->with('owner')->offset($offset)->limit($limit)->get();
                break;
            case "mas-vistos":
                $propuestas = ContestApplicationModel::where('approved', 1)->orderBy('views', 'desc')->with(
                    'logos'
                )->with('owner')->offset($offset)->limit($limit)->get();
                break;
            case "mas-recientes":
                $propuestas = ContestApplicationModel::where('approved', 1)->orderBy('created_at', 'desc')->with(
                    'logos'
                )->with('owner')->offset($offset)->limit($limit)->get();
                break;
            case "mas-votados":
                $propuestas = ContestApplicationModel::where('approved', 1)->orderBy('votes', 'desc')->with(
                    'logos'
                )->with('owner')->offset($offset)->limit($limit)->get();
                break;
            case "random":
            default:
                $propuestas = ContestApplicationModel::where('approved', 1)->inRandomOrder()->with(
                    'logos'
                )->with('owner')->offset($offset)->limit($limit)->get();
                break;
        }
        $data = [];
        foreach ($propuestas as $item) {
            $user = $item->owner()->first();
            if(Auth::check()) {
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
        $userInfo = $this->getUserData();
        $cpasInfo = $this->getCpasInfo();
        $data = array_merge($userInfo, $cpasInfo);
        $orden = $request->route('orden');
        $data['propuestas'] = $this->getPropuestas($orden, 8, 0, $request);
        $data['orden'] = $orden;
        $data['busqueda'] = $request->busqueda;
        return view('participantes', $data);
    }

    public function contacto(Request $request)
    {
        $data = $this->getUserData();

        return view('contacto', $data);
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


}
