<?php

namespace Tests\Unit;

use App\Classes\User;
use App\Classes\UserException;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testThrowErrorWhenNameIsShortThan()
    {
        $user = new User();
        $this->expectException(UserException::class);
        $this->expectExceptionCode(100);
        $this->expectExceptionMessage(UserException::getInvalidLengthMessage());
        $user->setName("ab");
    }

    public function testThrowErrorWhenLastNameIsShortThanTest()
    {
        $user = new User();
        $this->expectException(UserException::class);
        $this->expectExceptionCode(110);
        $this->expectExceptionMessage(UserException::getInvalidLengthMessage());
        $user->setLastName("ab");
    }

    public function testThrowErrorWhenCellPhoneNumberIsInvalidTest()
    {
        $user = new User();
        $this->expectException(UserException::class);
        $this->expectExceptionCode(120);
        $this->expectExceptionMessage(UserException::getInvalidCellPhoneMessage());
        $user->setCellPhone("ab");
    }

    public function testRequiredDataIsComplete() {
        $user = new User();
        $user->setName("mato");
        $user->setLastName("gallardo");
        $user->setEmail("john.doe@example.com");
        $user->setCountry("Argentina");
        $user->setUserName("dj dero");
        $user->setPassword("12345678");
        $this->assertTrue($user->isRequiredDataComplete());
    }

    public function testRequiredDataIsInComplete() {
        $user = new User();
        $user->setName("mato");
        $user->setLastName("gallardo");
        $user->setEmail("john.doe@example.com");
        $user->setCountry("Argentina");
        $user->setUserName("dj dero");
        $this->assertFalse($user->isRequiredDataComplete());
    }
}
