<?php

namespace App\Http\Controllers\Registration;

use App\Classes\UserException;
use App\Databases\PaisModel;
use App\UseCases\UserActivation;
use App\UseCases\UserRegistration;
use App\Notifications\GenericNotification;
use App\User;
use DB;
use App\Utils\Mailer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Notification;
use GuzzleHttp\Client;
class RegistrationController extends Controller
{
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
        $this->baseUri = config('services.api.base_uri');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws UserException
     */
    public function register(Request $request)
    {
        $userData = $this->mapRequestToUserData($request);
        $data = $this->createUser($userData);
        return response()->json($data, 200);
    }


    /**
     * @param [] $request
     * @return UserRegistration
     * @throws UserException
     */
    private function createUserRegistrationUseCase($userData): UserRegistration
    {
        $userRepository = new UserRepository();
        $mailer = new Mailer();
        return new UserRegistration(
            $userData,
            $userRepository,
            $mailer
        );
    }

    public function registerWeb(Request $request)
    {
        $request->validate(
            [
                'nombre' => 'required|max:255|min:2',
                'apellido' => 'required|max:255|min:2',
                'email' => 'email|required|max:255|unique:users',
                'pais' => 'required|max:255|min:1',
                'usuario' => 'required|max:255|unique:users,username',
                'password' => 'required|max:64|min:8',
                'confirmPassword' => 'required|same:password|max:64|min:8',
                'terminos' => 'required'
            ]
        );

        $userData = [
          'name' => $request->nombre,
          'lastName' => $request->apellido,
          'nickName' => strtolower($request->nombre).random_int(100, 9999),
          'email' => $request->email,
          'country' => $request->pais,
          'password' => $request->password,
          'splice' => 1,
          'apiId' => 0,
        ];

        $userDataApi = [
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'clave1' => $request->password,
            'clave2' => $request->confirmPassword,
        ];

        
       // $minScore = env('CAPTCHA_MIN_SCORE', 0.9);
        //$status = $this->checkReCaptcha($request);

        /*if ($status->success == false || $status->score < $minScore) {
            return Redirect::back()->withErrors([
                "registrarse" => "Credenciales no válidas"
            ])->withInput();
        }*/
        if($request->complete !== null) {

          $this->createUserRegistrationUseCase($userData);
            $data = $this->createUser($userData);
            $request->session()->flash('alert', 'activation_email');
            $usertoLogin = User::find($data['id']);
            Auth::login($usertoLogin);
            $route = session('redirectLink');
            if ($route) {
                session(['redirectLink' => false]);
                return Redirect::to($route);
            }
  
            return redirect('/panel');

        } else {


          $client = new Client([
            'base_uri' => $this->baseUri,
          ]);
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
            
            $this->createUserRegistrationUseCase($userData);
            $data = $this->createUser($userData);
            $request->session()->flash('alert', 'activation_email');
            $usertoLogin = User::find($data['id']);
            $user = User::where('email', '=', $data['email'])->first();
            $affectedRows = DB::table('users')->where(['id'=>$user->id])->update(array('apiId'=>json_decode($response->getBody(), true)['id']));
            Auth::login($usertoLogin);
            $route = session('redirectLink');
            if ($route) {
                session(['redirectLink' => false]);
                return Redirect::to($route);
            }
  
            return redirect('/panel');
          }
        }

    }

    /**
     * @param array $userData
     * @return array
     * @throws UserException
     */
    private function createUser(array $userData): array
    {
        $userRegistration = $this->createUserRegistrationUseCase($userData);
        $data = $userRegistration->execute();
        return $data;
    }

    public function activar(Request $request)
    {
        $token = $request->route('token');
        $interactor = new UserActivation($token, new UserRepository());
        $output = $interactor->execute();
        if ($output) {
            $userToLogin = User::find($output['userId']);
            Auth::login($userToLogin);
            $this->sendNotification(Auth::user());
            return Redirect::to('panel');
        }
        return Redirect::to('ingresar');
    }

    public function reenviar(Request $request)
    {
        $request->validate(
            [
                'email' => 'email|required|max:255',
            ]
        );
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if ($user) {
            $user->email_verified_at = null;
            $user->save();
            $mailer = new Mailer();
            $token = md5($user->id . $user->email . $user->created_at);
            $mailer->sendActivationEmail(
                $user->email,
                $user->name,
                $user->lastname,
                $token
            );
            $request->session()->flash('alert', 'activation_email');
            $data = $this->getUserData();
            $data["email"] = $user->email;

            return view('reenviar-mail-activacion', $data);
        }
    }


    public function registrarse(Request $request)
    {
        $apiMsg = session('msg');
        
        if(session('email')) {
          $email = session('email');
          $password = session('pass');
          $nombre = session('nombre');
          $apellido = session('apellido');

          if (!Auth::check()) {
            $data = $this->getUserData();
            $data['paises'] = $this->getPaises();
            $data['email'] = $email;
            $data['pass'] = $password;
            $data['nombre'] = $nombre;
            $data['apellido'] = $apellido;

            return view('2021-completar-registro', $data);
          } else {
              return Redirect::to("panel");
          }
        } else {
          if (!Auth::check()) {
              $data = $this->getUserData();
              $data['paises'] = $this->getPaises();
              $data['msg'] = $apiMsg;
  
              return view('2021-registrarse', $data);
          } else {
              return Redirect::to("panel");
          }
        }
    }

    private function getPaises()
    {
        $paises = PaisModel::orderBy('peso', 'desc')->orderBy('nombre', 'asc')->get()->toArray();
        return array_map(function ($item) {
            $row = new \stdClass();
            $row->iso = $item['iso'];
            $row->nombre = utf8_encode($item['nombre']);
            return $row;
        }, $paises);
    }

    private function sendNotification($user)
    {
        $href = url('perfil');

        $notification = new \stdClass();
        $notification->subject = "Activación de cuenta";
        $notification->title = "¡Bien hecho!";
        $notification->description = "<p>Ya activaste tu cuenta, ahora completá tu perfil para empezar a jugar. <a href='" . $href . "'>Hacelo desde acá</a></p>";
        $notification->button_url = '';
        $notification->button_text = '';
        $notification->user_id = 1;
        $notification->deliver_time = Carbon::now();
        $notification->id = 0;

        Notification::send($user, new GenericNotification($notification));
    }
}
