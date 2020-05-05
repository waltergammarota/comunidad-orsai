<?php


namespace App\UseCases\Account;

use App\Databases\ContestApplicationModel;
use App\Databases\CpaLog;
use App\Repositories\ContestApplicationRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use App\UseCases\GenericUseCase;
use Illuminate\Support\Facades\Auth;

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
        $this->cpaRepo = new ContestApplicationRepository(new ContestApplicationModel(),$this->userRepo);
    }

    public function execute()
    {
        $user = Auth::user();
        $image = $user->avatar()->first();
        $imageUrl = $image? url('storage/images/'.$image->name.".".$image->extension):url('img/participantes/participante.jpg');
        $data = [
            'session_user_id' => Auth::user()->id,
            'balance' => $this->txRepo->getBalance($this->user),
            'cantidadTxs' => $this->txRepo->getCantidadTxs($this->user),
            'username' => $this->user->getUserName(),
            'email' => $this->user->getEmail(),
            'name' => $this->user->getName(),
            'lastName' => $this->user->getLastName(),
            'city' => $user->city,
            'country' => $user->country,
            'provincia' => $user->provincia,
            'birthDate' => $user->birth_date,
            'profesion' => $user->profesion,
            'description' => $user->description,
            'whatsapp' => $user->whatsapp,
            'facebook' => $user->facebook,
            'twitter' => $user->twitter,
            'instagram' => $user->instagram,
            'role' => $user->role,
            'postulacion' => $this->cpaRepo->statusApplication(1, $this->user->getId()),
            'avatar' => $imageUrl
        ];
        return $data;
    }
}
