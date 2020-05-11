<?php

namespace App\Http\Controllers;

use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use App\UseCases\Account\GetAccountInfo;
use App\UseCases\ContestApplication\CountContestApplication;
use App\UseCases\ContestApplication\TotalContestApplicationTokens;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function mapRequestToUserData(Request $request)
    {
        return $request->json()->all();
    }

    /**
     * @return array
     */
    protected function getUserData(): array
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
            session(['avatar' => $data['avatar']]);
            session(['name' => $data['name']]);
            session(['balance' => $data['balance']]);
            session(['role' => $data['role']]);
        }
        return $data;
    }

    protected function getCpasInfo()
    {
        $data = [];
        $data = [
            "totalCpas" => (new CountContestApplication(1))->execute(),
            "totalSupply" => (new TotalContestApplicationTokens())->execute()
        ];
        return $data;
    }

    protected function isAdmin()
    {
        $user = Auth::user();
        if ($user->role != "admin") {
            return Redirect::to('panel');
        }
    }
}
