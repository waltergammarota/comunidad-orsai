<?php


namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Databases\AnswerModel;
use App\Databases\CiudadModel;
use App\Databases\ContestApplicationModel;
use App\Databases\ContestModel;
use App\Databases\CpaChapterModel;
use App\Databases\CpaLog;
use App\Databases\FormacionModel;
use App\Databases\IdiomasModel;
use App\Databases\OcupacionModel;
use App\Databases\PaisModel;
use App\Databases\ProvinciaModel;
use App\Databases\SectorModel;
use App\Databases\Transaction;
use App\Repositories\FileRepository;
use App\User;
use App\Utils\Mailer;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


use App\Databases\NotificacionModel;
use App\Notifications\GenericNotification;
use Illuminate\Support\Facades\Notification;


class AccountController extends Controller
{
    public function show_perfil(Request $request)
    {
        $data = $this->getUserData();
        if (!$this->isProfileCompleted()) {
            $request->session()->flash('alert', 'profile_not_completed');
        }
        $data['paises'] = $this->getPaises();
        $data['provinciasOptions'] = ProvinciaModel::all();
        $data['ciudadesOptions'] = CiudadModel::all();
        $data['provincias'] = json_encode($this->getProvincias($data['provinciasOptions']));
        $data['ciudades'] = json_encode($this->getCiudades($data['ciudadesOptions']));
        $data['countries'] = PaisModel::all();
        return view('2021-perfil', $data);
    }

    public function show_redes(Request $request)
    {
        $twitter = $request->oauth_token;
        $verifier = $request->oauth_verifier;
        if ($twitter && $twitter == session('oauth_token')) {
            $this->verifyTwitter($verifier);
        }
        $data = $this->getUserData();
        if (!$this->isProfileCompleted()) {
            $request->session()->flash('alert', 'profile_not_completed');
        }
        return view('2021-redes-sociales', $data);
    }

    public function saveFacebook(Request $request)
    {
        $facebookId = $request->facebook_id;
        $facebookUser = $request->facebook_user;
        $user = Auth::user();
        $user->facebook = $facebookUser;
        $user->facebook_id = $facebookId;
        $user->save();
        return response()->json(["status" => 'success', 'msg' => 'Facebook user updated']);
    }

    public function saveTwitter(Request $request)
    {
        $twitterId = $request->twitter_id;
        $twitterUser = $request->twitter_user;
        $user = Auth::user();
        $user->twitter = $twitterUser;
        $user->twitter_id = $twitterId;
        $user->save();
        return response()->json(["status" => 'success', 'msg' => 'Twitter user updated']);
    }

    public function saveInstagram(Request $request)
    {
        $instagramId = $request->instagram_id;
        $instagramUser = $request->instagram_user;
        $user = Auth::user();
        $user->instagram = $instagramUser;
        $user->instagram_id = $instagramId;
        $user->save();
        return response()->json(["status" => 'success', 'msg' => 'Instagram user updated']);
    }

    public function show_seguridad(Request $request)
    {
        $data = $this->getUserData();
        if (!$this->isProfileCompleted()) {
            $request->session()->flash('alert', 'profile_not_completed');
        }
        $data['countries'] = $this->getPaises();
        $data['prefijo_guardado'] = $this->findCountry($data);
        return view('2021-seguridad', $data);
    }

    private function findCountry($data)
    {
        $prefijo = $data['prefijo'];
        $foundCountry = [
            "prefijoTel" => "",
            "nombre" => ""
        ];
        foreach ($data['countries'] as $country) {
            if (($country->prefijoTel == $prefijo && $country->prefijoTel != "") || ($prefijo == 0 && $country->prefijoTel == 54)) {
                $foundCountry = [
                    "prefijoTel" => $country->prefijoTel,
                    "nombre" => $country->nombre
                ];
                break;
            }
        }
        return $foundCountry;
    }

    public function show_formacion(Request $request)
    {
        $data = $this->getUserData();
        if (!$this->isProfileCompleted()) {
            $request->session()->flash('alert', 'profile_not_completed');
        }
        $data['ocupaciones'] = OcupacionModel::orderBy('name', 'asc')->get();
        $data['formaciones'] = FormacionModel::orderBy('name', 'asc')->get();
        $data['languages'] = IdiomasModel::orderBy('name', 'asc')->get();
        $data['sectores'] = SectorModel::orderBy('name', 'asc')->get();
        return view('2021-formacion-y-experiencia', $data);
    }

    public function formacion_update(Request $request)
    {
        $user = Auth::user();
        $user->ocupacion = $request->ocupacion ? $request->ocupacion : [];
        $user->empresa = $request->empresa;
        $user->sector = $request->sector;
        $user->formacion = $request->formacion_alc ? $request->formacion_alc : [];
        $user->idiomas = $request->idiomas ? $request->idiomas : [];
        $user->save();
        return Redirect::to('formacion-y-experiencia');
    }

    private function getPaises()
    {
        $paises = PaisModel::orderBy('peso', 'desc')->orderBy('nombre', 'asc')->get()->toArray();
        return array_map(function ($item) {
            $row = new \stdClass();
            $row->iso = $item['iso'];
            $row->nombre = utf8_encode($item['nombre']);
            $row->prefijoTel = $item['prefijoTel'];
            return $row;
        }, $paises);
    }

    private function getProvincias($provincias)
    {
        $data = [];
        foreach ($provincias as $provincia) {
            $row['id'] = $provincia->id;
            $row['pais'] = $provincia->pais;
            $row['nombre'] = utf8_encode($provincia->nombre);
            $data[] = $row;
        }
        return $data;
    }

    private function getCiudades($ciudades)
    {
        $data = [];
        foreach ($ciudades as $ciudad) {
            $row['id'] = $ciudad->id;
            $row['idProvincia'] = $ciudad->idProvincia;
            $row['nombre'] = utf8_encode($ciudad->nombre);
            $data[] = $row;
        }
        return $data;
    }

    public function show_perfil_publico(Request $request)
    {
        $data = $this->getUserData();
        $user = User::find($request->route('id'));
        if ($user == null) {
            return Redirect::to('no-encontrado');
        }
        $data['user'] = $user;
        $avatar = $user->avatar()->first();
        if ($avatar != null) {
            $data['avatar'] = url('storage/images/' . $avatar->name . "." . $avatar->extension);
        } else {
            $data['avatar'] = url('img/participantes/participante.jpg');
        }
        return view('2021-perfil-publico', $data);
    }

    public function show_panel()
    {
        $data = [];
        $data['hasStarted'] = $this->hasStarted(1);
        $data['emailWasValidated'] = Auth::user()->email_verified_at != null;
        $data['endUploadAppDate'] = ContestModel::find(1)->end_upload_app < now();
        $data['totalusers'] = User::where('email_verified_at', '!=', null)->count();
        $data['user'] = Auth::user();
        $data = array_merge($data, $this->getUserData());
        return view('2021-panel', $data);
    }

    private function hasStarted($contestId)
    {
        return ContestModel::find($contestId)->start_date < now();
    }

    public function show_postulacion(Request $request)
    {
        $contestId = $request->route('contest_id');
        $contest = ContestModel::find($contestId);
        // NO EXISTE EL CONCURSO
        if ($contest == null) {
            abort(404);
        }
        // EL CONCURSO TERMINÓ O YA HAY UN GANADOR
        if ($this->checkWinner($contestId) || $contest->end_date < now()) {
            return Redirect::to("concursos/{$contest->id}/{$contest->name}");
        }
        // YA NO SE PUEDE POSTULAR MÁS
        if (!$contest->hasPostulacionesAbiertas()) {
            return Redirect::to("concursos/{$contest->id}/{$contest->name}");
        }
        $data = $this->getUserData();
        // NO SE POSTULÓ O ESTÁ EN DRAFT
        $postulacion = $this->findPostulacion(Auth::user()->id, $contestId);
        $data['postulacion'] = $postulacion;
        $data['buttons'] = true;
        $data['concurso'] = $contest;
        $data['hasImage'] = false;
        $data['hasPdf'] = false;
        $data['form'] = $contest->form()->first();
        $data['bases'] = $contest->getBases();
        $data['answers'] = collect([]);
        $status = $postulacion ? $postulacion->status()->latest()->first() : "draft";
        if ($status != "draft") {
            $postulacion = null;
            $data['postulacion'] = null;
        }
        if ($postulacion == null) {
            if ($contest->type == 1) {
                return view('concursos.concurso-cuento', $data);
            }
            return view('concursos.concurso-cuento', $data);
        }

        $data['orden'] = $request->route("chapter_id") ? $request->route('chapter_id') : 1;
        $data['hasImage'] = $postulacion->images()->first();
        $data['hasPdf'] = $postulacion->pdfs()->first();
        $data['answers'] = AnswerModel::where('cap_id', $postulacion->id)->get();
        if ($status == "draft" && $request->route('chapter_id') == null) {
            if ($contest->type == 1) {
                return view('concursos.concurso-cuento', $data);
            }
            return view("concursos.concurso-cuento", $data);
        }
        return Redirect::to('concursos/' . $contest->id . '/' . $contest->name);
    }

    public function preview(Request $request)
    {
        $cpaId = $request->route("cap_id");
        $cpa = ContestApplicationModel::find($cpaId);
        if ($cpa == null) {
            abort(404);
        }
        $data = $this->getUserData();
        $data['capitulos'] = CpaChapterModel::where("cap_id", $cpaId)->orderBy("orden", "asc")->get();
        $data['bases'] = 'url'; //$data['concurso']->getbases(); (?)
        $data['postulacion'] = $cpa;
        $data['concurso'] = $cpa->contest()->first();
        $images = $cpa->images()->get();
        if (count($images) > 0) {
            $data['logo'] = $images[0];
        } else {
            $data['logo'] = $data['concurso']->logo();
        }
        return view("postulacion.postulacion-preview", $data);
    }

    public function sent_cpa($cpa, $contest, $user)
    {
        if ($user->getBalance() >= $contest->cost_per_cpa) {
            $cpa->bases = Carbon::now();
            $cpa->condiciones = Carbon::now();
            $cpa->save();
            $cpaLog = new CpaLog(["status" => "sent", "cap_id" => $cpa->id]);
            $cpaLog->save();
            if ($contest->auto_approval == 1) {
                $cpaLog = new CpaLog(["status" => "approved", "cap_id" => $cpa->id]);
                $cpaLog->save();
                $owner = User::find($cpa->user_id);
                $this->sendApproveMail($owner->email, $cpa->id);
                $this->sendMailToAdministrator($owner->email, $cpa->id, $owner->name, $owner->lastName);
            }
            Transaction::createTransaction($user->id, $contest->pool_id, $contest->cost_per_cpa, "Inscripción a concurso " . $contest->name, null, 'TRANSFER');
        }
        return Redirect::to('mis-postulaciones');
    }

    private function sendMailToAdministrator($email, $cpaId, $name, $lastName)
    {
        $mailer = new Mailer();
        $mailer->sendMailToAdministrator($email, $cpaId, $name, $lastName);
    }

    private function sendApproveMail($email, $cpaId)
    {
        $mailer = new Mailer();
        $mailer->sendApproveMail($email, $cpaId);
    }


    public function delete_chapter(Request $request)
    {
        $request->validate([
            "cap_id" => "required|numeric",
            "orden" => "required|numeric"
        ]);
        $orden = $request->orden;
        $capId = $request->cap_id;
        $cpa = ContestApplicationModel::find($capId);
        $chapter = CpaChapterModel::where("orden", $orden)->where("cap_id", $capId)->first();
        if ($chapter == null || $cpa == null) {
            return response()->json(["status" => "error"], 400);
        }
        $chapter->delete();
        $contest = $cpa->contest()->first();
        $this->reorganizeChapters($capId, $orden);
        if ($orden == 1) {
            $url = url("postulaciones/{$contest->id}/{$contest->name}");
        } else {
            $ordenAnterior = $orden - 1;
            $url = url("postulaciones/{$contest->id}/{$contest->name}/capitulos/1");
        }
        return response()->json(["status" => "sucess", "url" => $url]);
    }

    private function reorganizeChapters($capId, $ordenBorrado)
    {
        $chapters = CpaChapterModel::where("cap_id", $capId)->get();
        foreach ($chapters as $chapter) {
            $chapter->orden = $chapter->orden > $ordenBorrado ? $chapter->orden - 1 : $chapter->orden;
            $chapter->save();
        }
    }


    public function store_chapter(Request $request)
    {
        $request->validate([
            "cap_id" => "required",
            "orden" => "required|numeric",
            "title" => "required|min:1|max:120",
            "body" => "required"
        ]);
        $cpaId = $request->cap_id;
        $user = Auth::user();
        $orden = $request->orden == 0 ? 1 : $request->orden;
        $cpa = ContestApplicationModel::find($cpaId);
        if ($cpa->user_id == $user->id) {
            $chapter = CpaChapterModel::where("cap_id", $cpaId)->where("orden", $orden)->first();
            $contest = $cpa->contest()->first();
            if ($contest->type == 1 && $orden > 1) {
                return Redirect::to("postulaciones/{$cpa->contest_id}/{$cpa->contest()->name}/capitulos/1");
            }
            if ($chapter == null) {
                $chapter = new CpaChapterModel();
            }
            $chapter->title = $request->title;
            $chapter->body = $request->body;
            $chapter->orden = $orden;
            $chapter->cap_id = $cpaId;
            $chapter->save();
        }
        $ordenSiguiente = $orden + 1;
        return Redirect::to("postulaciones/{$cpa->contest_id}/{$contest->name}/capitulos/{$ordenSiguiente}");
    }

    private function checkWinner($contestId)
    {
        return ContestApplicationModel::where(["is_winner" => 1, "contest_id" => $contestId])->count();
    }

    private function findPostulacion($userId, $contestId)
    {
        $cpa = ContestApplicationModel::where('contest_id', $contestId)->where('user_id', $userId)->with('status')->latest()->first();
        return $cpa;
    }

    public function store_publicacion(Request $request)
    {
        if ($request->cap_id == 0) {
            return $this->createNewCap($request);
        }
        return $this->updateCap($request);
    }

    private function updateCap(Request $request)
    {
        $contest = ContestModel::find($request->contest_id);
        $form = $contest->form()->first();
        $rules = $form->getRules();
        $rules['bases'] = "required";
        $rules['contest_id'] = "required";
        if ($rules && $request->enviar == "enviar") {
            Validator::make($request->all(), $rules, [], $form->getInputsMessages())->validate();
        }

        $user = Auth::user();
        $cpa = ContestApplicationModel::find($request->cap_id);
        if ($cpa->user_id != $user->id) {
            abort(404);
        }
        if ($contest == null && $cpa == null) {
            abort(404);
        }

        $cpa->title = "";
        $cpa->description = "";
        $cpa->link = "";
        $cpa->save();
        $this->saveAnswers($contest, $form, $cpa, $user, $request);
        if ($request->enviar == "enviar") {
            $this->sent_cpa($cpa, $contest, $user);
        }
        if ($request->redirect == "donar") {
            return Redirect::to("donar");
        }
        return Redirect::to("mis-postulaciones");
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    private function createNewCap(
        Request $request
    ): RedirectResponse
    {
        $contest = ContestModel::find($request->contest_id);
        $form = $contest->form()->first();
        $rules = $form->getRules();
        $rules['bases'] = "required";
        $rules['contest_id'] = "required";
        $messages = $form->getInputsMessages();
        if ($rules && $request->enviar == "enviar") {
            Validator::make($request->all(), $rules, [], $messages)->validate();
        }

        $cpa = new ContestApplicationModel();
        if ($contest->hasPostulacionesAbiertas()) {
            $user = Auth::user();
            $cpa->title = "";
            $cpa->description = "";
            $cpa->link = "";
            $cpa->user_id = $user->id;
            $cpa->contest_id = $request->contest_id;
            $cpa->save();
            $this->saveAnswers($contest, $form, $cpa, $user, $request);
            $cpaLog = new CpaLog(["status" => "draft", "cap_id" => $cpa->id]);
            $cpaLog->save();
        }
        if ($request->enviar == "enviar") {
            $this->sent_cpa($cpa, $contest, $user);
        }
        if ($request->redirect == "donar") {
            return Redirect::to("donar");
        }
        return Redirect::to("mis-postulaciones");
    }

    private function saveAnswers($contest, $form, $cpa, $user, $request)
    {
        $params = $request->all();
        $values = array_filter($params, function ($key) {
            return strpos($key, "input@") !== false;
        }, ARRAY_FILTER_USE_KEY);
        AnswerModel::where("cap_id", $cpa->id)->delete();
        foreach ($values as $key => $value) {
            $answer = new AnswerModel([
                "form_id" => $form->id,
                "contest_id" => $contest->id,
                "input_id" => substr($key, 6),
                "cap_id" => $cpa->id,
                "user_id" => $user->id,
                "answer" => $value ? $value : ""
            ]);
            $answer->save();
        }
    }

    public function gracias()
    {
        $data = $this->getUserData();
        return view("gracias", $data);
    }

    private function isProfileCompleted()
    {
        $userData = Auth::user()->toArray();
        $exceptFields = [
            "userName",
            "email",
            "lastName",
            "city",
            "profesion",
        ];
        $attr = Arr::where(
            $userData,
            function ($value, $key) use ($exceptFields) {
                if (in_array($key, $exceptFields)) {
                    return $value != null && $value != "";
                }
            }
        );
        return count($attr) >= 5;
    }

    public function profile_update_redes(Request $request)
    {
        $allowedTypes = [
            'twitter',
            'instagram',
            'linkedin',
            'portfolio',
            'web',
            'medium',
            'redes'
        ];
        $postData = $request->all($allowedTypes);
        $user = Auth::user();
        $user->fill($postData);
        $user->save();
        $action = "";
        return response()->json(['message' => "profile redes updated", "action" => $action]);
    }

    public function profile_update(Request $request)
    {
        $allowedTypes = [
            'name',
            'lastName',
            'country',
            'provincia',
            'city',
            'birth_date',
            'birth_country',
            'profesion',
            'passport',
            'description',
            'facebook',
            'twitter',
            'instagram',
            'linkedin',
            'portfolio',
            'web',
            'medium',
            'redes'
        ];
        $postData = $request->all($allowedTypes);
        $user = Auth::user();
        $user->fill($postData);
        if ($request->has('name') || $request->has('lastName')) {
            if (strlen($user->name) <= 3 || strlen($user->lastName) <= 3) {
                return response()->json(['message' => "Nombre y Apellido deben ser mayores a 3 caracteres"], 422);
            }
        }
        $action = "";
        $user->save();
        $this->updateUserNameInCoral($user);
        return response()->json(['message' => "profile updated", "action" => $action]);
    }

    private function updateUserNameInCoral($user)
    {
        $client = new Client();
        try {
            $endpoint = env('CORAL_AUTH_URL');
            $response = $client->post(
                $endpoint,
                ["json" => [
                    'email' => env('CORAL_ADMIN_USER'),
                    'password' => env('CORAL_ADMIN_PASSWORD')
                ]]
            );
            $token = json_decode($response->getBody());
            $endpointGraphQL = env('CORAL_GRAPHQL_URL');
            $cambiarNombreResponse = $client->post(
                $endpointGraphQL,
                [
                    "headers" => [
                        "Authorization" => "Bearer {$token->token}",
                        "Content-Type" => "application/json"
                    ],
                    "json" => [
                        "query" => 'mutation($id:ID!,$name:String!,$clientMutationId:String!){updateUserUsername(input:{userID:$id,username:$name,clientMutationId:$clientMutationId}){user{id username}}}',
                        "variables" => [
                            "id" => $user->coral_token,
                            "name" => "{$user->name} {$user->lastName}",
                            "clientMutationId" => "1"
                        ]
                    ]
                ]
            );
        } catch (\Exception $error) {
            return $error;
        }
    }

    private function sendProfileExtraPoints()
    {
        $user = Auth::user();
        $data = "Fichas perfil completo";
        $tx = Transaction::where(
            ["to" => $user->id, "type" => "MINT", "data" => $data]
        )->count();
        $isProfileCompleted = $this->isProfileCompleted();
        if ($tx == 0 && $isProfileCompleted) {
            $profileCompleteTx = new Transaction(
                [
                    "from" => 1,
                    "to" => $user->id,
                    "amount" => 250,
                    "type" => "MINT",
                    "data" => $data
                ]
            );
            $profileCompleteTx->save();
            return true;
        }
        return false;
    }

    public function profile_image(Request $request)
    {
        $user = Auth::user();
        $fileRepo = new FileRepository();
        $images = $fileRepo->getUploadedFiles("images", $request);
        if (count($images) > 0) {
            $user->avatar = $images[0]->getId();
            $user->save();
            return response()->json(['message' => "Avatar updated"]);
        }
        return response()->json(['message' => "Invalid image"], 422);
    }

    public function postulaciones()
    {
        $data = $this->getUserData();
        $user = Auth::user();
        $data['postulaciones'] = ContestApplicationModel::where('user_id', $user->id)->get();
        return view('2021-mis-postulaciones', $data);
    }

    public function transacciones()
    {

        $data = $this->getUserData();
        $user = Auth::user();
        $data['hasStarted'] = $this->hasStarted(1);

        $txsQuery = DB::table('transactions')
            ->leftJoin('compras', 'transactions.id', '=', 'compras.delivered')
            ->where('transactions.from', '=', $user->id)
            ->orWhere('transactions.to', '=', $user->id)
            ->select(DB::raw('compras.payment_processor, compras.price_ars, transactions.*'));

        //$data['txs'] = Transaction::where("from", $user->id)->orWhere("to",$user->id)->orderBy('id', 'desc')->get();
        $data['txs'] = $txsQuery->orderBy('transactions.id', 'desc')->get();
        $data['baldeo'] = Transaction::getNextBaldeoDate($user);
        $data['mordida'] = Transaction::getNextMordida($user);


        //$this->sendNotification($user);


        return view('2021-mis-fichas', $data);
    }


    private function sendNotification($user)
    {
        $href = url('mis-fichas');

        $notification = new \stdClass();
        $notification->subject = "Nueva donación";
        $notification->title = "¡Gracias por la donación!";
        $notification->description = "<p>Ya tenés las fichas disponibles en tu cuenta. <a href='" . $href . "'>Ver.</a></p>";
        $notification->button_url = '';
        $notification->button_text = '';
        $notification->user_id = 1;
        $notification->deliver_time = Carbon::now();
        $notification->id = 0;

        Notification::send($user, new GenericNotification($notification));
    }





    public function notificaciones()
    {
        $data = $this->getUserData();
        return view('2021-mis-notificaciones', $data);
    }

    public function notificacion(Request $request)
    {
        $user = Auth::user();
        $id = $request->id;
        $notification = $user->notifications->where('id', $id)->first();
        $user->unreadNotifications->where('id', $id)->markAsRead();
        $data['notification'] = $notification->data;
        $autor = User::find($notification->data['author']);
        $data['autor'] = "{$autor->name} {$autor->lastName}";
        $data = array_merge($data, $this->getUserData());
        return view('2021-notificacion', $data);
    }

    public function notificaciones_counter()
    {
        $user = Auth::user();
        return response()->json(["amount" => $user->unreadNotifications->count()]);
    }

    public function notificaciones_json(Request $request)
    {
        $user = Auth::user();
        $data['notificaciones'] = [];
        $notificaciones = $user->notifications;
        foreach ($notificaciones as $notification) {
            $rowData = $notification->data;
            $row['title'] = $rowData['title'];
            $row['subject'] = $rowData['subject'];
            $author = User::find($rowData['author']);
            $row['autor'] = "{$author->name} {$author->lastName}";
            $row['deliver_time'] = (new Carbon($rowData['deliver_time']))->format('d/m/Y H:i') . " HS";
            $row['real_time'] = (new Carbon($rowData['deliver_time']))->format('m/d/Y H:i');
            $row['id'] = $notification->id;
            $row['readed'] = $notification->read_at == null ? 'NO' : 'SI';
            $data['notificaciones'][] = $row;
        }
        $data = [
            'draw' => $request->query('draw'),
            "recordsTotal" => count($notificaciones),
            "recordsFiltered" => count($data['notificaciones']),
            'data' => $data['notificaciones']
        ];

        return response()->json($data);
    }

    public function markAllasReaded()
    {
        $user = Auth::user();
        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        return response()->json(["message" => "All notifications marked as read"]);
    }

    public function notificaciones_markAsNotRead(Request $request)
    {
        $user = Auth::user();
        $notificationsReaded = $request->ids;
        foreach ($user->notifications as $notification) {
            if (in_array($notification->id, $notificationsReaded)) {
                $notification->update(['read_at' => null]);
            }
        }
        return response()->json(["message" => "notifications marked as not read"]);
    }

    public function notificaciones_markAsRead(Request $request)
    {
        $user = Auth::user();
        $notificationsReaded = $request->ids;
        foreach ($user->unreadNotifications as $notification) {
            if (in_array($notification->id, $notificationsReaded)) {
                $notification->markAsRead();
            }
        }
        return response()->json(["message" => "notifications marked as read"]);
    }

    public function delete_notifications(Request $request)
    {
        $user = Auth::user();
        $notificationsToDelete = $request->ids;
        foreach ($notificationsToDelete as $id) {
            $user->notifications->where('id', $id)->first()->delete();
        }
        return response()->json(["message" => "notifications deleted"]);
    }


    /**
     * @param Request $request
     * @param ContestApplicationModel $cpa
     * @return array
     */
    private function saveImages(Request $request, ContestApplicationModel $cpa): array
    {
        $fileRepo = new FileRepository();
        $image = $fileRepo->getUploadedFiles('images', $request, 1500, 500);
        $pdf = $fileRepo->getUploadedFiles('pdf', $request);
        $files = array();

        if (count($image) > 0) {
            array_push($files, $image[0]->getId());
        }
        if (count($pdf) > 0) {
            array_push($files, $pdf[0]->getId());
        }

        if ($request->image_flag == 1 && count($image) == 0) {
            $imageToDelete = $cpa->images()->first();
            if ($imageToDelete != null) {
                $imageToDelete->delete();
            }
        }

        if ($request->pdf_flag == 1 && count($pdf) == 0) {
            $pdfToDelete = $cpa->pdfs()->first();
            if ($pdfToDelete != null) {
                $pdfToDelete->delete();
            }
        }

        if (count($image) > 0) {
            array_push($files, $image[0]->getId());
            $imageToDelete = $cpa->images()->first();
            if ($imageToDelete != null) {
                $cpa->images()->detach($imageToDelete->id);
                $imageToDelete->delete();
            }
        }
        if (count($pdf) > 0) {
            array_push($files, $pdf[0]->getId());
            $pdfToDelete = $cpa->pdfs()->first();
            if ($pdfToDelete != null) {
                $cpa->pdfs()->detach($pdfToDelete->id);
                $pdfToDelete->delete();
            }
        }
        if (count($files) > 0) {
            $cpa->images()->syncWithoutDetaching($files);
        }

        return [
            "images" => $image,
            "pdf" => $pdf
        ];
    }


    public function change_password(Request $request)
    {
        $request->validate(
            [
                'current_password' => 'required|max:64|min:8',
                'new_password' => 'required|max:64|min:8',
                'confirmation_password' => 'required|same:new_password|max:64|min:8',
            ]
        );

        $current_password = $request->current_password;
        $new_password = $request->new_password;
        $confirmation_password = $request->confirmation_password;
        $user = Auth::user();
        if ($new_password != $confirmation_password) {
            return response()->json(["status" => "error", "msg" => "Las contraseñas no coinciden"], 400);
        }
        if ($new_password == $confirmation_password && Hash::check($current_password, $user->password)) {
            $user->password = password_hash($new_password, PASSWORD_DEFAULT);
            $user->save();
            return response()->json(["status" => "success", "msg" => "Cambio de contraseña exitoso"]);
        }
        return response()->json(["status" => "error", "msg" => "Error en datos"]);
    }

    public function twitter()
    {
        try {
            $consumerKey = env("TWITTER_ACCESS_TOKEN");
            $consumerSecret = env("TWITTER_SECRET");
            $connection = new TwitterOAuth($consumerKey, $consumerSecret);
            $request_token = $connection->oauth('oauth/request_token');
            $url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
            session([
                'oauth_token' => $request_token['oauth_token'],
                'oauth_token_secret' => $request_token['oauth_token_secret']
            ]);
            return response()->json(["status" => "success", 'url' => $url, 'msg' => 'Link enviado']);
        } catch (\Exception $error) {
            return response()->json(["status" => "error", 'msg' => $error->getMessage()], 400);
        }
    }

    /**
     * @param $verifier
     * @throws \Abraham\TwitterOAuth\TwitterOAuthException
     */
    private function verifyTwitter($verifier)
    {
        try {
            $consumerKey = env("TWITTER_ACCESS_TOKEN");
            $consumerSecret = env("TWITTER_SECRET");
            $connection = new TwitterOAuth($consumerKey, $consumerSecret, session('oauth_token'), session('oauth_token_secret'));
            $access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $verifier]);
            $user = Auth::user();
            $user->twitter = $access_token['screen_name'];
            $user->twitter_id = $access_token['user_id'];
            $user->save();
        } catch (\Exception $error) {
        }
    }

}
