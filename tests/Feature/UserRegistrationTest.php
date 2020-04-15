<?php

use App\Classes\UserException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Classes\User;
use App\Utils\Mailer;
use Tests\Utils\FakeUserRepository;

/**
 * Class UserRegistrationTest
 */
class UserRegistrationTest extends TestCase
{
    private $userData = [
        "name" => "mato",
        "lastName" => "gallardo",
        "nickName" => "matoG",
        "country" => "Argentina",
        "email" => "test@gmail.com",
        "password" => "12345678"
    ];


    private $incompleteData = [
        "name" => null,
        "lastName" => "gallardo",
        "nickName" => "matoG",
        "country" => "Argentina",
        "email" => "test@gmail.com",
        "password" => "12345678"
    ];

    private $emptyData = [];

    public function testUserRegistrationWithFaker()
    {
        $userData = $this->userData;
        $userRegistration = new \App\UseCases\UserRegistration(
            $userData,
            new FakeUserRepository(),
            new Mailer()
        );

        $result = $userRegistration->execute();
        $this->assertTrue($result["id"] > 0);
    }

    public function testThrowErrorOnBadParameters()
    {
        $userData = $this->incompleteData;
        $this->expectException(UserException::class);
        $this->expectExceptionCode(100);
        $this->expectExceptionMessage(UserException::getInvalidLengthMessage());
        $userRegistration = new \App\UseCases\UserRegistration(
            $userData,
            new FakeUserRepository(),
            new Mailer()
        );
    }

    public function testRegistrationWithUserRepository()
    {
        $userData = $this->userData;
        $userRepository = new \App\Repositories\UserRepository();
        $userRepository->deleteAllUsers();
        $userRegistration = new \App\UseCases\UserRegistration(
            $userData,
            $userRepository,
            new Mailer()
        );
        $result = $userRegistration->execute();
        $this->assertTrue($result["id"] > 0);
    }

}




