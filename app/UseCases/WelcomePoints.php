<?php


namespace App\UseCases;


use App\Classes\Transaction;
use App\Classes\User;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use App\Utils\Mailer;

/**
 * Class WelcomePoints
 * @package App\UseCases
 * @property UserRepository $userRepository
 * @property TransactionRepository $transactionRepository
 * @property Mailer $mailer
 */
class WelcomePoints extends GenericUseCase
{

    private $user;
    private $amount;
    private $welcomeTag;

    public function __construct(
        User $to,
        UserRepository $userRepository,
        TransactionRepository $transactionRepository,
        Mailer $mailer
    ) {
        $welcomePointsAmount = 750;
        $this->user = $to;
        $this->amount = $welcomePointsAmount;
        $this->userRepository = $userRepository;
        $this->transactionRepository = $transactionRepository;
        $this->mailer = $mailer;
        $this->welcomeTag = "Fichas de Bienvenida";
    }

    public function execute()
    {
        if ($this->checkConditions(
            $this->user
        )) {
            $savedTransaction = $this->sendWelcomePointsToUser();
            $this->mailer->sendWelcomePointsMail(
                $this->user->getEmail(),
                $this->user->getName(),
                $this->user->getLastName(),
                $this->amount
            );
            return true;
        }
        return false;
    }


    private function checkConditions(User $user)
    {
        return $user->hasBeenActivated() && !$this->hasReceivedWelcomePoints(
                $user
            );
    }

    private function hasReceivedWelcomePoints(User $user)
    {
        return $this->transactionRepository->findWelcomeTransactions($user, $this->welcomeTag) > 0;
    }


    /**
     * @return Transaction
     */
    private function sendWelcomePointsToUser(): Transaction
    {
        $from = $this->userRepository->getPoolUser();
        $type = "MINT";
        $transaction = new Transaction(
            $from,
            $this->user,
            $this->amount,
            $type,
            $this->welcomeTag
        );
        $savedTransaction = $this->transactionRepository->save(
            $transaction
        );
        return $savedTransaction;
    }
}
