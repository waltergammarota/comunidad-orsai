<?php


namespace App\Http\Controllers;


use App\Databases\ContestApplicationModel;
use App\Databases\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    public function index()
    {
        $data = $this->getUserData();
        return view('index', $data);
    }

    public function concurso_logo()
    {
        $data = $this->getUserData();
        return view('concurso-logo', $data);
    }

    public function fundacion()
    {
        $data = $this->getUserData();
        return view('fundacion-orsai', $data);
    }

    public function donar()
    {
        $data = $this->getUserData();
        return view('donar', $data);
    }

    public function participantes(Request $request)
    {
        $userInfo = $this->getUserData();
        $cpasInfo = $this->getCpasInfo();
        $data = array_merge($userInfo, $cpasInfo);
        $orden = $request->route('orden');
        $data['propuestas'] = $this->getPropuestas($orden, 8,0, $request);
        $data['orden'] = $orden;
        $data['busqueda'] = $request->busqueda;
        return view('participantes', $data);
    }

    public function getMore(Request $request) {
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
                $propuestas = ContestApplicationModel::where('title','LIKE','%'.$request->busqueda.'%')->where('approved', 1)->with(
                    'logos'
                )->with('owner')->offset($offset)->limit($limit)->get();
                break;
            case "mas-vistos":
                $propuestas = ContestApplicationModel::where('approved', 1)->orderBy('views','desc')->with(
                    'logos'
                )->with('owner')->offset($offset)->limit($limit)->get();
                break;
            case "mas-recientes":
                $propuestas = ContestApplicationModel::where('approved', 1)->orderBy('created_at','desc')->with(
                    'logos'
                )->with('owner')->offset($offset)->limit($limit)->get();
                break;
            case "mas-votados":
                $propuestas = ContestApplicationModel::where('approved', 1)->orderBy('votes','desc')->with(
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
            $voted = Transaction::where(
                ["from" => Auth::user()->id, "cap_id" => $item->id]
            )->count();
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


}
