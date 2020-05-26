<?php


namespace App\Repositories;

use App\Classes\User;
use App\Databases\Transaction;
use Illuminate\Support\Facades\DB;


interface TransactionRepositoryInterface
{
    public function save(\App\Classes\Transaction $transaction);

}

// TODO add UserModel to construct method

class TransactionRepository implements TransactionRepositoryInterface
{

    /**
     * TransactionRepository constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function save(\App\Classes\Transaction $tx)
    {
        $txData = $this->mapTransactionPropsToTransactionDB($tx);
        $transaction = new Transaction($txData);
        $transaction->save();
        $savedTransaction = clone $tx;
        $savedTransaction->setCreatedAt($transaction->created_at);
        $savedTransaction->setUpdatedAt($transaction->update_at);
        $savedTransaction->setId($transaction->id);
        return $savedTransaction;
    }

    private function mapDBTransactionPropsToTransaction(
        $transactionData,
        $fromUserData,
        $toUserData
    ) {
        $fromUser = $this->userRepository->mapDBUserPropsToUser($fromUserData);
        $toUser = $this->userRepository->mapDBUserPropsToUser($toUserData);
        $newTx = new \App\Classes\Transaction(
            $fromUser,
            $toUser,
            $transactionData['amount'],
            $transactionData['type'],
            $transactionData['data']
        );
        $newTx->setId($transactionData->id);
        $newTx->setCreatedAt($transactionData->created_at);
        $newTx->setUpdatedAt($transactionData->updated_at);
        return $newTx;
    }

    private function mapTransactionPropsToTransactionDB(
        \App\Classes\Transaction $transaction
    ) {
        return [
            "from" => $transaction->getFrom()->getId(),
            "to" => $transaction->getTo()->getId(),
            "type" => $transaction->getType(),
            "amount" => $transaction->getAmount(),
            "data" => $transaction->getData()
        ];
    }

    public function find($id)
    {
        $transactionData = Transaction::find($id);
        $fromUserData = $transactionData->getFromUser;
        $toUserData = $transactionData->getToUser;
        return $this->mapDBTransactionPropsToTransaction(
            $transactionData,
            $fromUserData,
            $toUserData
        );
    }

    public function deleteAll()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('transactions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function findWelcomeTransactions(User $user)
    {
        $welcomeTag = "welcome";
        return Transaction::where(
            [

                "to" => $user->getId(),
                "data" => $welcomeTag
            ]
        )->count();
    }


    public function getBalance(User $user)
    {
        $ingreso = Transaction::where(["to" => $user->getId()])->sum("amount");
        $egreso = Transaction::where(["from" => $user->getId()])->sum("amount");
        return $ingreso - $egreso;
    }

    public function getCantidadTxs(User $user)
    {
        return DB::table('transactions')->where('from', $user->getId())->count(
        );
    }

    public function getTotalSupply()
    {
        $totalVotes = DB::table('transactions')->where('type', 'TRANSFER')->sum(
            'amount'
        );

        return $totalVotes;
    }
}
