<?php


namespace App\Http\Controllers\Contest;

use App\Databases\ContenidoModel;
use App\Databases\ContestApplicationModel;
use App\Databases\ContestModel;
use App\Databases\ContestsModo;
use App\Databases\ContestsType;
use App\Databases\CpaChapterModel;
use App\Databases\CpaLog;
use App\Databases\FormModel;
use App\Databases\RondaModel;
use App\Databases\RondaInputModel;
use App\Databases\Transaction;
use App\Databases\VotesModel;
use App\Databases\CotizacionModel;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WebController;
use App\Repositories\FileRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Databases\NotificacionModel;

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
        $data['modo'] = $request->modo;
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
        switch ($data['modo']) {
            case 'pozo':
                $query->where('mode', 1);
                break;
            case 'completo':
                $query->where('mode', 2);
                break;
            case 'fijo':
                $query->where('mode', 3);
                break;
        }
        $data['total'] = $query->count();
        $data['concursos'] = $query->limit($cantidadPorPagina)->offset($cantidadPorPagina * ($data['pagina'] - 1))->get();
        $data['totalPaginas'] = (int)round(ceil($data['total'] / $cantidadPorPagina), 0);
        $data['links'] = $this->generateLinks($data['totalPaginas'], $data['busqueda'], $data['filtro']);
        $data['now'] = Carbon::now();
        $isOnnlyCards = $request->onlyCards;
        if ($isOnnlyCards) {
            return view('concursos.only-cards', $data);
        }
        // TODO REMOVER CUANDO SE PUBLIQUE EL SEGUNDO
        if ($data['total'] == 1) {
            $firstContest = $data['concursos'][0];
            return Redirect::to('concursos/' . $firstContest->id . '/' . $firstContest->getUrlName());
        }
        return view("concursos.concursos-nuevos", $data);
    }

    private function generateLinks($totalPaginas, $busqueda, $filtro)
    {
        $links = array();
        for ($i = 1; $i <= $totalPaginas; $i++) {
            $pagina = $i;
            $filtros = http_build_query(compact('pagina', 'busqueda', 'filtro'));
            $links[$i] = url("concursos?{$filtros}&onlyCards=true");
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
        $data['diferencia'] = $contest->end_app_date;
        $data['postulaciones_abiertas'] = false;
        $data['logo'] = $contest->logo();
        $data['cantidadPostulacionesAprobadas'] = $this->convertToK($contest->cantidadPostulaciones());
        $data['cantidadFichasEnJuego'] = $this->convertToK($contest->cantidadFichasEnJuego());
        $data['queryParams'] = count($request->query()) ? '?' . http_build_query($request->query()) : '';
        $cotizacion = CotizacionModel::getCurrentCotizacion();
        $data['cantidadDineroEnJuego'] = number_format(($this->convertToK($contest->cantidadFichasEnJuego()) * $contest->token_value * $cotizacion->precio), 2, ',', '.');
        $data['cuentosPostulados'] = $this->convertToK($contest->cantidadPostulacionesEnTotal());
        $data['cuentistasInscriptos'] = $this->convertToK($contest->cantidadCuentistasInscriptos());
        $data['usuariosqueVotaron'] = $this->convertToK($contest->cantidadUsuariosqueVotaron());
        $data['bases'] = $contest->getBases();
        $data['ganadores'] = [];
        $data['contest_url'] = "concursos/{$contest->id}/" . urlencode($contest->getUrlName());
        $webController = new WebController;
        $data['participantes'] = $webController->getParticipantes($request, $contest->id);
        // CONCURSO POSTULACIONES ABIERTAS
        $data['estado'] = $contest->getStatus();
        $user = Auth::user();
        $data['hasPostulacion'] = false;
        if ($user) {
            $data['hasPostulacion'] = ContestModel::hasPostulacion($contest->id, $user->id);
        }
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
            return Redirect::to("concursos/{$contest->id}/{$contest->getUrlName()}/ronda/1");
        }
        // CONCURSO FINALIZADO
        if ($contest->hasEnded()) {
            return Redirect::to('estadisticas/{$contest->id}/{$contest->getUrlName()}');
        }
        return view('concursos.inscripcion', $data);
    }

    public function show_ronda(Request $request)
    {
        $data = $this->getUserData();
        $contestId = $request->route('contestId');
        $rondaId = $request->route('rondaId');
        $contest = ContestModel::find($contestId);
        $currentRonda = $contest->getRondaByOrder($rondaId);
        // NO EXISTE EL CONCURSO
        if (!$contest || !$currentRonda) {
            abort(404);
        }
        // EL CONCURSO NO PERMITE VOTAR TODAVIA
        if (!$contest->hasVotes()) {
            $contestRoute = "/concursos/{$contest->id}/{$contest->getUrlName()}";
            return Redirect::to($contestRoute);
        }

        if ($contest->hasWinner()) {
            return Redirect::to('estadisticas/' . $contest->id . '/' . $contest->getUrlName());
        }

        $view = "concursos/ronda_1";
        if ($currentRonda->order > 2) {
            $view = "concursos/ronda_{$currentRonda->order}";
        }
        $concurso = $contest;
        $logo = $contest->logo();
        $cierreDiff = Carbon::now()->diffInHours($contest->end_vote_date) . ':' . Carbon::now()->diff($contest->end_vote_date)->format('%I:%S');
        $cantidadFichasEnJuego = $this->convertToK($contest->cantidadFichasEnJuego());
        $cotizacion = CotizacionModel::getCurrentCotizacion();
        $data['cantidadDineroEnJuego'] = number_format(($this->convertToK($contest->cantidadFichasEnJuego()) * $contest->token_value * $cotizacion->precio), 2, ',', '.');
        $modo = $contest->getMode()->name;
        $cantidadPostulacionesAprobadas = $this->convertToK($contest->cantidadPostulaciones());
        $cuentistasInscriptos = $this->convertToK($contest->cantidadCuentistasInscriptos());
        $usuariosqueVotaron = $this->convertToK($contest->cantidadUsuariosqueVotaron());
        $user = Auth::User();

        $isJuradoVip = $user->getVotesInContest($contest->pool_id) >= $contest->cost_jury;
        $categories = $contest->form()->first()->getCategories();
        $rondas = VotesModel::getRondasWithVotes($contest, $user->id);
        $counterRondas = VotesModel::getRondasCounter($contest->id, $user->id);
        $filters = $this->getFilters($request);
        $id = $request->query('id');
        $cpas = ContestApplicationModel::getApplications($contest, $rondas, $user->id, $currentRonda, $filters, $id);
        $toBeJury = $contest->cost_jury - $user->getVotesInContest($contest->pool_id);
        $data = $this->compactData($concurso, $data, $logo, $cierreDiff, $cantidadFichasEnJuego, $modo, $cantidadPostulacionesAprobadas, $cuentistasInscriptos, $isJuradoVip, $categories, $cpas, $rondas, $currentRonda, $toBeJury, $counterRondas, $usuariosqueVotaron);
        $data['diferencia'] = $contest->end_vote_date;
        $data['baseUrl'] = url("concursos/{$contest->id}/{$contest->getUrlName()}/ronda/{$currentRonda->order}");
        $data[''] = count($request->query()) ? '?' . http_build_query($request->query()) : '';
        $data['categoriasSeleccionadas'] = $this->getCategoriasSeleccionadas($request, $filters, $contest);
        $data['user'] = $user;
        $data['hasWinner'] = $contest->hasWinner();

        return view($view, $data);
    }

    private function getCategoriasSeleccionadas($request, $filters, $contest)
    {
        $hasFilters = count($request->query());
        if ($hasFilters) {
            $resultFilters = [];
            if (array_key_exists('etiquetas', $filters)) {
                $etiquetas = explode(';', $filters['etiquetas']);
                for ($i = 0; $i < count($etiquetas); $i++) {
                    $resultFilters[] = $etiquetas[$i];
                }
            }
            if (array_key_exists('busqueda', $filters)) {
                $resultFilters[] = $filters['busqueda'];
            }
            if (array_key_exists('destrabados', $filters)) {
                $resultFilters[] = 'Ver Destrabados';
            }
            if (array_key_exists('id', $filters)) {
                $order = ContestApplicationModel::getAnswersById($contest, $filters['id']);

                $resultFilters[] = $order;
            }

            return $resultFilters;
        }

        return '';
    }

    private function getFilters(Request $request)
    {
        $params = $request->all();
        $filters = [];
        if (array_key_exists('busqueda', $params) && $params['busqueda'] != '') {
            $filters['busqueda'] = $params['busqueda'];
        }
        if (array_key_exists('destrabados', $params) && $params['destrabados'] != "false") {
            $filters['destrabados'] = $params['destrabados'];
        }

        if (array_key_exists('id', $params) && $params['id'] != '') {
            $filters['id'] = $params['id'];
        }

        return $filters;
    }


    public function show_cuento(Request $request)
    {
        $data = $this->getUserData();
        $storyId = $request->route('storyId');
        $cpa = ContestApplicationModel::find($storyId);
        $lastRound = 3;
        if (!$cpa) {
            abort(404);
        }
        $user = Auth::user();
        $userHasVoted = VotesModel::hasEnoughVotes($storyId, $user->id);
        if (!$userHasVoted) {
            $contest = ContestModel::find($cpa->contest_id);
            return Redirect::to("concursos/{$contest->id}/{$contest->getUrlName()}");
        }
        // SUMAMOS UNA VISTA

        $this->addOneViewMore($cpa);
        $contest = ContestModel::find($cpa->contest_id);
        $rondas = VotesModel::getRondasWithVotes($contest, $user->id);
        $currentRonda = $contest->getRondaByOrder($lastRound);
        $cpa = ContestApplicationModel::getApplications($contest, $rondas, $user->id, $currentRonda, [], $storyId)[0];
        $data['cpa'] = $cpa;
        $data['currentRonda'] = $currentRonda;
        $data['rondas'] = $rondas;
        $data['author'] = $cpa->owner()->first();
        $avatar = $data['author']->avatar()->first();
        if ($avatar != null) {
            $data['avatar'] = url('storage/images/' . $avatar->name . "." . $avatar->extension);
        } else {
            $data['avatar'] = url('img/participantes/usuario.png');
        }
        $data['txs'] = $cpa->getTransactions();
        $data['fichasApostadas'] = VotesModel::getVotesCount($contest->id, $user->id, $currentRonda->order, $cpa->id);
        $data['baseUrl'] = url("concursos/{$contest->id}/{$contest->getUrlName()}/ronda/{$currentRonda->order}");
        $data['backUrl'] = url("concursos/{$contest->id}/{$contest->getUrlName()}/ronda/{$lastRound}");
        $data['isJuradoVip'] = $user->getVotesInContest($contest->pool_id) >= $contest->cost_jury;

        return view('concursos.cuento_completo', $data);
    }

    private function convertToK($amount)
    {
        if ($amount > 1000) {
            $amount = $amount / 1000;

            return "{$amount}K";
        }

        return $amount;
    }

    public function show_winner(Request $request)
    {
        $contestId = $request->contestId;
        $contest = ContestModel::find($contestId);
        $data = $this->getUserData();
        $cpa = ContestApplicationModel::where("is_winner", 1)->where('contest_id', $contestId)->with(['logos', 'owner', 'answers'])->orderBy('prize_percentage', 'desc')->first();
        $data['hasWinner'] = false;
        $data['logo'] = $contest->logo();
        if ($cpa) {
            $data['hasWinner'] = true;
            $logo = $cpa->logos()->first();
            $avatar = $cpa->owner()->first()->avatar()->first();
            if ($avatar != null) {
                $data['avatar'] = url('storage/images/' . $avatar->name . "." . $avatar->extension);
            } else {
                $data['avatar'] = url('img/participantes/usuario.png');
            }
            $user = $cpa->owner;
            $data['propuestaID'] = $cpa->id;
            $data['userName'] = $user->userName;
            $data['votes'] = $cpa->votes;
            $data['name'] = $user->name;
            $data['lastName'] = $user->lastName;
            $data['country'] = $user->country;
            $data['facebook'] = $user->facebook;
            $data['instagram'] = $user->instagram;
            $data['contest'] = $contest;
            $data['concurso'] = $contest;
            $data['rondas'] = VotesModel::getRondasWithVotes($contest, $user->id);
            $lastRound = 3;
            $data['currentRonda'] = $contest->getRondaByOrder($lastRound);
            $cpa = ContestApplicationModel::getApplications($contest, $data['rondas'], $user->id, $data['currentRonda'], [], $cpa->id)[0];
            $data['cpa'] = $cpa;
            $data['txs'] = Transaction::where('cap_id', $cpa->id)->inRandomOrder()->take(10)->get();
        }
        $data['cantidadPostulacionesAprobadas'] = $this->convertToK($contest->cantidadPostulaciones());
        $data['cantidadFichasEnJuego'] = $this->convertToK($contest->cantidadFichasEnJuego());
        $data['cuentosPostulados'] = $this->convertToK($contest->cantidadPostulacionesEnTotal());
        $data['cuentistasInscriptos'] = $this->convertToK($contest->cantidadCuentistasInscriptos());
        $cotizacion = CotizacionModel::getCurrentCotizacion();
        $data['cantidadDineroEnJuego'] = number_format(($this->convertToK($contest->cantidadFichasEnJuego()) * $contest->token_value * $cotizacion->precio), 2, ',', '.');
        $data['usuariosqueVotaron'] = $this->convertToK($contest->cantidadUsuariosqueVotaron());
        $data['isJuradoVip'] = $user->getVotesInContest($contest->pool_id) >= $contest->cost_jury;
        $data['categories'] = $contest->form()->first()->getCategories();
        $data['counterRondas'] = VotesModel::getRondasCounter($contest->id, $user->id);
        $data['queryParams'] = count($request->query()) ? '?' . http_build_query($request->query()) : '';
        $filters = $this->getFilters($request);
        $data['categoriasSeleccionadas'] = $this->getCategoriasSeleccionadas($request, $filters, $contest);
        $data['filters'] = $this->getCountFilters($request);
        $data['hideFilterBar'] = true;
        $data['ranking'] = $contest->getRanking();
        $apostadores = collect($contest->getApostadores());
        $votantes = rtrim($apostadores->reduce(function ($prev, $current) {
            return $prev . $current->votantes . ',';
        }), ',');

        $votantesUsers = User::whereIn('id', explode(',', $votantes))->with('avatar')->get();
        $data['getAvatar'] = function ($userId) use ($votantesUsers) {
            $user = $votantesUsers->firstWhere('id', $userId);
            if ($user && $user->avatar) {
                return $user->getAvatarLink();
            }
            return 'http://orsai.test/estilos/front2021/assets/participantes/participante.jpg';
        };

        $data['avatares'] = function ($capId) use ($apostadores) {
            return array_slice(explode(',', $apostadores->firstWhere('cap_id', $capId)->votantes), 0, 3);
        };
        $data['apostadores'] = function ($capId) use ($apostadores) {
            return $apostadores->firstWhere('cap_id', $capId)->apostadores;
        };

        $data['hasWinner'] = $contest->hasWinner();
        $data['modo'] = $contest->getMode()->name;
        $data['page'] = $contest->getPaginaGanador();
        // SI HERNAN ESCRIBIÓ ALGO PARA EL GANADOR ENTONCES REDIRIGIMOS A LA PAGINA DE GANADOR CON HTML
        if ($contest->hasWinner() && $data['page'] && $request->ganador != "ganador" && !$request->get('force')) {
            return Redirect::to('concursos/' . $contest->id . '/' . $contest->getUrlName() . '/ganador');
        }
        $data['rankingPage'] = true;
        // ESTAMOS EN LA PAGINA GANADOR CON HTML
        if ($request->ganador == "ganador") {
            $data['diferencia'] = $contest->end_date;
            $data['bases'] = $contest->getBases();
            return view('concursos.ganador', $data);
        }
        // SACAMOS LA URL DE ESTADISTICAS CUANDO ESTÁS PARADO AHÍ

        return view("concursos.ranking", $data);
    }

    private function getCountFilters(Request $request)
    {
        $params = $request->all();
        $count = 0;
        if (array_key_exists('busqueda', $params) && $params['busqueda'] != '') {
            $count++;
        }
        if (array_key_exists('etiquetas', $params) && $params['etiquetas'] != '') {
            $etiquetas = explode(';', $params['etiquetas']);
            for ($i = 0; $i < count($etiquetas); $i++) {
                $count++;
            }
        }
        if (array_key_exists('destrabados', $params) && $params['destrabados'] != "false") {
            $count++;
        }
        if (array_key_exists('id', $params) && $params['id'] != "false") {
            $count++;
        }

        return $count;
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
                $this->sendNotification($request->id);
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
        $rondas = [];

        for ($i = 0; $i < 3; $i++) {
            $ronda = new \stdClass();
            $ronda->solapa = '';
            $ronda->id = 0;
            $ronda->contest_id = 0;
            $ronda->cost = 0;
            $ronda->title = '';
            $ronda->bajada = '';
            $ronda->body = '';
            $rondas[] = $ronda;
        }

        $forms = FormModel::all();
        return view('admin.concursos.contest-form', compact('contest', 'modes', 'now', 'imageUrl', 'types', 'per_winner', 'rondas', 'forms'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "bajada_corta" => "required | max:168",
            "bajada_completa" => "required",
            "start_date" => "required | date",
            "end_date" => "required | date | after:start_date",
            "start_app_date" => "required",
            "end_app_date" => "required",
            "start_vote_date" => "required",
            "end_vote_date" => "required",
            "type" => "required",
            "mode" => "required",
            "token_value" => "required"
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
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
            'user_id' => Auth::user()->id,
            'cost_per_cpa' => $request->cost_per_cpa ? $request->cost_per_cpa : 0,
            'cost_jury' => $request->cost_jury ? $request->cost_jury : 0,
            'vote_limit' => $request->vote_limit ? $request->vote_limit : 0,
            'form_id' => $request->form_id,
            'token_value' => $request->token_value,
            'auto_approval' => $request->auto_approval ? $request->auto_approval : 0
        ];
        $contest = new ContestModel($data);
        $contest->save();

        if ($request->active == 1) {
            $this->sendNotification($contest->id);
        }

        $this->generateContestPool($contest);
        $contest->rondas()->delete();

        if ($contest->type == 1) {
            foreach ($request->title as $key => $value) {
                $inputs = $request->inputs[$key] ?? [];
                $ronda = new RondaModel();
                $ronda->contest_id = $contest->id;
                $ronda->solapa = $request->solapa[$key] ?? '';
                $ronda->cost = $request->cost[$key] ?? 0;
                $ronda->title = $request->title[$key] ?? '';
                $ronda->bajada = $request->bajada[$key] ?? '';
                $ronda->body = $request->body[$key] ?? '';
                $ronda->order = $key + 1;
                $ronda->save();

                foreach ($inputs as $value) {
                    $form = new RondaInputModel();
                    $form->ronda_id = $ronda->id;
                    $form->input_id = $value;
                    $form->save();
                }
            }
        }


        if ($request->editar_pagina == 1) {
            $bases = ContenidoModel::where("contest_id", $contest->id)->first();
            return Redirect::to('admin/contenidos/' . $bases->id . '?concurso=' . $contest->id);
        }
        if ($request->crear_pagina == 1) {
            return Redirect::to('admin/contenidos/crear/pagina?concurso=' . $contest->id);
        }

        return Redirect::to('admin/concursos');
    }

    private function generateContestPool($contest)
    {
        $uniqid = uniqid();
        $user = new User([
            "name" => $contest->name,
            "lastName" => "",
            "passport" => 0,
            "userName" => $contest->name,
            "country" => "Argentina",
            "provincia" => null,
            "city" => null,
            "birth_date" => Carbon::now(),
            "birth_country" => "Argentina",
            "email" => "concurso+{$contest->id}@gmail.com",
            "email_verified_at" => null,
            "password" => uniqid(),
            "role" => "user",
        ]);
        $user->save();
        $contest->pool_id = $user->id;
        $contest->save();
        return $user;
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
        $rondas = $contest->rondas()->get();
        $inputs = $contest->inputs()->get();

        $count = 3 - $rondas->count();

        if ($count > 0) {
            for ($i = 0; $i < $count; $i++) {
                $ronda = new \stdClass();
                $ronda->id = 0;
                $ronda->contest_id = $id;
                $ronda->cost = 0;
                $ronda->title = '';
                $ronda->bajada = '';
                $ronda->body = '';

                $rondas[] = $ronda;
            }
        }

        foreach ($rondas as $ronda) {
            $ronda->inputs = $contest->getRondaInputs($ronda->id);
        }

        $types = ContestsType::all();
        $modes = ContestsModo::all();
        $now = Carbon::now();
        $imageUrl = "";
        $imageKey = "";
        $per_winner = json_decode($contest->per_winner);
        $forms = FormModel::all();
        if ($contest->image) {
            $image = $contest->logo();
            $imageKey = $image->id;
            $imageUrl = url('storage/images/' . $image->name . " . " . $image->extension);
        }

        return view('admin.concursos.contest-form', compact('contest', 'types', 'modes', 'now', 'imageUrl', 'per_winner', 'imageKey', 'rondas', 'forms'));
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
            "start_date" => "required | date",
            "end_date" => "required | date | after:start_date",
            "start_app_date" => "required",
            "end_app_date" => "required",
            "start_vote_date" => "required",
            "end_vote_date" => "required",
            "type" => "required",
            "mode" => "required",
            "token_value" => "required"
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
            'user_id' => Auth::user()->id,
            'cost_per_cpa' => $request->cost_per_cpa ? $request->cost_per_cpa : 0,
            'cost_jury' => $request->cost_jury,
            'vote_limit' => $request->vote_limit,
            'form_id' => $request->form_id,
            'token_value' => $request->token_value,
            'auto_approval' => $request->auto_approval ? $request->auto_approval : 0
        ];
        $contest->fill($data);
        $contest->save();
        if ($contest->pool_id == 0) {
            $this->generateContestPool($contest);
        }

        /* Inserta Rondas y RondasInputs */
        // $contest->rondas()->delete();
        $contest->inputs()->delete();

        if ($contest->type == 1) {
            foreach ($request->title as $key => $value) {
                $ronda_id = $request->ronda_id[$key];
                $inputs = $request->inputs[$key] ?? [];

                if ($ronda_id == 0) {
                    $ronda = new RondaModel();
                    $ronda->contest_id = $contest->id;
                } else {
                    $ronda = RondaModel::find($ronda_id);
                }

                $ronda->solapa = $request->solapa[$key] ?? '';
                $ronda->cost = $request->cost[$key] ?? 0;
                $ronda->title = $request->title[$key] ?? '';
                $ronda->bajada = $request->bajada[$key] ?? '';
                $ronda->body = $request->body[$key] ?? '';
                $ronda->order = $key + 1;
                $ronda->save();

                foreach ($inputs as $value) {
                    $form = new RondaInputModel();
                    $form->ronda_id = $ronda->id;
                    $form->input_id = $value;
                    $form->save();
                }
            }
        } else {
            $contest->rondas()->delete();
        }


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


    public function inputs(Request $request)
    {
        $id = $request->route('id');
        $form = FormModel::find($id);
        $data = $form->inputs()->select('id', 'name', 'title')->get();

        return response()->json($data);
    }

    /**
     * @param $cpa
     */
    private function addOneViewMore($cpa)
    {
        $cpa->views = $cpa->views + 1;
        $cpa->save();
    }

    private function compactData($concurso, array $data, $logo, string $cierreDiff, string $cantidadFichasEnJuego, $modo, string $cantidadPostulacionesAprobadas, string $cuentistasInscriptos, bool $isJuradoVip, $categories, $cpas, $rondas, $currentRonda, $toBeJury, $counterRondas, $usuariosqueVotaron): array
    {
        $data['concurso'] = $concurso;
        $data['logo'] = $logo;
        $data['cierreDiff'] = $cierreDiff;
        $data['cantidadFichasEnJuego'] = $cantidadFichasEnJuego;
        $data['modo'] = $modo;
        $data['cantidadPostulacionesAprobadas'] = $cantidadPostulacionesAprobadas;
        $data['cuentistasInscriptos'] = $cuentistasInscriptos;
        $data['isJuradoVip'] = $isJuradoVip;
        $data['categories'] = $categories;
        $data['cpas'] = $cpas;
        $data['rondas'] = $rondas;
        $data['currentRonda'] = $currentRonda;
        $data['toBeJury'] = $toBeJury;
        $data['counterRondas'] = $counterRondas;
        $data['usuariosqueVotaron'] = $usuariosqueVotaron;

        return $data;
    }

    private function sendNotification($contest_id)
    {
        $users = User::whereNotNull('email_verified_at')->get();

        $href = url('concursos') . '/' . $contest_id;

        $notification = new \stdClass();
        $notification->subject = "Nuevo concurso";
        $notification->title = "¡Nuevo concurso!";
        $notification->description = "<p>Comunidad Orsai publicó un nuevo concurso. <a href='" . $href . "'>Mirá de qué se trata.</a></p>";
        $notification->users = $users->pluck('id');

        NotificacionModel::create($notification);
    }


}
