<?php


namespace App\Http\Controllers\Contest;

use App\Databases\ContenidoModel;
use App\Databases\ContestApplicationModel;
use App\Databases\ContestModel;
use App\Databases\ContestsModo;
use App\Databases\ContestsType;
use App\Databases\CpaChapterModel;
use App\Databases\CpaLog;
use App\Databases\Transaction;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WebController;
use App\Repositories\FileRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use App\UseCases\ContestApplication\GetContestApplicationById;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use function GuzzleHttp\json_encode;

class ContestController extends Controller
{
    public function index(Request $request)
    {
        $data = array_merge($this->getUserData());
        $cantidadPorPagina = 9;
        $query = ContestModel::where('active', 1)->orderBy('start_date');
        $data['filtro'] = $request->filtro ? $request->filtro : 'activos';
        $data['busqueda'] = $request->busqueda;
        $data['pagina'] = $request->pagina ? $request->pagina : 1;
        if ($request->busqueda != null && $request->busqueda != "") {
            $query->where('name', 'like', "%{$request->busqueda}%");
        }
        switch ($data['filtro']) {
            case 'activos':
                $query->where('start_date', '<=', Carbon::now())->where('end_date', '>', Carbon::now());
                break;
            case 'proximos':
                $query->where('start_date', '>', Carbon::now());
                break;
            case 'finalizados':
                $query->where('end_date', '<', Carbon::now());
                break;
        }
        $data['total'] = $query->count();
        $data['concursos'] = $query->limit($cantidadPorPagina)->offset($cantidadPorPagina * ($data['pagina'] - 1))->get();
        $data['totalPaginas'] = (int)round(ceil($data['total'] / $cantidadPorPagina), 0);
        $data['links'] = $this->generateLinks($data['totalPaginas'], $data['busqueda'], $data['filtro']);
        $data['now'] = Carbon::now();
        return view("concursos.index", $data);
    }

    private function generateLinks($totalPaginas, $busqueda, $filtro)
    {
        $links = array();
        for ($i = 1; $i <= $totalPaginas; $i++) {
            $pagina = $i;
            $filtros = http_build_query(compact('pagina', 'busqueda', 'filtro'));
            $links[$i] = url("concursos?{$filtros}");
        }
        return $links;
    }

    public function show(Request $request)
    {
        $contestId = $request->route('id');
        $userInfo = $this->getUserData();
        $data = array_merge($userInfo);
        $contest = ContestModel::find($contestId);
        if ($contest == null) {
            return Redirect::to(url('no-encontrado'));
        }
        $data['concurso'] = $contest;
        $data['postulaciones_abiertas'] = false;
        $data['logo'] = $contest->logo();
        $data['cantidadPostulaciones'] = $contest->cantidadPostulaciones();
        $data['cantidadFichasEnJuego'] = $contest->cantidadFichasEnJuego();
        $data['bases'] = $contest->getBases();
        $data['ganadores'] = [];
        $data['contest_url'] = "concursos/{$contest->id}/" . urlencode($contest->name);
        $webController = new WebController;
        $data['participantes'] = $webController->getParticipantes($request, $contest->id);
        // CONCURSO POSTULACIONES ABIERTAS
        $data['estado'] = $contest->getStatus();
        $user = Auth::user();
        $data['hasPostulacion'] = ContestModel::hasPostulacion($contest->id, $user->id);
        $data['propuesta'] = false;
        if ($data['hasPostulacion']) {
            $data['propuestaId'] = ContestApplicationModel::select('id')->where('contest_id', $contest->id)->where("user_id", $user->id)->first()->id;
        }
        if ($contest->hasPostulacionesAbiertas()) {
            $data['estado'] = "abierto";
            $data['postulaciones_abiertas'] = true;
        }
        // CONCURSO INICIO DE LAS APUESTAS
        if ($contest->hasVotes()) {
            $data['estado'] = "abierto";
        }
        // CONCURSO FINALIZADO
        if ($contest->hasEnded()) {
            $data['estado'] = "finalizado";
            $data['ganadores'] = ContestApplicationModel::where('is_winner', 1)->where('contest_id', $contest->id)->get();
        }
        return view('concursos.concurso', $data);
    }


    public function show_winner(Request $request)
    {
        $contestId = $request->contest_id;
        $userInfo = $this->getUserData();
        $data = array_merge($userInfo);
        $propuesta = ContestApplicationModel::where("is_winner", 1)->where('contest_id', $contestId)->with(['logos', 'owner'])->first();
        $logo = $propuesta->logos()->first();
        $avatar = $propuesta->owner()->first()->avatar()->first();
        $data['logo'] = url('storage/logo/' . $logo->name . "." . $logo->extension);
        if ($avatar != null) {
            $data['avatar'] = url('storage/images/' . $avatar->name . "." . $avatar->extension);
        } else {
            $data['avatar'] = url('img/participantes/usuario.png');
        }
        $user = $propuesta->owner()->first();
        $data['propuestaID'] = $propuesta->id;
        $data['userName'] = $user->userName;
        $data['votes'] = $propuesta->votes;
        $data['name'] = $user->name;
        $data['lastName'] = $user->lastName;
        $data['country'] = $user->country;
        $data['facebook'] = $user->facebook;
        $data['instagram'] = $user->instagram;
        $data['txs'] = Transaction::where('cap_id', $propuesta->id)->inRandomOrder()->take(10)->get();
        $data['totalesPresentados'] = ContestApplicationModel::whereNotNull('approved_in')->count();
        $data['totalSociosApostadores'] = $this->getTotalSociosApostadores($propuesta->id);
        $data['totalDeFichasEnJuego'] = (new TransactionRepository(new UserRepository()))->getTotalSupply($contestId);
        return view("logo-ganador", $data);
    }

    private function getTotalSociosApostadores()
    {
        $txs = Transaction::where('type', 'TRANSFER')->where('from', '>', 1)->groupBy('from')->get();
        return count($txs);
    }

    public function approve(Request $request)
    {
        $user = Auth::user();
        if ($user->role == "admin") {
            $contest = ContestModel::find($request->id);
            if ($contest->active == 1) {
                $contest->active = 0;
            } else {
                $contest->active = 1;
            }
            $contest->save();
            return response()->json(["status" => "ok", "message" => "Concurso aprobado"]);
        }
        return response()->json(["status" => "ok", "message" => "Concurso aprobado"], 422);
    }

    public function create(Request $request)
    {
        $contest = false;
        $types = ContestsType::all();
        $modes = ContestsModo::all();
        $now = Carbon::now();
        $imageUrl = "";
        $per_winner = array_fill(0, 4, 0);
        return view('admin.concursos.contest-form', compact('contest', 'modes', 'now', 'imageUrl', 'types', 'per_winner'));
    }

    private function validCantCaracteres($type, $cant_caracteres)
    {
        if (($type == 1 || $type == 2) && $cant_caracteres > 0) {
            return true;
        }
        if ($type == 3) {
            return true;
        }
        return false;
    }

    private function validCantMaxChapters($type, $cant_capitulos)
    {
        if ($type == 1 || $type == 3) {
            return true;
        }
        if ($type == 2 && $cant_capitulos > 0) {
            return true;
        }
        return false;
    }

    private function validPrizeAmount($mode, $per_winner)
    {
        if ($mode == 1 && !in_array(0, $per_winner)) {
            return true;
        }
        if ($mode > 1) {
            return true;
        }
        return false;
    }

    private function validRequiredAmount($mode, $required_amount)
    {
        if ($mode == 1) {
            return true;
        }
        if ($required_amount > 0) {
            return true;
        }
        return false;
    }

    private function validAmountUsd($mode, $amount_usd)
    {
        if ($mode == 1) {
            return true;
        }
        if ($amount_usd > 0) {
            return true;
        }
        return false;
    }

    private function validAmountWinner($mode, $amount_winner)
    {
        if ($mode == 1 || $mode == 2) {
            return true;
        }
        if ($mode == 2 && $amount_winner > 0) {
            return true;
        }
        return false;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "bajada_corta" => "required|max:168",
            "bajada_completa" => "required",
            "start_date" => "required|date",
            "end_date" => "required|date|after:start_date",
            "start_app_date" => "required",
            "end_app_date" => "required",
            "start_vote_date" => "required",
            "end_vote_date" => "required",
            "type" => "required",
            "mode" => "required",
            "images" => "required|array|min:1"
        ]);

//        $validator->after(function ($validator) use ($request) {
//            if (!$this->validCantCaracteres($request->type, $request->cant_caracteres)) {
//                $validator->errors()->add('cant_caracteres', 'La cantidad de caracteres es de 1 a 240');
//            }
//            if (!$this->validCantMaxChapters($request->type, $request->cant_capitulos)) {
//                $validator->errors()->add('cant_capitulos', 'La cantidad de capítulos no puede ser 0');
//            }
//            if (!$this->validPrizeAmount($request->mode, $request->per_winner)) {
//                $validator->errors()->add('per_winner', 'Los premios deben ser mayor a 0');
//            }
//            if (!$this->validRequiredAmount($request->mode, $request->required_amount)) {
//                $validator->errors()->add('required_amount', 'La cantidad de fichas necesarias debe ser mayor a 0');
//            }
//            if (!$this->validAmountWinner($request->mode, $request->amount_winner)) {
//                $validator->errors()->add('amount_winner', 'La cantidad debe ser mayor a 0');
//            }
//            if (!$this->validAmountUsd($request->mode, $request->amount_usd)) {
//                $validator->errors()->add('amount_usd', 'La cantidad debe ser mayor a 0');
//            }
//        });

        if ($validator->fails()) {
            return redirect('admin/concursos/crear')
                ->withErrors($validator)
                ->withInput();
        }
        $fileRepo = new FileRepository();
        $images = $fileRepo->getUploadedFiles('images', $request);
        $cant_winners = 0;
        if ($request->mode == 1) {
            $cant_winners = $request->cant_winners ? $request->cant_winners : 0;
        }

        $data = [
            "name" => $request->name,
            "bajada_corta" => $request->bajada_corta,
            "bajada_completa" => $request->bajada_completa,
            "start_date" => Carbon::parse($request->start_date)->format('Y-m-d H:i:s'),
            "end_date" => Carbon::parse($request->end_date)->format('Y-m-d H:i:s'),
            "start_app_date" => Carbon::parse($request->start_app_date)->format('Y-m-d H:i:s'),
            "end_app_date" => Carbon::parse($request->end_app_date)->format('Y-m-d H:i:s'),
            "start_vote_date" => Carbon::parse($request->start_vote_date)->format('Y-m-d H:i:s'),
            "end_vote_date" => Carbon::parse($request->end_vote_date)->format('Y-m-d H:i:s'),
            "image" => count($images) > 0 ? $images[0]->getId() : 0,
            "type" => $request->type,
            "mode" => $request->mode,
            "amount_winner" => $request->amount_winner ? $request->amount_winner : 0,
            "cant_winners" => $cant_winners,
            "per_winner" => $this->cleanPerWinnerArray($cant_winners, $request->per_winner),
            "amount_usd" => $request->amount_usd ? $request->amount_usd : 0,
            "required_amount" => $request->required_amount ? $request->required_amount : 0,
            "cant_caracteres" => $request->cant_caracteres ? $request->cant_caracteres : 0,
            "cant_capitulos" => $request->cant_capitulos ? $request->cant_capitulos : 0,
            "active" => $request->active,
            'user_id' => Auth::user()->id
        ];
        $contest = new ContestModel($data);
        $contest->save();
        if ($request->editar_pagina == 1) {
            $bases = ContenidoModel::where("contest_id", $contest->id)->first();
            return Redirect::to('admin/contenidos/' . $bases->id . '?concurso=' . $contest->id);
        }
        if ($request->crear_pagina == 1) {
            return Redirect::to('admin/contenidos/crear/pagina?concurso=' . $contest->id);
        }

        return Redirect::to('admin/concursos');
    }


    private function cleanPerWinnerArray($cant_winners, $per_winner)
    {
        $array = array_splice($per_winner, 0, $cant_winners);
        return json_encode(array_pad($array, 4, "0"));
    }


    public function edit(Request $request)
    {
        $id = $request->route('id');
        $contest = ContestModel::find($id);
        $types = ContestsType::all();
        $modes = ContestsModo::all();
        $now = Carbon::now();
        $imageUrl = "";
        $imageKey = "";
        $per_winner = json_decode($contest->per_winner);
        if ($contest->image) {
            $image = $contest->logo();
            $imageKey = $image->id;
            $imageUrl = url('storage/images/' . $image->name . "." . $image->extension);
        }
        return view('admin.concursos.contest-form', compact('contest', 'types', 'modes', 'now', 'imageUrl', 'per_winner', 'imageKey'));
    }


    public function deleteImage(Request $request)
    {
        $imageId = $request->key;
        $contest = ContestModel::where('image', $imageId)->first();
        $contest->image = null;
        $contest->save();
        echo json_encode(["message" => $imageId]);
    }


    public function update(Request $request)
    {
        $request->validate([
            "name" => "required",
            "bajada_corta" => "required",
            "bajada_completa" => "required",
            "start_date" => "required|date",
            "end_date" => "required|date|after:start_date",
            "start_app_date" => "required",
            "end_app_date" => "required",
            "start_vote_date" => "required",
            "end_vote_date" => "required",
            "type" => "required",
            "mode" => "required",
        ]);

        $id = $request->id;
        $contest = ContestModel::find($id);
        $fileRepo = new FileRepository();
        $images = $fileRepo->getUploadedFiles('images', $request);
        $logo = $this->processLogo($images, $contest);
        $cant_winners = 0;
        if ($request->mode == 1) {
            $cant_winners = $request->cant_winners ? $request->cant_winners : 0;
        }
        $data = [
            "name" => $request->name,
            "bajada_corta" => $request->bajada_corta,
            "bajada_completa" => $request->bajada_completa,
            "start_date" => Carbon::parse($request->start_date)->format('Y-m-d H:i:s'),
            "end_date" => Carbon::parse($request->end_date)->format('Y-m-d H:i:s'),
            "start_app_date" => Carbon::parse($request->start_app_date)->format('Y-m-d H:i:s'),
            "end_app_date" => Carbon::parse($request->end_app_date)->format('Y-m-d H:i:s'),
            "start_vote_date" => Carbon::parse($request->start_vote_date)->format('Y-m-d H:i:s'),
            "end_vote_date" => Carbon::parse($request->end_vote_date)->format('Y-m-d H:i:s'),
            "image" => $logo,
            "type" => $request->type,
            "mode" => $request->mode,
            "cant_winners" => $cant_winners,
            "per_winner" => $this->cleanPerWinnerArray($cant_winners, $request->per_winner),
            "amount_winner" => $request->amount_winner ? $request->amount_winner : 0,
            "amount_usd" => $request->amount_usd ? $request->amount_usd : 0,
            "required_amount" => $request->required_amount ? $request->required_amount : 0,
            "cant_capitulos" => $request->cant_capitulos ? $request->cant_capitulos : 0,
            "cant_caracteres" => $request->cant_caracteres ? $request->cant_caracteres : 0,
            "active" => $request->active,
            'user_id' => Auth::user()->id
        ];
        $contest->fill($data);
        $contest->save();
        if ($request->editar_pagina == 1) {
            $bases = ContenidoModel::where("contest_id", $contest->id)->first();
            return Redirect::to('admin/contenidos/' . $bases->id . '?concurso=' . $contest->id);
        }
        if ($request->crear_pagina == 1) {
            return Redirect::to('admin/contenidos/crear/pagina?concurso=' . $contest->id);
        }
        return Redirect::to('admin/concursos');
    }

    private function processLogo($images, $contest)
    {
        if (count($images) > 0) {
            return $images[0]->getId();
        }
        if ($contest->image != 0) {
            return $contest->image;
        }
        return 0;
    }

    public function deleteAll(Request $request)
    {
        $id = $request->id;
        $contest = ContestModel::find($id);
        if ($contest) {
            $cpas = ContestApplicationModel::where("contest_id", $contest->id)->get();
            foreach ($cpas as $cpa) {
                CpaLog::where("cap_id", $cpa->id)->delete();
                CpaChapterModel::where("cap_id", $cpa->id)->delete();
            }
            ContestApplicationModel::where("contest_id", $contest->id)->delete();
            ContestModel::where("id", $contest->id)->delete();
            return response()->json(["status" => "success", "msg" => "Concurso borrado"]);
        }
        return response()->json(["status" => "error", "message" => "Concurso no encontrado"], 400);
    }
}
