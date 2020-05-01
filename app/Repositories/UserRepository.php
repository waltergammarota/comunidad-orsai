<?php


namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


interface UserRepositoryInterface
{
    public function save(\App\Classes\User $user);

    public function checkIfUserIsRegistered($email);
}

class UserRepository implements UserRepositoryInterface
{

    private $hashAlgo = "sha256";

    public function save(\App\Classes\User $user)
    {
        $userData = [
            "name" => $user->getName(),
            "lastName" => $user->getLastName(),
            "userName" => $user->getUserName(),
            "country" => $user->getCountry(),
            "email" => $user->getEmail(),
            "email_verified_at" => $user->getEmailVerifiedAt(),
            "role"=> $user->getRole()
        ];
        $userModel = new User($userData);
        if ($user->getId() && $user->getId() > 0) {
            $userModel->id = $user->getId();
            $userModel->exists = true;
        } else {
            $userModel->password = $user->getPassword();
        }
        $userModel->save();
        return $this->mapDBUserPropsToUser($userModel);
    }

    public function checkIfUserIsRegistered($email)
    {
        return User::where('email', $email)->count() > 0;
    }

    public function deleteAllUsers()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function deleteUser($id)
    {
        return User::destroy($id);
    }

    /**
     * @param $token
     * @return bool|\App\Classes\User
     */
    public function findByToken($token)
    {
        $user = User::where(
            DB::raw(' md5(concat(id,email,created_at))'),
            $token
        )->first();
        if ($user) {
            return $this->mapDBUserPropsToUser($user);
        }
        return false;
    }

    public function mapDBUserPropsToUser(User $userModel)
    {
        $user = new \App\Classes\User();
        $userData = $userModel->toArray();
        $userData['id'] = $userModel->id;
        $userData['email_verified_at'] = $userModel->email_verified_at;
        $userData['password'] = $userModel->password;
        $userData['created_at'] = $userModel->created_at;
        $userData['updated_at'] = $userModel->updated_at;
        $userData['updated_at'] = $userModel->updated_at;
        $userData['role'] = $userModel->role;
        $user->updateData($userData);
        return $user;
    }

    public function find($id)
    {
        $userModel = User::find($id);
        return $this->mapDBUserPropsToUser($userModel);
    }

    public function getPoolUser()
    {
        return $this->find(1);
    }
}
