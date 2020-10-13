<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use GuzzleHttp\Client;

class UpdateUsersNamesInCoral extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coral:update-users-names';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates users name and lastname in coral';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = $this->getUsersWithCoral();
        $client = new Client();
        $token = $this->getCoralToken($client);
        $this->changeUsersNames($users, $client, $token);
    }

    /**
     * @return array
     */
    private function getUsersWithCoral()
    {
        $users = User::select('id', 'name', 'lastName', 'coral_token')->whereNotNull('coral_token')->where('coral_token', '!=', '')->get();
        $this->info($users);
        return $users;
    }

    private function getCoralToken($client)
    {
        $endpoint = env('CORAL_AUTH_URL', "http://localhost:3000/api/auth/local");
        $response = $client->post($endpoint,
            ["json" => [
                'email' => env('CORAL_ADMIN_USER'),
                'password' => env('CORAL_ADMIN_PASSWORD'),
            ]]);
        $token = json_decode($response->getBody());
        $this->info($token->token);
        return $token;
    }

    /**
     * @param $users
     * @param $client
     * @param $token
     */
    private function changeUsersNames($users, $client, $token)
    {
        $endpointGraphQL = env('CORAL_GRAPHQL_URL', "http://localhost:3000/api/graphql");
        foreach ($users as $user) {
            $this->updateUserName($client, $endpointGraphQL, $token, $user);
            $this->info("{$user->id} {$user->name} {$user->lastName} changed");
        }
    }

    /**
     * @param $client
     * @param $endpointGraphQL
     * @param $token
     * @param $user
     */
    public function updateUserName($client, $endpointGraphQL, $token, $user)
    {
        $cambiarNombreResponse = $client->post($endpointGraphQL,
            [
                "headers" => [
                    "Authorization" => "Bearer {$token->token}",
                    "Content-Type" => "application/json"
                ],
                "json" => [
                    "query" => 'mutation($id:ID!,$name:String!,$clientMutationId:String!){updateUserUsername(input:{userID:$id,username:$name,clientMutationId:$clientMutationId}){user{id username}}}',
                    "variables" => [
                        "id" => $user->coral_token,
                        "name" => "{$user->name} {$user->lastName}",
                        "clientMutationId" => "1"
                    ]
                ]
            ]
        );
    }
}
