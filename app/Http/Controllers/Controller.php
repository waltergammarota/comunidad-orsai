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
        }
        return $data;
    }

    protected function getCpasInfo()
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
}
