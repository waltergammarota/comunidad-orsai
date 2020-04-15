<?php

use App\Classes\UserException;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Classes\User;
use App\Utils\Mailer;

/**
 * Class UserRegistrationTest
 * @property TransactionRepository $transactionRepository
 * @property UserRepository $userRepository
 */
class WelcomePointsTest extends TestCase
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
        $user = $this->userRepository->mapDBUserPropsToUser($userModel);
        $savedUser = $this->userRepository->save($user);
        $userId = $savedUser->getId();
        return $this->userRepository->find($userId);
    }


    public function testSendWelcomePoints()
    {
        $this->assertTrue($this->runWelcomePoinst());
    }

    public function testNotSendWelcomePointsToNotActiveUser()
    {
        $sendWelcomePointsUseCase = new \App\UseCases\WelcomePoints($this->userTo, $this->userRepository, $this->transactionRepository, new Mailer());
        $this->assertFalse($sendWelcomePointsUseCase->execute());
    }

    public function testWelcomeTransactionIsCorrect()
    {
        if($this->runWelcomePoinst()) {
            $welcomeTxId = 1;
            $savedTx = $this->transactionRepository->find($welcomeTxId);
            $this->assertTrue($savedTx->getId() == 1);
            $this->assertTrue($savedTx->getAmount() == 100);
            $this->assertTrue($savedTx->getData() == "welcome");
            $this->assertTrue($savedTx->getType() == "MINT");
        }
    }

    private function runWelcomePoinst(): bool
    {
        $this->userTo->setEmailVerifiedAt(now());
        $sendWelcomePointsUseCase = new \App\UseCases\WelcomePoints(
            $this->userTo,
            $this->userRepository,
            $this->transactionRepository,
            new Mailer()
        );
        return $sendWelcomePointsUseCase->execute();
    }
}





