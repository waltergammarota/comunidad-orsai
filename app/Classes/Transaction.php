<?php


namespace App\Classes;

use App\Classes\User;

class Transaction extends GenericClass
{
    private $from;
    private $to;
    private $amount;
    private $data;
    private $type;
    private $types = ["MINT", "BURN", "TRANSFER"];

    public function __construct(User $from, User $to, $amount, $type, $data)
    {
        $this->from = $from;
        $this->to = $to;
        $this->amount = $amount;
        $this->setType($type);
        $this->data = $data;
    }

    /**
     * @return \App\Classes\User
     */
    public function getFrom(): \App\Classes\User
    {
        return $this->from;
    }

    /**
     * @param \App\Classes\User $from
     */
    public function setFrom(\App\Classes\User $from): void
    {
        $this->from = $from;
    }

    /**
     * @return \App\Classes\User
     */
    public function getTo(): \App\Classes\User
    {
        return $this->to;
    }

    /**
     * @param \App\Classes\User $to
     */
    public function setTo(\App\Classes\User $to): void
    {
        $this->to = $to;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $type
     * @throws TransactionInvalidaTypeException
     */
    public function setType($type): void
    {
        if (in_array(strtoupper($type), $this->types)) {
            $this->type = $type;
            return;
        }
        throw new TransactionInvalidaTypeException();
    }

    /**
     * @return array
     */
    public function getTypes(): array
    {
        return $this->types;
    }

}
