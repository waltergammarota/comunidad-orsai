<?php

namespace Tests\Unit;

use App\Classes\Transaction;
use App\Classes\User;
use App\Classes\TransactionInvalidaTypeException;
use PHPUnit\Framework\TestCase;

class TransactionTest extends TestCase
{
    private function createUsers()
    {
        $from = new User();
        $to = new User();
        return [$from, $to];
    }

    public function testTransactionCreation()
    {
        list($from, $to) = $this->createUsers();
        $amountToMint = 1000;
        $data = "";
        $type = "MINT";
        $tx = new Transaction($from, $to, $amountToMint, $type, $data);
        $this->assertTrue($tx->getType() == $type);
    }

    public function testThrowExceptionOnInvalidType()
    {
        list($from, $to) = $this->createUsers();
        $amountToMint = 1000;
        $data = "";
        $type = "ZARAZA";
        $message = "Invalid Type";
        $code = 20001;
        $this->expectException(TransactionInvalidaTypeException::class);
        $this->expectExceptionMessage($message);
        $this->expectExceptionCode($code);
        $tx = new Transaction($from, $to, $amountToMint, $type, $data);
    }


}
