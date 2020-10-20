<?php


namespace App\Http\Controllers;

use App\Databases\PreferenciasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class NotificacionesController extends Controller
{
    public function configurar_notificaciones()
    {
        $data = $this->getUserData();
        $data['preferencias'] = PreferenciasModel::where('user_id', $data['session_user_id'])->first();
        return View('configuracion-notificaciones', $data);
    }

    public function guardar_configuracion_notificaciones(Request $request) {
        $user = Auth::user();
        $preferencia = PreferenciasModel::firstOrNew(array('user_id' => $user->id));
        $preferencia->correo =  $request->correo? 1: 0;
        $preferencia->user_id = $user->id;
        $preferencia->plataforma = $request->plataforma? 1: 0;
        $preferencia->save();

        return Redirect::to('configuracion-notificaciones');
    }

}
