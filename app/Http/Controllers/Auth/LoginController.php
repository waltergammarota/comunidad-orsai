<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use DB;
use App\Utils\Mailer;
use App\Notifications\GenericNotification;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Validator;

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
   * Where to redirect users after login.
   *
   * @var string
   */
  protected $baseUri;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest', ['except' => ['logout']]);

    $this->baseUri = config('services.api.base_uri');
  }

  protected function guard()
  {
    return Auth::guard('web');
  }

  public function authenticate(Request $request)
  {

    $client = new Client([
      'base_uri' => $this->baseUri,
    ]);

    $user = User::where('email', '=', $request->input('email'))->first();
    
    $userExistInComunidad = ($user !== null)?true:false;
    
    $userExistInCine = false;


    $validatedData = $request->validate(
      [
        'email' => 'email|required|max:255',
        'password' => 'required|min:2|max:64',
      ]
    );
    //$status = $this->checkReCaptcha($request);

    //$minScore = env('CAPTCHA_MIN_SCORE', 0.9);
    //if ($status->success == false || $status->score < $minScore) {
    /*    return Redirect::back()->withErrors([
                "login" => "Credenciales no válidas"
            ])->withInput();*/
    //}


    $encodeToken = base64_encode($request->input('email') . ':' . $request->input('password'));
    $pass = $request->input('password');

    $headers = [
      'Authorization' => 'Bearer ' . $encodeToken,
      'Accept'        => 'application/json',
    ];
    try {
      $response = $client->get('usuarios/v1/token', [
        'headers' => $headers
      ]);
    } catch (\GuzzleHttp\Exception\RequestException $e) {
      // Si existe en comunidad y no en cine
      if($userExistInComunidad && !$userExistInCine) {

        $userDataApi = [
          'nombre' => $user->name,
          'apellido' => $user->lastName,
          'email' => $user->email,
          'clave1' => 'asdawedsfsd223FDsfsadfse4323',
          'clave2' => 'asdawedsfsd223FDsfsadfse4323',
        ];

        try {
          $response = $client->post('usuarios/v1/registro', [
            'json' => $userDataApi,
            'headers' => [
              'Content-Type' => 'application/json',
              'Accept'        => 'application/json',
              ]
            ]);      
        } catch (\GuzzleHttp\Exception\RequestException $e) {
          return redirect('registrarse')->with([
            'msg' => json_decode($e->getResponse()->getBody()->getContents(), true)['error'],
          ]);
        }

        if($response->getStatusCode() === 200 && json_decode($response->getBody(),true)['token']) {
          try {
            $response = $client->post('usuarios/v1/emailClave', [
              'json' => $request->only('email'),
              'headers' => [
                'Content-Type' => 'application/json',
                'Accept'        => 'application/json',
              ]
            ]);
          } catch (\GuzzleHttp\Exception\RequestException $e) {
            return redirect('registrarse')->with([
              'msg' => json_decode($e->getResponse()->getBody()->getContents(), true)['error'],
            ]);
          }
      
          if ($response->getStatusCode() === 200 && json_decode($response->getBody(), true)['mensaje']) {
            return view('2021-reset-password-cine');
          }
        }
      }
      
      return redirect('ingresar')->with([
        'msg' => json_decode($e->getResponse()->getBody()->getContents(), true)['error'],
      ]);
    }


    if ($response->getStatusCode() === 200 && json_decode($response->getBody(), true)['token']) {
      $name = json_decode($response->getBody(), true)['nombre'];
      $surname = json_decode($response->getBody(), true)['apellido'];
      $userExistInCine = true;
      

      $credentials = $request->only('email', 'password');

      // Si existe en ambos lados pero no esta empalmado
      if($userExistInComunidad && $userExistInCine && $user->splice === 0) {
        $user->update(array('splice' => 1));
        $affectedRows = DB::table('users')->where(['id'=>$user->id])->update(array('splice'=>1));

        Auth::loginUsingId($user->id);
        return Redirect::to('novedades');
      }
      
      // Si no existe en comunidad y existe en cine
      if(!$userExistInComunidad && $userExistInCine) {
        return redirect('registrarse')->with([
          'email' => $request->input('email'),
          'pass' => $pass,
          'nombre' => $name,
          'apellido' => $surname,
        ]);
      }

      // Si existe en comunidad y existe en cine lo logueo
      if($userExistInComunidad && $userExistInCine && $user->splice === 1) {
        Auth::loginUsingId($user->id);
        return Redirect::to('novedades');
      }

      /*if ($this->guard()->attempt($credentials)) {

              if (Auth::user()->email_verified_at && Auth::user()->blocked == 0) {
                  $route = session('redirectLink');
                  if ($route) {
                      session(['redirectLink' => false]);
                      return Redirect::to($route);
                  }
  
                  if (Auth::user()->phone_verified_at == null) {
                      $this->sendValidateNotification(Auth::user());
                  }
  
                  return Redirect::to('novedades');
              }
              if (Auth::user()->blocked != 0) {
                  session()->forget('last_visited');
                  //Auth::logout();
                  return Redirect::to('ingresar');
              }
              session()->forget('last_visited');
              //Auth::logout();
              return Redirect::to('reenviar-mail');
          }*/
    }

    /*return Redirect::back()->withErrors(
            [
                "login" => "Credenciales no válidas"
            ]
        )->withInput();*/
  }

  public function logout()
  {
    session()->forget('last_visited');
    Auth::logout();
    return redirect('/ingresar');
  }

  public function index()
  {
    return view('2021-login');
  }

  public function resetPassword(Request $request)
  {

    $request->validate(
      [
        'email' => 'required|email'
      ]
    );
    $client = new Client([
      'base_uri' => $this->baseUri,
    ]);

    try {
      $response = $client->post('usuarios/v1/emailClave', [
        'json' => $request->only('email'),
        'headers' => [
          'Content-Type' => 'application/json',
          'Accept'        => 'application/json',
        ]
      ]);
    } catch (\GuzzleHttp\Exception\RequestException $e) {
      return redirect('registrarse')->with([
        'msg' => json_decode($e->getResponse()->getBody()->getContents(), true)['error'],
      ]);
    }

    if ($response->getStatusCode() === 200 && json_decode($response->getBody(), true)['mensaje']) {
      return redirect('restablecer-clave')->with([
        'msg' => json_decode($response->getBody(), true)['mensaje'],
        //dd(json_decode($response->getBody(), true))
      ]);
    }

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
        "email" => "El email no fue encontrado"
      ]
    )->withInput();
  }

  public function resetpasswordform(Request $request)
  {
    $token = $request->route('token');
    if ($token) {
      //$user = User::where('remember_token', $token)->first();
      /*if ($user === null) {
        return Redirect::to('restablecer-clave')->withErrors(['token' => 'Token expirado o inválido']);
      }*/
      
      /*$user->password = Str::random(8);
      $user->save();*/
    }
    $data['token'] = $token;
    return view('2021-reset-password', $data);
  }

  public function createNewPassword(Request $request)
  {
    $request->validate(
      [
        'password' => 'required|max:64|min:8',
        'confirmPassword' => 'required|same:password|max:64|min:8',
      ]
    );

    $token = $request->only('token')['token'];
    $clave1 = $request->only('password')['password'];
    $clave2 = $request->only('confirmPassword')['confirmPassword'];

    $userData = [
      'token' => $token,
      'clave1' => $clave1,
      'clave2' => $clave2,
    ];


    $client = new Client([
      'base_uri' => $this->baseUri,
    ]);

    try {
      $response = $client->put('usuarios/v1/nuevaClave', [
        'json' => $userData,
        'headers' => [
          'Content-Type' => 'application/json',
          'Accept'        => 'application/json',
        ]
      ]);
    } catch (\GuzzleHttp\Exception\RequestException $e) {
      return redirect('restablecer-clave')->with([
        'msg' => json_decode($e->getResponse()->getBody()->getContents(), true)['error'],
      ]);
    }

    if ($response->getStatusCode() === 200) {
      return redirect('ingresar');
    }
    /*if ($user) {
      $user->password = password_hash($request->password, PASSWORD_DEFAULT);
      $user->remember_token = "";
      $user->save();
      $request->session()->flash('alert', 'password_reset_success');
      $data['token'] = $request->token;
      return view('2021-reset-password', $data);
    }
    return Redirect::back()->withErrors(
      [
        "token" => "Token inválido"
      ]
    )->withInput();*/
  }

  private function sendValidateNotification($user)
  {
    $href = url('validacion-usuario');

    $notification = new \stdClass();
    $notification->subject = "Validación de perfil";
    $notification->title = "¿Qué estás esperando?";
    $notification->description = "<p>Validá tu perfil para acelerar el juego. <a href='" . $href . "'>Hacelo desde acá</a></p>";
    $notification->button_url = '';
    $notification->button_text = '';
    $notification->user_id = 1;
    $notification->deliver_time = Carbon::now();
    $notification->id = 0;

    Notification::send($user, new GenericNotification($notification));
  }
}
