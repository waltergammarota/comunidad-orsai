<?php


namespace App\Http\Controllers;

use App\Databases\AnswerModel;
use App\Databases\ContestApplicationModel;
use App\Databases\ContestModel;
use App\Databases\CpaChapterModel;
use App\Databases\CpaLog;
use App\Databases\RondaModel;
use App\Databases\Transaction;
use App\Databases\VotesModel;
use App\UseCases\ContestApplication\GetContestApplicationById;
use App\UseCases\ContestApplication\VoteAContestApplication;
use App\User;
use App\Utils\Mailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PropuestaController extends Controller
{
    public function show(Request $request)
    {
        $postulacionId = $request->route('id');
        $cpa = ContestApplicationModel::find($postulacionId);
        $user = Auth::user();
        if ($cpa && ($user->id == $cpa->user_id || $user->role == "admin")) {
            $data = $this->getUserData();
            $postulacion = $cpa;
            $contest = $cpa->contest()->first();
            $data['postulacion'] = $postulacion;
            $data['concurso'] = $contest;
            $data['hasImage'] = false;
            $data['hasPdf'] = false;
            $data['form'] = $contest->form()->first();
            $data['bases'] = $contest->getBases();
            $data['answers'] = AnswerModel::where('cap_id', $postulacion->id)->get();
            $data['buttons'] = false;
            if ($postulacion->getCurrentStatus() == "draft") {
                $data['buttons'] = true;
            }
            return view('concursos.concurso-cuento', $data);
        }
        abort(404);

    }

    public function show_detalle(Request $request)
    {
        $propuestaId = $request->route('id');
        $propuesta = $this->findPropuesta($propuestaId);
        $user = Auth::user();
        if ($propuesta['current_status'] != "approved" && $user->role != "admin" && $propuesta['user_id'] != $user->id) {
            return Redirect::to('panel');
        }
        $this->addView($propuestaId, $request);
        $data = $this->getUserData();
        $data['propuesta'] = $propuesta;
        $data['user_avatar'] = User::find($propuesta['owner']['id'])->avatar()->first();
        $data['txs'] = $this->votes($propuestaId);
        $contest = ContestModel::find($propuesta['contest_id']);
        $data['concurso'] = $contest;
        $data['capitulos'] = CpaChapterModel::getChapters($propuestaId);
        $data['used'] = Transaction::where(
            [
                "cap_id" => $propuestaId,
                "from" => $user->id
            ]
        )->sum('amount');
        $data['logo'] = $data['concurso']->logo();
        $data['canVote'] = $contest->hasVotes();
        return view('postulacion.detalle', $data);

    }

    private function hasVotingEnded($contestId = 1)
    {
        $contest = ContestModel::find($contestId);
        return $contest->votes_end_date < now();
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
        )->get();
        $data = [];
        foreach ($txs as $tx) {
            $user = $tx->getFromUser()->first();
            $avatar = $user->avatar()->first();
            $row = new \stdClass();
            $row->id = $user->id;
            $row->userName = $user->userName;
            $row->avatar = $avatar ? 'storage/images/' . $avatar->name . "." . $avatar->extension : 'img/participantes/participante.jpg';
            $row->amount = $tx->amount;
            $data[] = $row;
        }
        return $data;
    }

    public function votar(Request $request)
    {
        $user = Auth::user();
        $amount = $request->amount;
        $rondaOrder = $request->rondaOrder;
        if ($user->getBalance() < $amount) {
            return response()->json(["status" => "error", "msg" => "No te alcanzan las fichas", "error" => 100], 400);
        }
        $cpa = ContestApplicationModel::find($request->cap_id);
        $contest = $cpa->contest()->first();
        if (!$contest->hasVotes()) {
            return response()->json(["status" => "error", "msg" => "No iniciaron las votaciones", "error" => 110], 400);
        }
        $ronda = RondaModel::getRonda($cpa->contest_id, $rondaOrder);
        $input = $ronda->inputs->first();
        $answer = AnswerModel::getAnswer($cpa->contest_id, $input->id, $cpa->id);
        $hasBeenVoted = VotesModel::hasBeenVoted($answer->id, $user->id, $cpa->id, $rondaOrder, $ronda->cost);
        $previousVotes = VotesModel::getVotesCount($contest->id, $user->id, $rondaOrder, $cpa->id);
        if ($hasBeenVoted) {
            return response()->json(["status" => "error", "msg" => "Ya votaste", "error" => 120], 400);
        }
        if ($amount < $ronda->cost && $rondaOrder < 3) {
            return response()->json(["status" => "error", "msg" => "El monto es menor al costo de la ronda", "error" => 130], 400);
        }
//        if ($cpa->user_id != $user->id) {
        if ($user->id) {
            VotesModel::vote([
                'user_id' => $user->id,
                'answer_id' => $answer->id,
                'cap_id' => $cpa->id,
                'form_id' => $contest->form_id,
                'contest_id' => $cpa->contest_id,
                'input_id' => $input->id,
                'amount' => $amount,
                'pool_id' => $contest->pool_id,
                'order' => $rondaOrder,
            ], $ronda->cost, $previousVotes);
            $output = [
                "balance" => $user->getBalance(),
                "cap_id" => VotesModel::getVotesCount($contest->id, $user->id, $ronda->order, $cpa->id),
                "rondas" => VotesModel::getRondasWithVotes($contest, $user->id),
            ];

            return response()->json(["result" => $output]);
        }

        return response()->json(["status" => "error", "msg" => "No puedes votarte a tí mismo", "error" => 130], 400);
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
            ["success" => true, "message" => "Contest application removed"]
        );
    }

    public function approve(Request $request)
    {
        $user = Auth::user();
        if ($user->role == "admin") {
            $cpa = ContestApplicationModel::find($request->id);
            $cpa->approved = 1;
            $cpa->approved_in = now();
            $cpa->approved_by_user = $user->id;
            $cpaLog = new CpaLog(
                ["status" => "approved", "cap_id" => $cpa->id]
            );
            $cpaLog->save();
            $contest = $cpa->contest()->first();
            $cpa->order = ContestApplicationModel::where('contest_id', $contest->id)->where('approved', 1)->count() + 1;
            $cpa->save();
            $owner = User::find($cpa->user_id);
            $this->sendApproveMail($owner->email, $cpa->id);
            $this->sendMailToAdministrator($owner->email, $cpa->id, $owner->name, $owner->lastName);
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
            $cpa->approved = 0;
            $cpa->approved_by_user = null;
            $cpa->approved_in = null;
            $cpa->save();
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
        $winner = ContestApplicationModel::where("is_winner", 1)->where('contest_id', $cpa->contest_id)->count();
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

    private function sendApproveMail($email, $cpaId)
    {
        $mailer = new Mailer();
        $mailer->sendApproveMail($email, $cpaId);
    }

    private function sendMailToAdministrator($email, $cpaId, $name, $lastName)
    {
        $mailer = new Mailer();
        $mailer->sendMailToAdministrator($email, $cpaId, $name, $lastName);
    }
}
