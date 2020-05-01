<?php


namespace App\Http\Controllers;

use App\Controllers\CreateContestApplicationController;
use App\Databases\ContestApplicationModel;
use App\Databases\ContestModel;
use App\Databases\Transaction;
use App\Repositories\ContestApplicationRepository;
use App\Repositories\ContestRepository;
use App\Repositories\FileRepository;
use App\Repositories\UserRepository;
use App\UseCases\ContestApplication\EditContestApplication;
use App\UseCases\ContestApplication\GetContestApplicationByUser;
use App\User;
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
        return view('perfil', $data);
    }

    public function show_perfil_publico(Request $request)
    {
        $data = $this->getUserData();
        $user = User::find($request->route('id'));
        if($user == null ) {
            return Redirect::to('no-encontrado');
        }
        $data['user'] = $user;
        $avatar = $user->avatar()->first();
        if($avatar != null) {
            $data['avatar'] = url('storage/images/'.$avatar->name.".".$avatar->extension);
        } else {
            $data['avatar'] = url('img/participantes/participante.jpg');
        }
        return view('perfil-publico', $data);
    }

    public function show_panel()
    {
        $data = $this->getUserData();
        return view('panel', $data);
    }

    public function show_postulacion(Request $request)
    {
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
        return view('postulacion', $data);
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
    private function createNewCap(Request $request
    ): RedirectResponse {
        $request->validate(
            [
                'title' => 'required|min:1|max:255',
                'description' => 'required|min:1|max:64',
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
            "description" => $request->description,
            "link" => $request->link,
            "user_id" => Auth::user()->id,
            "contest_id" => 1,
        ];
        $cpa = new CreateContestApplicationController($data, $request);
        $id = $cpa->execute();
        return Redirect::to("panel");
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
            "description"
        ];
        $attr = Arr::where(
            $userData,
            function ($value, $key) use ($exceptFields) {
                if (in_array($key, $exceptFields)) {
                    return $value != null && $value != "";
                }
            }
        );
        return count($attr) >= 6;
    }

    public function profile_update(Request $request)
    {
        $type = $request->type;
        $allowedTypes = [
            'name',
            'lastName',
            'userName',
            'country',
            'city',
            'birth_date',
            'profesion',
            'description',
            'facebook',
            'twitter',
            'instagram'
        ];
        if (in_array($type, $allowedTypes)) {
            $value = $request->value;
            $user = Auth::user();
            $user->{$type} = $value;
            $user->save();
            if($this->sendProfileExtraPoints()) {
                return response()->json(['message' => "points profile completed"]);
            }
            return response()->json(['message' => "{$type} updated"]);
        }
        return response()->json(['message' => "{$type} not supported"], 422);
    }

    private function sendProfileExtraPoints()
    {
        $user = Auth::user();
        $data = "Puntos Perfil Completo";
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
                    "type"=> "MINT",
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

    public function transacciones()
    {
        $data = $this->getUserData();
        $user = Auth::user();
        $data['txs'] = Transaction::where("from", $user->id)->orWhere(
            "to",
            $user->id
        )->get();
        return view('transacciones', $data);
    }

}
