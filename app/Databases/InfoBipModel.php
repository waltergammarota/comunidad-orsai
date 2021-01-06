<?php

namespace App\Databases;

use App\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class InfoBipModel extends Model
{
    private function getEndpoint()
    {
        return env('INFOBIP_URL', "https://gy98mr.api.infobip.com/sms/2/text/advanced");
    }

    private function getApiKey()
    {
        return env('INFOBIP_API_KEY', "");
    }

    public function verifyPhone($phone, $userId)
    {
        $client = new Client();
        $code = rand(1000, 9999);
        try {
            $sendSMS = $client->post($this->getEndpoint(),
                [
                    "headers" => [
                        "Authorization" => "App {$this->getApiKey()}",
                        "Content-Type" => "application/json"
                    ],
                    "json" => [
                        "messages" => [
                            ["from" => "Comunidad Orsai",
                                "destinations" => [
                                    ["to" => $phone]
                                ],
                                "flash" => true,
                                "text" => "[Comunidad Orsai] Código de verificación: {$code}. No compartas este código con nadie."
                            ]
                        ]
                    ]
                ]
            );
            $user = User::find($userId);
            $user->code = $code;
            $user->sms_sent_at = Carbon::now();
            $user->save();
            return $code;
        } catch (\Exception $error) {
        }
    }

    public function verifyCode($code, $userId)
    {
        $user = User::find($userId);
        $validWindowTimeInMinutes = 2;
        $sociosFundadorMaxQty = 15000;
        $timePassedInMinutes = $user->sms_sent_at->diffInMinutes(Carbon::now());
        if ($code == $user->code && $timePassedInMinutes < $validWindowTimeInMinutes) {
            $user->phone_verified_at = Carbon::now();
            $currentSociosFundadoresQty = User::where('socio_fundador', 1)->count();
            if ($currentSociosFundadoresQty <= $sociosFundadorMaxQty) {
                $user->socio_fundador = 1;
            }
            $user->save();
            return true;
        }
        return false;
    }

}

