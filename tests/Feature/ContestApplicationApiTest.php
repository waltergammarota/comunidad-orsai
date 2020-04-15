<?php

namespace Tests\Feature;

use App\Databases\ContestModel;
use App\Repositories\ContestRepository;
use Tests\TestCase;
use App\Controllers\CreateContestController;
use GuzzleHttp\Client;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory;

class ContestApplicationApiTest extends TestCase
{
    private $faker;
    private $url = "http://orsai.test/api/contest_application/create?XDEBUG_SESSION_START=VSCODE";

    public function SetUp() : void
    {
        parent::setUp();
        $this->userRepository = new UserRepository();
        $this->contestRepository = new ContestRepository(new ContestModel());
        $this->user = $this->createUser('admin');
        $this->contest = $this->createContest();
        $this->client = new Client();
        $this->faker = Factory::create();
    }

    private function createContest()
    {
        $contestData = [
            "name" => "test",
            "start_date" => "2020-03-25",
            "end_date" => "2020-12-01",
            "user_id" => $this->user->getId()
        ];
        $createContestController = new CreateContestController($contestData);
        return $createContestController->createContest();
    }

    /**
     * @param string $role
     * @return User
     */
    private function createUser($role = "admin")
    {
        $userModel = factory(User::class)->make();
        $userModel->role = $role;
        $user = $this->userRepository->mapDBUserPropsToUser($userModel);
        $savedUser = $this->userRepository->save($user);
        $userId = $savedUser->getId();
        return $this->userRepository->find($userId);
    }

    public function testCreateContestApplicationApi()
    {
        $faker = $this->faker;
        $data = [
            "title" => $faker->name,
            "description" => $faker->text,
            "link" => $faker->url,
            "user_id" => $this->user->getId(),
            "contest_id" => $this->contest->getId(),
        ];
        $rootPath = base_path();
        $imagePath = "{$rootPath}/tests/fake-images/test.jpg";
        $logoPath = "{$rootPath}/tests/fake-images/logo.jpeg";
        $pdfPath = "{$rootPath}/tests/fake-images/test.pdf";
        $cwd = getcwd();
        $response = $this->client->request('POST', $this->url, [
            'multipart' => [
                [
                    'name'     => 'title',
                    'contents' => $data['title']
                ],
                [
                    'name'     => 'description',
                    'contents' => $data['description']
                ],
                [
                    'name'     => 'link',
                    'contents' => $data['link']
                ],
                [
                    'name'     => 'user_id',
                    'contents' => $data['user_id']
                ],
                [
                    'name'     => 'contest_id',
                    'contents' => $data['contest_id']
                ],
                [
                    'name'     => 'images[]',
                    'contents' => fopen($imagePath, 'r'),
                ],
                [
                    'name'     => 'images[]',
                    'contents' => fopen($imagePath, 'r'),
                ],
                [
                    'name'     => 'logo[]',
                    'contents' => fopen($logoPath, 'r'),
                ],
                [
                    'name'     => 'pdf[]',
                    'contents' => fopen($pdfPath, 'r'),
                ]
            ]
        ]);
        $this->assertTrue($response->getStatusCode() == 200);
        $this->assertTrue(json_decode($response->getBody())->id > 0);
    }

}
