<?php


namespace App\Http\Controllers;

use App\Databases\PreferenciasModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PreferenciasController extends Controller
{
    public function configurar_preferencias()
    {
        $data = $this->getUserData();
        $data['preferencias'] = PreferenciasModel::where('user_id', $data['session_user_id'])->first();
        $data['idiomas'] = ["Español", "Inglés"];
        $data['monedas'] = ["Pesos", "Dólares Estadounidenses"];
        $data['pagos'] = ["Mercado Pago", "Paypal"];
        $data['zonas'] = timezone_identifiers_list();
        return View('preferencias', $data);
    }

    public function guardar_configuracion_preferencias(Request $request)
    {
        $request->validate([
           "idioma"=> 'required',
           "moneda"=> 'required',
           "pago"=> 'required',
           "zona"=> 'required',
        ]);
        $user = Auth::user();
        $preferencia = PreferenciasModel::firstOrNew(array('user_id' => $user->id));
        $preferencia->idioma = $request->idioma;
        $preferencia->moneda = $request->moneda;
        $preferencia->pago = $request->pago;
        $preferencia->zona = $request->zona;
        $preferencia->user_id = $user->id;
        $preferencia->save();
        echo json_encode(['success'=> true, 'msg'=> 'Preferencias guardadas']);
    }

    public function configurar_privacidad() {
        $data = $this->getUserData();
        return View('privacidad', $data);
    }

    public function desactivar_cuenta() {
        $data = $this->getUserData();
        return View('desactivar-cuenta', $data);
    }

    public function confirmar_desactivar_cuenta() {
        $data = $this->getUserData();
        return View('confirmar-desactivar-cuenta');
    }

    public function borrar_cuenta(Request $request) {
        $request->validate(
            ["confirmar" => "required"]
        );
        if($request->confirmar == "confirmar") {
            $user = Auth::user();
            $user->name = "anónimo";
            $user->lastName = "";
            $user->userName = "anónimo-".uniqid();
            $user->country = "";
            $user->provincia = "";
            $user->city = "";
            $user->birth_date = Carbon::now();
            $user->profesion = "";
            $user->description = "";
            $user->facebook = "";
            $user->whatsapp = "";
            $user->twitter = "";
            $user->instagram = "";
            $user->email = "anonymnous".uniqid()."@gmail.com";
            $user->password = password_hash(uniqid(), PASSWORD_DEFAULT);
            $user->avatar = null;
            $user->blocked = 1;
            $user->save();
            Auth::logout();
            return Redirect::to('cuenta-desactivada');
        }
    }

    public function cuenta_desactivada() {
        return View('cuenta-desactivada');
    }
}
