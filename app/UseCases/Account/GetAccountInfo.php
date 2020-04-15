<?php


namespace App\UseCases\Account;

use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use App\UseCases\GenericUseCase;

class GetAccountInfo extends GenericUseCase
{
    private $user;
    private $userRepo;
    private $txRepo;

    public function __construct($userId, UserRepository $userRepo, TransactionRepository $txRepo)
    {
        $this->userRepo = $userRepo;
        $this->txRepo = $txRepo;
        $this->user = $this->userRepo->find($userId);
    }

    public function execute()
    {
        $data = [
            'balance' => $this->txRepo->getBalance($this->user),
            'cantidadTxs' => $this->txRepo->getCantidadTxs($this->user),
            'username' => $this->user->getUserName(),
            'email' => $this->user->getEmail(),
            'name' => $this->user->getName(),
            'lastName' => $this->user->getLastName(),
            'city' => $this->user->getCity(),
            'country' => $this->user->getCountry(),
            'birthDate' => $this->user->getBirthDate(),
            'profesion' => $this->user->getProfession(),
            'description' => $this->user->getDescription(),
            'facebook' => $this->user->getFacebook(),
            'twitter' => $this->user->getTwitter(),
            'instagram' => $this->user->getInstagram(),
        ];
        return $data;
    }
}
