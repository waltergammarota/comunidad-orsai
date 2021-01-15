<?php


namespace App\UseCases\ContestApplication;

use App\Classes\ContestApplication;
use App\Exceptions\CpaException;
use App\Repositories\ContestApplicationRepository;
use App\Repositories\ContestRepository;
use App\Repositories\FileRepository;
use App\Repositories\UserRepository;
use App\UseCases\GenericUseCase;

class CreateContestApplication extends GenericUseCase
{

    private $userRepository;
    private $contestRepository;
    private $contestApplicationRepository;
    private $fileRepository;
    private $data;

    public function __construct(
        $data,
        $request,
        UserRepository $userRepository,
        ContestRepository $contestRepository,
        ContestApplicationRepository $contestApplicationRepository,
        FileRepository $fileRepository
    )
    {
        $this->data = $data;
        $this->userRepository = $userRepository;
        $this->contestRepository = $contestRepository;
        $this->contestApplicationRepository = $contestApplicationRepository;
        $this->fileRepository = $fileRepository;
        $this->request = $request;
    }

    public function execute()
    {
        $user = $this->userRepository->find($this->data['user_id']);
        $contest = $this->contestRepository->find($this->data['contest_id']);
        if ($contest->hasPostulacionesAbiertas()) {
            $data = [
                "title" => $this->data['title'],
                "description" => $this->data['description'],
                "link" => $this->data['link'],
                "user" => $user,
                "contest" => $contest,
                "images" => $this->fileRepository->getUploadedFiles('images', $this->request),
                "logo" => $this->fileRepository->getUploadedFiles('logo', $this->request),
                "pdf" => $this->fileRepository->getUploadedFiles('pdf', $this->request),
            ];
            $contestApplication = new ContestApplication($data);
            return $this->contestApplicationRepository->save($contestApplication);
        }
        throw new CpaException();

    }
}
