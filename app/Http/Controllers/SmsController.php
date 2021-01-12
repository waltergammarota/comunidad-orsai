<?php


namespace App\Http\Controllers;

use App\Databases\InfoBipModel;
use App\Databases\PaisModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SmsController extends Controller
{

    public function index()
    {
        $data = $this->getUserData();
        if ($data['whatsapp'] != "") {
            return view('sms.validacion_perfil', $data);
        }
        return Redirect::to('editar-telefono');
    }

    public function edit_phone(Request $request)
    {
        $data = $this->getUserData();
        $data['countries'] = PaisModel::orderBy('nombre', 'asc')->get();
        return view('sms.validacion_sms', $data);
    }

    public function verify_unique_phone(Request $request)
    {
        $request->validate([
            "prefijo" => 'required',
            "telefono" => 'required'
        ]);
        $qty = User::where('whatsapp', $request->telefono)->where('prefijo', $request->prefijo)->whereNotNull('phone_verified_at')->count();
        if ($qty == 0) {
            return response()->json(["status" => "none"]);
        } else {
            return response()->json(["status" => "not unique"], 400);
        }
    }

    public function add_phone(Request $request)
    {
        $request->validate([
            'prefijo' => 'required|numeric',
            'telefono' => 'required|numeric'
        ]);
        $user = Auth::user();
        $user->prefijo = $request->prefijo;
        $user->whatsapp = $request->telefono;
        $user->save();
        $smsSender = new InfoBipModel();
        $smsSender->verifyPhone($user->getPhone(), $user->id);
        return Redirect::to('validacion-codigo');
    }

    public function validate_code(Request $request)
    {
        $data = $this->getUserData();
        if ($request->_token != "" && $request->enviar_codigo == 1) {
            $this->getNewCode($request);
        }
        return view('sms.codigo_seguridad', $data);
    }

    public function verify_phone(Request $request)
    {
        $request->validate([
            "code" => 'required'
        ]);
        $user = Auth::user();
        $smsSender = new InfoBipModel();
        $response = $smsSender->verifyCode($request->code, $user->id);
        if ($response) {
            return response()->json(['status' => "verified"]);
        }
        return response()->json(['status' => 'invalid code'], 400);
    }

    public function getNewCode(Request $request)
    {
        $user = Auth::user();
        $smsSender = new InfoBipModel();
        $code = $smsSender->verifyPhone($user->getPhone(), $user->id);
    }

    public function resend_code(Request $request)
    {
        $this->getNewCode($request);
        return response()->json(['status' => 'new code sent']);
    }

}
