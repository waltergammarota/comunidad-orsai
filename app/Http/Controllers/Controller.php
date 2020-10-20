<?php

namespace App\Http\Controllers;

use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use App\UseCases\Account\GetAccountInfo;
use App\UseCases\ContestApplication\CountContestApplication;
use App\UseCases\ContestApplication\TotalContestApplicationTokens;
use GuzzleHttp\Client;
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
            $user = Auth::user();
            $accountUC = new GetAccountInfo(
                $user->id,
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
            $data['notifications'] = $this->getNotifications($user);
            $data['unreadNotifications'] = $this->getUnreadNotificationsTotal($user);
        }
        return $data;
    }

    private function getUnreadNotificationsTotal($user) {
        $notis = $user->unreadNotifications;
        return $user->unreadNotifications->count();
    }

    private function getNotifications($user) {
        return $user->unreadNotifications->take(3);
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


    /**
     * @param Request $request
     * @return mixed
     */
    protected function checkReCaptcha(Request $request)
    {
        $recaptchaToken = $request->get('g-recaptcha-response');
        $client = new Client();
        $recaptchaResponse = $client->request('POST', "https://www.google.com/recaptcha/api/siteverify", [
            'headers' => [
                'Accept' => 'application/json'
            ],
            'form_params' => [
                'secret' => env('CAPTCHA_SECRET'),
                'response' => $recaptchaToken
            ]
        ]);
        $status = json_decode($recaptchaResponse->getBody());
        return $status;
    }
}
