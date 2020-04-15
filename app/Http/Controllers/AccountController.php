<?php


namespace App\Http\Controllers;

use App\Controllers\CreateContestApplicationController;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use App\UseCases\Account\GetAccountInfo;
use App\UseCases\ContestApplication\GetContestApplicationByUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class AccountController extends Controller
{

    public function show_perfil()
    {
        $data = $this->getUserData();
        return view('perfil', $data);
    }

    public function show_panel()
    {
        $data = $this->getUserData();
        return view('panel', $data);
    }

    public function show_postulacion(Request $request)
    {
        $userData = $this->getUserData();
        $data = $userData;
        if($request->route('id')) {
            $postulacionId = $request->route('id');
            $postulacion = $this->findPostulacion($postulacionId);
            $data = array_merge($userData, $postulacion);
        }
        return view('postulacion', $data);
    }

    private function findPostulacion($userId)
    {
        return (new GetContestApplicationByUser($userId))->execute();
    }

    public function store_publicacion(Request $request)
    {
        $caca = "test";
        $request->validate(
            [
                'title' => 'required|min:1|max:255',
                'description' => 'required|min:1|max:64',
                'logo' => 'required|array|min:1|max:1',
                'logo.*' => 'image|required|max:5120',
                'images' => 'required|array|min:5|max:5',
                'images.*' => 'required|max:5120',
                'pdf' => 'array',
                'pdf.*' => 'mimes:pdf|max:5120',
            ]
        );

        $data = [
            "title" => $request->title,
            "description" => $request->description,
            "link" => $request->link,
            "user_id" => Auth::user()->id,
            "contest_id" => 1,
        ];
        $cpa = new CreateContestApplicationController($data,$request);
        $id = $cpa->execute();
        return Redirect::to("postulacion/{$id}");
    }

    /**
     * @return array
     */
    private function getUserData(): array
    {
        $accountUC = new GetAccountInfo(
            Auth::user()->id,
            new UserRepository(),
            new TransactionRepository(
                new UserRepository()
            )
        );
        $data = $accountUC->execute();
        return $data;
    }

}
