<?php

namespace App\Http\Api;

use App\Domain;
use GuzzleHttp\{
    RequestOptions,
    ClientInterface,
};
use Illuminate\Support\Facades\Cache;

class CloudwaysApi
{
    const REMEMBER_TOKEN_MINUTES = 55;

    public $client;
    protected $clientEmail;
    protected $clientKey;

    public function __construct(ClientInterface $client, string $clientEmail, string $clientKey)
    {
        $this->client = $client;
        $this->clientEmail = $clientEmail;
        $this->clientKey = $clientKey;
    }

    protected function getToken()
    {
        if (Cache::has('cloudways-api-token')) {
            return Cache::get('cloudways-api-token');
        }

        $token = json_decode(
            $this->client->post('/api/v1/oauth/access_token', [
                'query' => [
                    'email' => $this->clientEmail,
                    'api_key' => $this->clientKey,
                ],
            ])->getBody(),
            true
        )['access_token'];
        
        Cache::put('cloudways-api-token', $token, now()->addMinutes(self::REMEMBER_TOKEN_MINUTES));

        return $token;
    }

    public function addDomain(string $domain)
    {
        $data = json_decode(
            $this->client->post('/api/v1/app/manage/aliases', [
                'debug' => true,
                'form_params' => [
                    'server_id' => config('services.cloudways.server_id'),
                    'app_id' => config('services.cloudways.app_id'),
                    'aliases' => Domain::all()->pluck('name')->toArray(),
                ],
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Accept' => 'application/json',
                    'Authorization' => sprintf('Bearer %s', $this->getToken()),
                ]
            ])->getBody(),
            true
        );
    }
}