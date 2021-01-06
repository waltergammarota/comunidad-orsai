<?php


namespace App\Http\Controllers;

use App\Controllers\CreateContestApplicationController;
use App\Databases\CiudadModel;
use App\Databases\ContestApplicationModel;
use App\Databases\ContestModel;
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
        return view('perfil-publico', $data);
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
        return view('panel', $data);
    }

    private function hasStarted($contestId)
    {
        return ContestModel::find($contestId)->start_date < now();
    }

    public function show_postulacion(Request $request)
    {
        $contest = ContestModel::find(1);
        if ($this->checkWinner(1) || $contest->end_date < now()) {
            $data = $this->getUserData();
            return view("concurso-finalizado", $data);
        }

        $userData = $this->getUserData();
        $data = $userData;
        $postulacion = $this->findPostulacion(Auth::user()->id);
        if ($postulacion['cap_current_status'] != "draft") {
            return Redirect::to('propuesta/' . $postulacion['cap_id']);
        }
        if ($postulacion['cap_user_id'] != Auth::user()->id) {
            return Redirect::to('postulacion');
        }
        $data = array_merge($userData, $postulacion);
        if ($contest->end_upload_app < now()) {
            return Redirect::to('panel');
        }
        return view('postulacion', $data);
    }

    private function checkWinner($contestId)
    {
        return ContestApplicationModel::where(["is_winner" => 1, "contest_id" => $contestId])->count();
    }

    private function findPostulacion($userId)
    {
        return (new GetContestApplicationByUser($userId))->execute();
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
        $data = [
            "id" => $request->cap_id,
            "title" => $request->title,
            "description" => $request->description,
            "link" => $request->link,
            "user_id" => Auth::user()->id,
            "contest_id" => 1,
        ];
        $cpa = new EditContestApplication(
            $data,
            $request,
            new UserRepository(),
            new ContestRepository(
                new ContestModel()
            ),
            new ContestApplicationRepository(
                new ContestApplicationModel(),
                new UserRepository()
            ),
            new FileRepository()
        );
        $id = $cpa->execute();
        return Redirect::to("panel");
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
                'logo' => 'required|array|min:1|max:1',
                'logo.*' => 'image|required|max:5120',
                'images' => 'array',
                'images.*' => 'image|max:5120',
                'pdf' => 'array',
                'pdf.*' => 'mimes:pdf|max:5120',
            ]
        );

        $data = [
            "title" => $request->title,
            "link" => $request->link,
            "description" => $request->description,
            "user_id" => Auth::user()->id,
            "contest_id" => 1,
        ];
        $cpa = new CreateContestApplicationController($data, $request);
        $id = $cpa->execute();
        return Redirect::to("gracias");
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
            'prefijo',
            'whatsapp',
            'twitter',
            'instagram'
        ];
        $postData = $request->all($allowedTypes);
        $user = Auth::user();
        $previousPhone = $user->prefijo . $user->whatsapp;
        $user->fill($postData);
        if (strlen($user->name) <= 3 || strlen($user->lastName) <= 3) {
            return response()->json(['message' => "Nombre y Apellido deben ser mayores a 3 caracteres"], 422);
        }
        $action = "";
        if ($previousPhone != $user->prefijo . $user->whatsapp && $user->whatsapp != "" && $user->prefijo != "") {
            $action = "validate phone";
            $user->sms_sent_at = null;
            $user->code = null;
            $user->phone_verified_at = null;
        }
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
}
