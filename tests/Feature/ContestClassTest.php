<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Classes\Contest;
use Carbon\Carbon;
use App\Classes\User;

class ContestClassTest extends TestCase
{

    public function testSetContestCustomName()
    {
        $testName = "test contest name";
        $contest = new Contest($testName, now(), (Carbon::now())->addDays(10), new User);
        $contest->setName($testName);
        $this->assertTrue($contest->getName() === $testName);
    }

    public function testIfContestIsActiveWhenCurrentDateisLessThanEndateDate()
    {
        $contest = $this->getNewStartedContest();
        $this->assertTrue($contest->isActive());
    }

    public function testIfContestIsActiveWhenDateisGreaterThanEndDate()
    {
        $contest = $this->getNewStartedContest();
        $contest->setEndDate(now());
        $this->assertFalse($contest->isActive());
    }

    public function testPauseContest()
    {
        $contest = $this->getNewStartedContest();
        $endDate = (new \DateTime())->add(new \DateInterval("P10D"));
        $contest->start();
        $contest->pause();
        $this->assertFalse($contest->isActive());
    }

    public function testPauseAndUnpauseAContest()
    {
        $contest = $this->getNewStartedContest();
        $contest->pause();
        $this->assertFalse($contest->isActive());
        $contest->unpause();
        $this->assertTrue($contest->isActive());
    }

    /**
     * @return Contest
     * @throws \Exception
     */
    private function getNewStartedContest(): Contest
    {
        $testName = "test contest name";
        $contest = new Contest($testName, now(), (Carbon::now())->addDays(10), new User());
        $contest->start();
        return $contest;
    }

    public function testThrowExceptionOnBadName() {
        $contest = $this->getNewStartedContest();
        $this->expectException(\App\Classes\ContestBadParametersException::class);
        $this->expectExceptionCode(30001);
        $message = "Name is invalid";
        $this->expectExceptionMessage($message);
        $contest->setName(null);
    }

    public function testThrowExceptionOnInvalidEndDate() {
        $contest = $this->getNewStartedContest();
        $this->expectException(\App\Classes\ContestBadParametersException::class);
        $this->expectExceptionCode(30002);
        $message = "End date starts before start date";
        $this->expectExceptionMessage($message);
        $now = now();
        $contest->setStartDate($now);
        $contest->setEndDate($now);
    }

}
