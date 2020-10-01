<?php

namespace Tests\Unit;

use App\Repositories\UserRepository;
use Tests\TestCase;
use App\Classes\Transaction;
use App\Repositories\TransactionRepository;
use App\User;

class TransactionRepositoryTest extends TestCase
{

    private $userFrom;
    private $userTo;
    private $userRepository;
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
        $userModel = factory(User::class)->make();
        $user = $this->userRepository->mapDBUserPropsToUser($userModel);
        $savedUser = $this->userRepository->save($user);
        $userId = $savedUser->getId();
        return $this->userRepository->find($userId);
    }

    public function testTransactionCreation()
    {
        $amount = 100;
        $type = "MINT";
        $transaction = new Transaction(
            $this->userFrom,
            $this->userTo,
            $amount,
            $type,
            ""
        );
        $tx = $this->transactionRepository->save($transaction);
        $this->assertTrue($tx->getId() > 0);
        $foundTx = $this->transactionRepository->find($tx->getId());
        $this->assertTrue($tx->getId() == $foundTx->getId());
    }

    public function testFindWelcomeTransactions()
    {
        $amount = 100;
        $type = "MINT";
        $welcomeTag = "Fichas de bienvenida";
        $transaction = new Transaction(
            $this->userFrom,
            $this->userTo,
            $amount,
            $type,
            $welcomeTag
        );
        $this->transactionRepository->save($transaction);
        $this->assertTrue($this->transactionRepository->findWelcomeTransactions($this->userTo) > 0);
    }


}
