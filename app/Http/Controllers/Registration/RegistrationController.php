<?php

namespace App\Http\Controllers\Registration;

use App\Classes\UserException;
use App\UseCases\UserRegistration;
use App\User;
use App\Utils\Mailer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

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

    public function registerWeb(Request $request) {
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
        return redirect('/');

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
}
