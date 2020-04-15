<?php


namespace App\UseCases;

use App\Classes\User;
use App\Classes\UserException;
use App\Repositories\UserRepository;
use App\Utils\Mailer;

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
            $token = md5($updatedUser->getId().$updatedUser->getEmail().$updatedUser->getCreatedAt());
            $this->mailer->sendActivationEmail($updatedUser->getEmail(), $token);
            return $this->present($updatedUser);
        }
        throw new UserException(
            $this->badParametersMessage,
            $this->badParametersCode
        );
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
