<?php

namespace App\Http\Controllers\Registration;

use App\Classes\UserException;
use App\Databases\PaisModel;
use App\UseCases\UserActivation;
use App\UseCases\UserRegistration;
use App\User;
use App\Utils\Mailer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RegistrationController extends Controller
{
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
                'nombre' => 'required|max:255|min:1',
                'apellido' => 'required|max:255|min:1',
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
            'nickName' => $request->usuario,
            'email' => $request->email,
            'country' => $request->pais,
            'password' => $request->password,
        ];
        $this->createUserRegistrationUseCase($userData);
        $data = $this->createUser($userData);
        $request->session()->flash('alert', 'activation_email');
        $usertoLogin = User::find($data['id']);
        Auth::login($usertoLogin);
        return redirect('/panel');
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
            $data = ["email" => $user->email];
            return view('reenviar-mail-activacion', $data);
        }
    }


    public function registrarse(Request $request) {
        $data = $this->getUserData();
        $data['paises'] = PaisModel::orderBy('peso','desc')->orderBy('nombre','asc')->get();
        return view('registrarse', $data);
    }
}
