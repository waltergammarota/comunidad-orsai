<?php


namespace Tests\Feature;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Tests\TestCase;
use App\User;


class UserRegistrationApiTest extends TestCase
{
    private $userData;
    private $url = "http://orsai.test/api/users/register?XDEBUG_SESSION_START=VSCODE";

    public function __construct()
    {
        parent::__construct();
        $this->client = new Client();
    }

    public function testUserRegistrationApi()
    {
        $faker = factory(User::class)->make();
        $this->userData = [
            "name" => $faker->name,
            "lastName" => $faker->lastName,
            "nickName" => $faker->userName,
            "country" => $faker->country,
            "email" => $faker->email,
            "password" => $faker->password,

        ];
        $res = $this->client->request(
            'POST',
            $this->url,
            ['json' => $this->userData]
        );
        $this->assertTrue($res->getStatusCode() == 200);
        $this->assertTrue(json_decode($res->getBody())->id > 0);
    }

    public function testIfUserIsAlreadyRegistered()
    {
        $faker = factory(User::class)->make();
        $this->userData = [
            "name" => $faker->name,
            "lastName" => $faker->lastName,
            "nickName" => $faker->userName,
            "country" => $faker->country,
            "email" => $faker->email,
            "password" => $faker->password
        ];
        $res = $this->client->request(
            'POST',
            $this->url,
            ['json' => $this->userData]
        );
        $this->assertTrue($res->getStatusCode() == 200);
        $this->assertTrue(json_decode($res->getBody())->id > 0);
        $this->expectException(ClientException::class);
        $this->expectExceptionCode(409);
        $message = "User is already registered";
        $this->expectExceptionMessage($message);
        $res = $this->client->request(
            'POST',
            $this->url,
            ['json' => $this->userData]
        );

    }

    public function testIfMissingOneParameter() {
        $faker = factory(User::class)->make();
        $this->userData = [
            "name" => null,
            "lastName" => $faker->lastName,
            "nickName" => $faker->userName,
            "country" => $faker->country,
            "email" => $faker->email,
            "password" => $faker->password
        ];
        $this->expectException(ClientException::class);
        $this->expectExceptionCode(400);
        $message = "Name is shorter than 3";
        $this->expectExceptionMessage($message);
        $res = $this->client->request(
            'POST',
            $this->url,
            ['json' => $this->userData]
        );
    }

}
