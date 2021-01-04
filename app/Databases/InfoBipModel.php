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
        $code = rand(100000, 999999);
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
        } catch (\Exception $error) {
        }
    }

    public function updateStory($coral_id, $url, $title, $author)
    {
        $client = new Client();
        try {
            $token = $this->getCoralToken($client);
            $updateStoryResponse = $client->post($this->getEndpoint(),
                [
                    "headers" => [
                        "Authorization" => "Bearer {$token->token}",
                        "Content-Type" => "application/json"
                    ],
                    "json" => [
                        "query" => 'mutation($id:ID!,$story:UpdateStory!){updateStory(input:{id:$id,story:$story,clientMutationId:""}){story{id url metadata{title author description image publishedAt modifiedAt section}scrapedAt}}}',
                        "variables" => [
                            "id" => $coral_id,
                            "story" => [
                                "url" => $url,
                                "metadata" => [
                                    "title" => $title,
                                    "author" => $author
                                ]
                            ],
                        ]
                    ]
                ]
            );
        } catch (\Exception $e) {
        }
    }
}

