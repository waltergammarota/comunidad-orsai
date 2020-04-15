<?php


namespace Tests\Utils;
use App\Classes\User;

class FakeUserRepository
{
    public function save(User $user)
    {
        $user = new User();
        $user->setEmail("test@gmail.com");
        $user->setId(1);
        return $user;
    }

    public function checkIfUserIsRegistered()
    {
        return false;
    }
}
