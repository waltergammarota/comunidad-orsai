<?php


namespace App\Http\Controllers;

use App\Databases\ContestApplicationModel;
use App\Databases\CpaLog;
use App\Databases\Transaction;
use App\UseCases\ContestApplication\VoteAContestApplication;
use App\User;
use App\Utils\Mailer;
use Illuminate\Http\Request;
use App\UseCases\ContestApplication\GetContestApplicationById;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PropuestaController extends Controller
{

    public function show(Request $request)
    {
        $propuestaId = $request->route('id');
        $propuesta = $this->findPropuesta($propuestaId);
        $user = Auth::user();
        if ($propuesta['current_status'] != "approved" && $user->role != "admin") {
            return Redirect::to('panel');
        }
        $this->addView($propuestaId, $request);
        $data = $this->getUserData();
        $data['propuesta'] = $propuesta;
        $data['txs'] = $this->votes($propuestaId);
        $data['used'] = Transaction::where(
            [
                "cap_id" => $propuestaId,
                "from" => $user->id
            ]
        )->sum('amount');
        $data['related'] = ContestApplicationModel::inRandomOrder()->where("approved", 1)
            ->whereNotIn('id', [$propuestaId])->limit(5)->with('logos')->get();
        return view('propuesta', $data);
    }

    private function addView($propuestaId, $request)
    {
        $views = $request->session()->get('views');
        if ($views == null) {
            $views = [];
        }
        $propuesta = ContestApplicationModel::find($propuestaId);
        if (!in_array($propuestaId, $views)) {
            array_push($views, $propuestaId);
            $request->session()->put('views', $views);
            $propuesta->views = $propuesta->views + 1;
            $propuesta->save();
        }
    }

    private function votes($propuestaId)
    {
        $txs = Transaction::where("cap_id", $propuestaId)->orderBy(
            'created_at',
            'desc'
        )->limit(10)->get();
        $data = [];
        foreach ($txs as $tx) {
            $user = $tx->getFromUser()->first();
            $avatar = $user->avatar()->first();
            $row = new \stdClass();
            $row->userName = $user->userName;
            $row->avatar = $avatar ? 'storage/images/' . $avatar->name . "." . $avatar->extension : 'img/participantes/participante.jpg';
            $row->amount = $tx->amount;
            $data[] = $row;
        }
        return $data;
    }

    public function votar(Request $request)
    {
        $vote = new VoteAContestApplication(
            $request->cap_id,
            Auth::user()->id,
            $request->amount
        );
        $output = $vote->execute();
        return response()->json(["totalVotes" => $output]);
    }

    private function findPropuesta($id)
    {
        return (new GetContestApplicationById($id))->execute();
    }

    public function eliminar(Request $request)
    {
        $capId = $request->id;
        $cap = ContestApplicationModel::destroy($capId);
        return response()->json(
            ["success" => true, "message" => "Contest application removed"]);
    }

    public function approve(Request $request)
    {
        $user = Auth::user();
        if ($user->role == "admin") {
            $cpa = ContestApplicationModel::find($request->id);
            $cpa->approved = 1;
            $cpa->approved_in = now();
            $cpa->approved_by_user = $user->id;
            $cpa->save();
            $cpaLog = new CpaLog(
                ["status" => "approved", "cap_id" => $cpa->id]
            );
            $cpaLog->save();
            $owner = User::find($cpa->user_id);
            $this->sendApproveMail($owner->email);
            return response()->json(
                ["status" => "ok", "message" => "Postulación aprobada"]
            );
        }
        return response()->json(
            ["status" => "ok", "message" => "Postulación rechazada"],
            422
        );
    }

    public function reject(Request $request)
    {
        $user = Auth::user();
        if ($user->role == "admin") {
            $cpa = ContestApplicationModel::find($request->id);
            $cpaLog = new CpaLog(
                ["status" => "rejected", "cap_id" => $cpa->id]
            );
            $cpaLog->save();
            $cpaLog = new CpaLog(["status" => "draft", "cap_id" => $cpa->id]);
            $cpaLog->save();
            $owner = User::find($cpa->user_id);
            $this->sendRejectEmail($owner->email, $request->comment);
            return response()->json(
                ["status" => "ok", "message" => "Postulación rechazada"]
            );
        }
        return response()->json(
            ["status" => "error", "message" => "Error"],
            422
        );
    }

    public function winner(Request $request)
    {
        $user = Auth::user();
        $cpa = ContestApplicationModel::find($request->id);
        $winner = ContestApplicationModel::where("is_winner", 1)->count();
        if ($user->role == "admin" && $winner == 0) {
            $cpa = ContestApplicationModel::find($request->id);
            $cpa->is_winner = 1;
            $cpa->save();
            return response()->json(
                ["status" => "ok", "message" => "Postulación ganadora"]
            );
        }
        return response()->json(
            ["status" => "error", "message" => "Error"],
            422
        );
    }

    private function sendRejectEmail($email, $comment)
    {
        $mailer = new Mailer();
        $mailer->sendRejectEmail($email, $comment);
    }

    private function sendApproveMail($email)
    {
        $mailer = new Mailer();
        $mailer->sendApproveMail($email);
    }


}
