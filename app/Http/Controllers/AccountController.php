<?php


namespace App\Http\Controllers;

use App\Controllers\CreateContestApplicationController;
use App\Databases\CiudadModel;
use App\Databases\ContestApplicationModel;
use App\Databases\ContestModel;
use App\Databases\CpaChapterModel;
use App\Databases\CpaLog;
use App\Databases\PaisModel;
use App\Databases\ProvinciaModel;
use App\Databases\Transaction;
use App\Repositories\ContestApplicationRepository;
use App\Repositories\ContestRepository;
use App\Repositories\FileRepository;
use App\Repositories\UserRepository;
use App\UseCases\ContestApplication\EditContestApplication;
use App\UseCases\ContestApplication\GetContestApplicationByUser;
use App\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
        return view('perfil', $data);
    }

    public function show_redes(Request $request)
    {
        $data = $this->getUserData();
        if (!$this->isProfileCompleted()) {
            $request->session()->flash('alert', 'profile_not_completed');
        }
        return view('2021-redes-sociales', $data);
    }

    public function show_seguridad(Request $request)
    {
        $data = $this->getUserData();
        if (!$this->isProfileCompleted()) {
            $request->session()->flash('alert', 'profile_not_completed');
        }
        return view('2021-seguridad', $data);
    }

    public function show_formacion(Request $request)
    {
        $data = $this->getUserData();
        if (!$this->isProfileCompleted()) {
            $request->session()->flash('alert', 'profile_not_completed');
        }
        return view('2021-formacion-y-experiencia', $data);
    }

    private function getPaises()
    {
        $paises = PaisModel::orderBy('peso', 'desc')->orderBy('nombre', 'asc')->get()->toArray();
        return array_map(function ($item) {
            $row = new \stdClass();
            $row->iso = $item['iso'];
            $row->nombre = utf8_encode($item['nombre']);
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
        $data['concurso'] = $contest;
        $data['hasImage'] = false;
        $data['hasPdf'] = false;

        if ($postulacion == null) {
            return view('postulacion.postulacion-1', $data);
        }


        $status = $postulacion->status()->first()->status;
        $data['capitulo'] = CpaChapterModel::where("cap_id", $postulacion->id)->where('orden', $request->route('chapter_id'))->first();
        $data['orden'] = $request->route("chapter_id") ? $request->route('chapter_id') : 1;
        $data['hasImage'] = $postulacion->images()->first();
        $data['hasPdf'] = $postulacion->pdfs()->first();
        if ($status == "draft" && $request->route('chapter_id') == null) {
            return view("postulacion.postulacion-1", $data);
        }

        if ($status == "draft" && $request->route('chapter_id') > 0) {
            return view('postulacion.postulacion-2', $data);
        }
        if ($status == "approved") {
            return Redirect::to('propuesta/' . $postulacion->id);
        }

        return Redirect::to('concursos' . $contest->id . '/' . $contest->name);
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
        $data['postulacion'] = $cpa;
        $data['concurso'] = $cpa->contest()->first();
        $data['logo'] = $data['concurso']->logo();
        return view("postulacion.postulacion-preview", $data);
    }

    public function sent_cpa(Request $request)
    {
        $request->validate([
            "cap_id" => 'required|numeric',
            "bases" => 'required',
            "condiciones" => 'required'
        ]);

        $cpaId = $request->cap_id;
        $cpa = ContestApplicationModel::find($cpaId);
        if ($cpa == null) {
            abort(404);
        }
        $cpa->condiciones = Carbon::now();
        $cpa->bases = Carbon::now();
        $cpa->save();
        $cpaLog = new CpaLog(["status" => "sent", "cap_id" => $cpa->id]);
        $cpaLog->save();

        // TODO poner link a postulacion a
        return Redirect::to('concursos');

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
        $contest = $cpa->contest();
        $this->reorganizeChapters($capId, $orden);
        if ($orden == 1) {
            $url = url("postulaciones/{$contest->id}/{$contest->name}");
        } else {
            $ordenAnterior = $orden - 1;
            $url = url("postulaciones/{$contest->id}/{$contest->name}/capitulos/{$ordenAnterior}");
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
            "title" => "required",
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
        return ContestApplicationModel::where('contest_id', $contestId)->where('user_id', $userId)->first();
    }

    public function store_publicacion(Request $request)
    {
        $appsQty = $this->findPostulacion(Auth::user()->id, $request->contest_id);
        if ($request->cap_id == 0 && $appsQty == null) {
            return $this->createNewCap($request);
        }
        return $this->updateCap($request);
    }

    private function updateCap(Request $request)
    {
        $request->validate([
            "cap_id" => 'required',
            "contest_id" => 'required',
            "image_flag" => 'required',
            "pdf_flag" => 'required'
        ]);

        $contest = ContestModel::find($request->contest_id);
        $cpa = ContestApplicationModel::find($request->cap_id);

        $files = $this->saveImages($request, $cpa);

        if ($contest == null && $cpa == null) {
            abort(404);
        }

        $cpa->title = $request->title;
        $cpa->description = $request->description;
        $cpa->link = $request->link;
        $cpa->save();

        return Redirect::to("postulaciones/{$contest->id}/{$contest->name}/capitulos/1");
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    private function createNewCap(
        Request $request
    ): RedirectResponse
    {
        $request->validate(
            [
                'title' => 'required|min:1|max:255',
                'description' => 'required|min:1|max:255',
                'contest_id' => 'required',
                'images' => 'array',
                'images.*' => 'image|max:5120',
                'pdf' => 'array',
                'pdf.*' => 'mimes:pdf|max:5120',
            ]
        );

        $contest = ContestModel::find($request->contest_id);
        $cpa = new ContestApplicationModel();

        if ($contest->hasPostulacionesAbiertas()) {
            $cpa->title = $request->title;
            $cpa->description = $request->description;
            $cpa->link = $request->link;
            $cpa->user_id = Auth::user()->id;
            $cpa->contest_id = $request->contest_id;
            $cpa->save();

            $this->saveImages($request, $cpa);

            $cpaLog = new CpaLog(["status" => "draft", "cap_id" => $cpa->id]);
            $cpaLog->save();
        }
        return Redirect::to("postulaciones/{$contest->id}/{$contest->name}/capitulos/1");
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

    public function profile_update(Request $request)
    {
        $allowedTypes = [
            'name',
            'lastName',
            'country',
            'provincia',
            'city',
            'birth_date',
            'profesion',
            'facebook',
            'twitter',
            'instagram'
        ];
        $postData = $request->all($allowedTypes);
        $user = Auth::user();
        $user->fill($postData);
        if (strlen($user->name) <= 3 || strlen($user->lastName) <= 3) {
            return response()->json(['message' => "Nombre y Apellido deben ser mayores a 3 caracteres"], 422);
        }
        $action = "";
        $user->save();
        $this->updateUserNameInCoral($user);
        if ($this->sendProfileExtraPoints()) {
            return response()->json(['message' => "points profile completed", "action" => $action]);
        } else {
            return response()->json(['message' => "profile updated", "action" => $action]);
        }

        return response()->json(['message' => "Some types are not supported"], 422);
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
        return view('postulaciones', $data);
    }

    public function transacciones()
    {
        $data = $this->getUserData();
        $user = Auth::user();
        $data['hasStarted'] = $this->hasStarted(1);
        $data['txs'] = Transaction::where("from", $user->id)->orWhere(
            "to",
            $user->id
        )->get();
        return view('transacciones', $data);
    }

    public function notificaciones()
    {
        $data = $this->getUserData();
        return view('notificaciones', $data);
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
        return view('notificacion', $data);
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
        $image = $fileRepo->getUploadedFiles('images', $request);
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


}
