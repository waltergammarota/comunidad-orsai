<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Utils\Mailer;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'perfil';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout']]);
    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    public function authenticate(Request $request)
    {
        $validatedData = $request->validate(
            [
                'email' => 'email|required|max:255',
                'password' => 'required|min:2|max:64',
            ]
        );
        $credentials = $request->only('email', 'password');
        if ($this->guard()->attempt($credentials)) {
            if (Auth::user()->email_verified_at) {
                return Redirect::to('participantes');
            }
            Auth::logout();
            return Redirect::to('reenviar-mail');
        }
        return Redirect::back()->withErrors(
            [
                "login" => "Credenciales no válidas"
            ]
        )->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/ingresar');
    }

    public function index()
    {
        return view('ingresar');
    }

    public function resetPassword(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email'
            ]
        );
        $token = Str::random(60);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->remember_token = $token;
            $user->save();
            $mailer = new Mailer();
            $mailer->sendResetPasswordMail($request->email, $token);
            $request->session()->flash('alert', 'reset_password_email');
            return Redirect::to('restablecer-clave');
        }
        return Redirect::to('restablecer-clave')->withErrors(
            [
                "email" => "Email no encontrado"
            ]
        )->withInput();
    }

    public function resetpasswordform(Request $request)
    {
        $token = $request->route('token');
        if($token) {
            $user = User::where('remember_token', $token)->first();
            $user->password = Str::random(8);
            $user->save();
        }
        $data['token'] = $token;
        return view('reset-password', $data);
    }

    public function createNewPassword(Request $request)
    {
        $request->validate(
            [
                'token' => 'required|max:60|min:60',
                'password' => 'required|max:64|min:8',
                'confirmPassword' => 'required|same:password|max:64|min:8',
            ]
        );
        $user = User::where('remember_token', $request->token)->first();
        if ($user) {
            $user->password = password_hash($request->password, PASSWORD_DEFAULT);
            $user->remember_token = "";
            $user->save();
            $request->session()->flash('alert', 'password_reset_success');
            return Redirect::to('ingresar');
        }
        return Redirect::back()->withErrors(
            [
                "token" => "Token inválido"
            ]
        )->withInput();

    }

}
