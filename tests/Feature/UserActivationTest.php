<?php

use App\Classes\UserException;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Classes\User;
use App\Utils\Mailer;

/**
 * Class UserActivationTest
 * @property TransactionRepository $transactionRepository
 * @property UserRepository $userRepository
 */
class UserActivationTest extends TestCase
{

    private $userFrom;
    private $userTo;
    private $transactionRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository = new UserRepository();
        $this->transactionRepository = new TransactionRepository(
            $this->userRepository
        );
        $this->transactionRepository->deleteAll();
        $this->userRepository->deleteAllUsers();
        $this->userFrom = $this->createUser();
        $this->userTo = $this->createUser();
    }

    private function createUser()
    {
        $userModel = factory(\App\User::class)->make();
        $userModel->role = "user";
        $user = $this->userRepository->mapDBUserPropsToUser($userModel);
        $savedUser = $this->userRepository->save($user);
        $userId = $savedUser->getId();
        return $this->userRepository->find($userId);
    }


    public function testActivateUser()
    {
        $parameters = $this->userTo->getId() . $this->userTo->getEmail(
            ) . $this->userTo->getCreatedAt();
        $token = md5($parameters);
        $activateUser = new \App\UseCases\UserActivation(
            $token,
            $this->userRepository
        );
        $this->assertTrue(
            $activateUser->execute()['userId'] == $this->userTo->getId()
        );
    }


}




