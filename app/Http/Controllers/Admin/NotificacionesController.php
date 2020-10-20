<?php

namespace App\Http\Controllers\Admin;

use App\Databases\NotificacionModel;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class NotificacionesController extends Controller
{
    public function index()
    {
        $data['title'] = "Notificaciones";
        return view('admin.notificaciones', $data);
    }

    public function edit(Request $request)
    {
        $id = $request->route('id');
        $notificacion = NotificacionModel::find($id);
        return view('admin.notificacion-form', compact('notificacion'));
    }

    public function notificaciones_json(Request $request)
    {
        $data = [
            'draw' => $request->query('draw'),
            "recordsTotal" => NotificacionModel::count(),
            "recordsFiltered" => NotificacionModel::count(),
            'data' => NotificacionModel::select('id', 'subject', 'title', 'deliver_time', 'database', 'mail')->get()
        ];
        return response()->json($data);
    }

    public function create(Request $request)
    {
        $notificacion = null;
        $now = Carbon::now()->format('Y-m-d');
        $timeNow = Carbon::now('America/Argentina/Buenos_Aires')->format('H:i');
        return view('admin.notificacion-form', compact('notificacion', 'now', 'timeNow'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "subject" => "required",
            "title" => "required",
            "description" => "required",
            "deliver_date" => "required|date",
            "deliver_hour" => "required|date_format:H:i",
            "users" => "required",
            "template" => "required",
        ]);
        $datos = [
            "subject" => $request->subject,
            "title" => $request->title,
            "description" => $request->description,
            "deliver_time" => "{$request->deliver_date} {$request->deliver_hour}:00",
            "button_url" => $request->button_url,
            "button_text" => $request->button_text,
            "mail" => $request->mail ? $request->mail : 0,
            "database" => $request->database ? $request->database : 0,
            "users" => json_encode($request->users),
            "template" => $request->template,
            "user_id" => Auth::user()->id,
            'status' => 0,
        ];
        $notificacion = new NotificacionModel($datos);
        $notificacion->save();
        return Redirect::to('admin/notificaciones');
    }


    public function update(Request $request)
    {
        $request->validate([
            "id" => "required",
            "subject" => "required",
            "title" => "required",
            "description" => "required",
            "deliver_date" => "required|date",
            "deliver_hour" => "required|date_format:H:i",
            "users" => "required",
            "template" => "required",
        ]);

        $datos = [
            "subject" => $request->subject,
            "title" => $request->title,
            "description" => $request->description,
            "deliver_time" => "{$request->deliver_date} {$request->deliver_hour}:00",
            "button_url" => $request->button_url,
            "button_text" => $request->button_text,
            "mail" => $request->mail ? $request->mail : 0,
            "database" => $request->database ? $request->database : 0,
            "users" => json_encode($request->users),
            "template" => $request->template,
            "user_id" => Auth::user()->id,
            'status' => 0,
        ];

        $notificacion = NotificacionModel::find($request->id);
        if ($notificacion->status == 0) {
            $notificacion->fill($datos);
            $notificacion->save();
            return Redirect::to('admin/notificaciones');
        }
        return Redirect::back()->withErrors([
                "notificacion" => "Notificación ya fue ejecutada, no se puede modificar"
            ])->withInput();
    }

    public function deleteImage(Request $request)
    {
        $imageId = $request->key;
        DB::table('contenido_files')->where('id', $imageId)->delete();
        echo json_encode(["message" => $imageId]);
    }

    public function eliminar(Request $request)
    {
        $notificacionId = $request->id;
        $notificacion = NotificacionModel::find($notificacionId);

        if ($notificacion != null && $notificacion->status == 0) {
            NotificacionModel::destroy($notificacionId);
            return response()->json(["success" => true]);
        }

        if ($notificacion != null && $notificacion->status > 0) {
            NotificacionModel::destroy($notificacionId);
            DB::table('notifications')->where('data->id',$notificacionId)->delete();
            return response()->json(['success'=> true]);
        }
        return response()->json(["success" => false]);
    }
}
