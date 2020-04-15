<?php


namespace App\Http\Controllers;


use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use App\UseCases\Account\GetAccountInfo;
use App\UseCases\ContestApplication\CountContestApplication;
use App\UseCases\ContestApplication\TotalContestApplicationTokens;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    public function index()
    {
        $data = $this->getUserData();
        return view('index', $data);
    }

    public function concurso_logo()
    {
        $data = $this->getUserData();
        return view('concurso-logo', $data);
    }

    public function fundacion()
    {
        $data = $this->getUserData();
        return view('fundacion-orsai', $data);
    }

    public function donar()
    {
        $data = $this->getUserData();
        return view('donar', $data);
    }

    public function participantes()
    {
        $userInfo = $this->getUserData();
        $cpasInfo = $this->getCpasInfo();
        $data = array_merge($userInfo,$cpasInfo);
        return view('participantes', $data);
    }

    private function getCpasInfo()
    {
        $data = [];
        if (Auth::check()) {
            $data = [
                "totalCpas" => (new CountContestApplication(1))->execute(),
                "totalSupply" => (new TotalContestApplicationTokens())->execute(
                )
            ];
        }
        return $data;
    }

    /**
     * @return array
     */
    private function getUserData(): array
    {
        $data = [];
        if (Auth::check()) {
            $accountUC = new GetAccountInfo(
                Auth::user()->id,
                new UserRepository(),
                new TransactionRepository(
                    new UserRepository()
                )
            );
            $data = $accountUC->execute();
        }
        return $data;
    }

}
