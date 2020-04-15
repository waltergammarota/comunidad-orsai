<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Classes\ContestApplication;
use \App\Classes\Contest;
use Carbon\Carbon;
use App\Classes\User;


class ContestApplicationClassTest extends TestCase
{
    private $faker;
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->faker = Faker\Factory::create();
    }

    public function testSetContestApplication()
    {
        $application = new ContestApplication();
        $fakeApplication = $this->getFakeApplication();
        $application->setTitle($fakeApplication["title"]);
        $application->setDescription($fakeApplication["description"]);
        $application->setLogo($fakeApplication["logo"]);
        $application->setImages($fakeApplication["images"]);
        $application->setLink($fakeApplication["link"]);
        $application->setPdf($fakeApplication["pdf"]);
        $application->setContest($this->getFakeContest());
        $this->assertTrue(
            $application->getTitle() === $fakeApplication["title"]
        );
        $this->assertTrue(
            $application->getDescription() === $fakeApplication["description"]
        );
        $this->assertTrue(
        $application->getLogo() === $fakeApplication["logo"]
    );
        $this->assertTrue(
            $application->getImages() === $fakeApplication["images"]
        );
    }

    private function getFakeContest() {
        $contest = new Contest("fake contest",now(),now()->add('1D'),new User());
        return $contest;
    }


    private function getFakeApplication()
    {
        $faker = $this->faker;
        $fakeApplication = [
            "title" => $faker->title,
            "description" => $faker->text,
            "logo" => $faker->imageUrl(),
            "images" => [$faker->imageUrl(), $faker->imageUrl()],
            "pdf" => $faker->name,
            "link" => $faker->url
        ];
        return $fakeApplication;
    }


}
