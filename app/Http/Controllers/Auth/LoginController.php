<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


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
            return Redirect::to('panel');
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

}
