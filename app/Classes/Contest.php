<?php

namespace App\Classes;

use Carbon\Carbon;
use App\Classes\User;


class Contest extends GenericClass
{

    private $name;
    private $startDate;
    private $endDate;
    private $user;

    /**
     * @return \App\Classes\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \App\Classes\User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function __construct($name, Carbon $startDate, Carbon $endDate, User $user, $active = true)
    {
        $this->name =$name;
        $this->startDate = $startDate;
        $this->setEndDate($endDate);
        $this->active = false;
        $this->user = $user;
        $this->active = $active;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     * @throws ContestBadParametersException
     */
    public function setName($name): void
    {
        if($name != null) {
            $this->name = $name;
            return;
        }
        throw new ContestBadParametersException("Name is invalid", 30001);
    }

    /**
     * @return Carbon
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param Carbon $startDate
     */
    public function setStartDate($startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return Carbon
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param Carbon $endDate
     * @throws ContestBadParametersException
     */
    public function setEndDate(Carbon $endDate): void
    {
        if($endDate > $this->startDate) {
            $this->endDate = $endDate;
            return;
        }
        throw New ContestBadParametersException("End date starts before start date", 30002);
    }

    public function isActive()
    {
        if ($this->active == true) {
            $dateCorregida = $this->endDate->addHours(3);
            $difference = $dateCorregida->diffInSeconds(Carbon::now());
            return $difference > 0;
        }
        return false;
    }

    public function start()
    {
        $this->active = true;
    }

    public function pause()
    {
        $this->active = false;
    }

    public function unpause()
    {
        $this->active = true;
    }

    public function updateData($contestData) {
        $this->setName($contestData->name);
        $this->setStartDate($contestData->startDate);
        $this->setEndDate($contestData->endDate);
        $this->setUser($contestData->user);
    }


}
