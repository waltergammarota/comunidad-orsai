<?php


namespace App\Http\Controllers\Contest;


use App\Databases\ContestApplicationModel;
use App\Databases\ContestModel;
use App\Http\Controllers\Controller;
use App\Http\Controllers\WebController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ContestController extends Controller
{
    public function index(Request $request)
    {
        $concursoLogoId = 1;
        $contest = ContestModel::find($concursoLogoId);
        $minApplications = 25;
        $userInfo = $this->getUserData();
        if (ContestApplicationModel::where("is_winner", 1)->first()) {
            $userInfo = $this->getUserData();
            $data = array_merge($userInfo);
            $propuesta = ContestApplicationModel::where("is_winner", 1)->with(['logos', 'owner'])->first();
            $logo = $propuesta->logos()->first();
            $avatar = $propuesta->owner()->first()->avatar()->first();
            $data['logo'] = url('storage/logo/' . $logo->name . "." . $logo->extension);
            if ($avatar != null) {
                $data['avatar'] = url('storage/images/' . $avatar->name . "." . $avatar->extension);
            } else {
                $data['avatar'] = url('img/participantes/usuario.png');
            }
            $user = $propuesta->owner()->first();
            $data['userName'] = $user->userName;
            $data['votes'] = $propuesta->votes;
            $data['name'] = $user->name;
            $data['lastName'] = $user->lastName;
            $data['country'] = $user->country;
            $data['facebook'] = $user->facebook;
            $data['instagram'] = $user->instagram;
            return view("logo-ganador", $data);
        }

        if ($contest->active) {
            $controller = new WebController();
            return $controller->show_participantes($request);
        }

        $data = array_merge($userInfo);
        return view("votacion-no-comenzada", $data);
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

    public function edit(Request $request)
    {
        $id = $request->route('id');
        $contest = ContestModel::find($id);
        return view('admin.contest-form', compact('contest'));
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'id' => 'required',
                'name' => 'required|min:1|max:128',
                'start_date' => 'required|date',
                'votes_end_date' => 'required|date',
                'end_upload_app' => 'required|date',
                'end_date' => 'required|date',
                'min_apps_qty' => 'required|integer',
            ]
        );
        $id = $request->id;
        $contest = ContestModel::find($id);
        $contest->fill($request->all(['name', "start_date", "end_date", "votes_end_date", "min_apps_qty", "end_upload_app"]));
        $contest->save();
        return Redirect::to('admin/concurso');
    }
}
