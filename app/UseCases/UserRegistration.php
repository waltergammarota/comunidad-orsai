<?php


namespace App\UseCases;

use App\Classes\User;
use App\Classes\UserException;
use App\Databases\NotificacionModel;
use App\Databases\PreferenciasModel;
use App\Notifications\GenericNotification;
use App\Repositories\UserRepository;
use App\Utils\Mailer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

/**
 * Class UserRegistration
 * @package App\useCases
 * @property UserRepository $userRepository
 * @property Mailer $mailer
 */
class UserRegistration extends GenericUseCase
{
    private $user;
    private $userRepository;
    private $mailer;
    private $badParametersMessage = "Bad parameters";
    private $badParametersCode = 10002;
    private $userIsAlreadyRegisteredCode = 10000;
    private $userIsAlreadyRegisteredMessage = "User is already registered";

    public function __construct($userData, $userRepository, $mailer)
    {
        $this->user = new User();
        if (is_array($userData) && count($userData) > 0) {
            $this->saveUserData($userData);
            $this->userRepository = $userRepository;
            $this->mailer = $mailer;
        } else {
            throw new UserException(
                $this->badParametersMessage,
                $this->badParametersCode
            );
        }
    }

    public function execute()
    {
        $userIsRegistered = $this->checkUserIsRegistered(
            $this->user->getEmail()
        );
        if (!$userIsRegistered) {
            return $this->registerUser();
        }
        throw new  UserException(
            $this->userIsAlreadyRegisteredMessage,
            $this->userIsAlreadyRegisteredCode
        );
    }

    private function present(User $user)
    {
        return ["id" => $user->getId()];
    }

    private function checkUserIsRegistered($email)
    {
        return $this->userRepository->checkIfUserIsRegistered($email);
    }

    /**
     * @return array
     * @throws UserException
     */
    private function registerUser(): array
    {
        $isUserDataComplete = $this->user->isRequiredDataComplete();
        $this->user->setRole('user');
        if ($isUserDataComplete) {
            $updatedUser = $this->userRepository->save($this->user);
            $token = md5($updatedUser->getId() . $updatedUser->getEmail() . $updatedUser->getCreatedAt());
            $this->mailer->sendActivationEmail($updatedUser->getEmail(), $updatedUser->getName(), $updatedUser->getLastName(), $token);
            $this->setDefaultPreferences($updatedUser);
            //$this->sendWelcomeNotification($updatedUser->getId());
            return $this->present($updatedUser);
        }
        throw new UserException(
            $this->badParametersMessage,
            $this->badParametersCode
        );
    }

    private function setDefaultPreferences($user)
    {
        $hasPreferencias = PreferenciasModel::where('user_id', $user->getId())->count();
        if($hasPreferencias == 0) {
            $preferencia = new PreferenciasModel([
                "plataforma" => 1,
                "correo" => 1,
                "idioma" => "Español",
                "moneda" => "Peso Argentino (ARS)",
                "pago" => "Mercado Pago Argentina",
                "zona" => "America/Argentina/Buenos_Aires",
            ]);
            $preferencia->user_id = $user->getId();
            $preferencia->save();
        }
    }

    private function sendWelcomeNotification($userId)
    {
        $user = \App\User::find($userId);
        $notification = new NotificacionModel([
            "subject" => "Bienvenido a Comunidad Orsai",
            "title" => "Bienvenido a Comunidad Orsai",
            "description" => "Hola {$user->name} {$user->lastName}, bienvenido a esta gran comunidad",
            "deliver_time" => Carbon::now(),
            "button_url" => "",
            "button_text" => "",
            "database" => 1,
            "users" => json_encode([$user->id]),
            "template" => "default",
            "status" => 0,
            "user_id" => 1
        ]);
        Notification::send($user, new GenericNotification($notification));

    }

    /**
     * @param $userData
     * @throws UserException
     */
    private function saveUserData($userData): void
    {
        $this->user->setName($userData["name"]);
        $this->user->setLastName($userData["lastName"]);
        $this->user->setUserName($userData["nickName"]);
        $this->user->setCountry($userData["country"]);
        $this->user->setEmail($userData["email"]);
        $this->user->setPassword($userData["password"]);
    }
}
