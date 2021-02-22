<?php

namespace App\Databases;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class CoralModel extends Model
{
    private function getEndpoint()
    {
        return env('CORAL_GRAPHQL_URL', "http://localhost:3000/api/graphql");
    }

    private function getCoralToken($client)
    {
        $endpoint = env('CORAL_AUTH_URL', "http://localhost:3000/api/auth/local");
        try {
            $response = $client->post($endpoint,
                ["json" => [
                    'email' => env('CORAL_ADMIN_USER'),
                    'password' => env('CORAL_ADMIN_PASSWORD'),
                ]]);
            $token = json_decode($response->getBody());
            return $token;
        } catch (Exception $error) {
            $token = new \stdClass();
            $token->token = uniqid();
            return $token;
        }
    }

    public function createStory($coral_id, $url, $title, $author)
    {
        $client = new Client();
        try {
            $token = $this->getCoralToken($client);
            return $client->post($this->getEndpoint(),
                [
                    "headers" => [
                        "Authorization" => "Bearer {$token->token}",
                        "Content-Type" => "application/json"
                    ],
                    "json" => [
                        "query" => 'mutation CreateStory($story:CreateStory!){createStory(input:{story:$story,clientMutationId:""}){story{id url metadata{title author}}}}',
                        "variables" => [
                            "story" => [
                                "id" => $coral_id,
                                "url" => $url,
                                "metadata" => [
                                    "title" => $title,
                                    "author" => $author
                                ]
                            ],
                            "operationName" => "CreateStory"
                        ]
                    ]
                ]
            );
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

