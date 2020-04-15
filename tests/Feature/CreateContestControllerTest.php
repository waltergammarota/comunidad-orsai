<?php


namespace Tests\Feature;

use App\Classes\CreateContestException;
use App\Controllers\CreateContestController;
use App\Databases\ContestModel;
use App\Repositories\ContestRepository;
use App\User;
use Tests\TestCase;
use App\Repositories\UserRepository;


class CreateContestControllerTest extends TestCase
{

    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepository = new UserRepository();
        $this->contestRepository = new ContestRepository(new ContestModel());
        $this->userRepository->deleteAllUsers();
        $this->contestRepository->deleteAllContests();
        $this->user = $this->createUser();
    }

    private function createUser($role = "admin")
    {
        $userModel = factory(User::class)->make();
        $userModel->role = $role;
        $user = $this->userRepository->mapDBUserPropsToUser($userModel);
        $savedUser = $this->userRepository->save($user);
        $userId = $savedUser->getId();
        return $this->userRepository->find($userId);
    }

    public function testCreateContest() {
        $contestData = [
            "name" => "test",
            "start_date" => "2020-03-25",
            "end_date"=> "2020-03-26",
            "user_id" => $this->user->getId()
        ];
        $createContestController = new CreateContestController($contestData);
        $output = $createContestController->execute();
        $this->assertTrue($output['id'] == 1);
    }

    public function testThrowExceptionOnInvalidUser() {
        $this->expectException(CreateContestException::class);
        $this->expectExceptionCode(30001);
        $this->expectExceptionMessage((new CreateContestException())->getMessage());
        $contestData = [
            "name" => "test",
            "start_date" => "2020-03-25",
            "end_date"=> "2020-03-26",
            "user_id" => $this->createUser("user")->getId()
        ];
        $createContestController = new CreateContestController($contestData);
        $output = $createContestController->execute();

    }

}
