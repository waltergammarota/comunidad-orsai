<?php


namespace App\UseCases;

use App\Classes\User;
use App\Classes\UserException;
use App\Classes\UserNotFoundException;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use App\Utils\Mailer;

/**
 * Class UserActivation
 * @package App\useCases
 * @property UserRepository $userRepository
 */
class UserActivation extends GenericUseCase
{
    private $userRepository;
    private $token;
    private $badParametersMessage = "Bad parameters";
    private $badParametersCode = 20002;
    private $userIsAlreadyRegisteredCode = 20000;
    private $userIsAlreadyRegisteredMessage = "User is already activated";

    public function __construct($token, $userRepository)
    {
        $this->token = $token;
        $this->welcomeAmount = 100;
        $this->userRepository = $userRepository;
    }

    public function execute()
    {
        $user = $this->userRepository->findBytoken($this->token);
        if ($user) {
            $user->activateUser();
            $savedUser = $this->userRepository->save($user);
            $sendWelcomePoints = new WelcomePoints(
                $savedUser,
                $this->userRepository,
                new TransactionRepository($this->userRepository),
                new Mailer()
            );
            if($sendWelcomePoints->execute()){
                return $this->present($savedUser->getId());
            }
            return false;
        }
        throw new UserNotFoundException();
    }

    private function present($id)
    {
        return [
            "status" => "OK",
            "message" => "User {$id} was activated",
            "userId" => $id
        ];
    }


}
