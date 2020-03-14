<?php

namespace App\Http\Api;

use App\Domain;
use GuzzleHttp\{
    RequestOptions,
    ClientInterface,
};
use Illuminate\Support\Facades\Cache;

class CloudwaysApi implements CloudwaysApiInterface
{
    const REMEMBER_TOKEN_MINUTES = 55;

    public $client;
    protected $clientServerId;
    protected $clientAppId;
    protected $clientEmail;
    protected $clientKey;
    protected $defaultDomain;

    public function __construct(ClientInterface $client, string $clientServerId, string $clientAppId, string $clientEmail, string $clientKey, string $defaultDomain)
    {
        $this->client = $client;
        $this->clientServerId = $clientServerId;
        $this->clientAppId = $clientAppId;
        $this->clientEmail = $clientEmail;
        $this->clientKey = $clientKey;
        $this->defaultDomain = $defaultDomain;
    }

    protected function getToken()
    {
        if (Cache::has('cloudways-api-token')) {
            return Cache::get('cloudways-api-token');
        }

        try {
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
        } catch (\Exception $e) {
            \Log::error($e);
        }
    }

    public function addDomain()
    {
        if (! config('services.cloudways.enabled', false)) {
            return;
        }

        try {
            return json_decode(
                $this->client->post('/api/v1/app/manage/aliases', [
                    'debug' => true,
                    'form_params' => [
                        'server_id' => $this->clientServerId,
                        'app_id' => $this->clientAppId,
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
        } catch (\Exception $e) {
            \Log::error($e);
        }
    }

    public function addCertificate()
    {
        if (! config('services.cloudways.enabled', false)) {
            return;
        }

        $domains = Domain::all()->pluck('name')->filter(function ($domain) {
            $records = collect(dns_get_record($domain));
            $cnameRecord = $records->where('type', 'CNAME')->first()['target'];

            return $cnameRecord === $this->defaultDomain;
        })->toArray();

        if (! in_array($this->defaultDomain, $domains)) {
            array_push($domains, $this->defaultDomain);
        }

        try {
            return json_decode(
                $this->client->post('/api/v1/security/lets_encrypt_install', [
                    'debug' => true,
                    'form_params' => [
                        'server_id' => $this->clientServerId,
                        'app_id' => $this->clientAppId,
                        'ssl_email' => $this->clientEmail,
                        'wild_card' => false,
                        'ssl_domains' => $domains,
                    ],
                    'headers' => [
                        'Content-Type' => 'application/x-www-form-urlencoded',
                        'Accept' => 'application/json',
                        'Authorization' => sprintf('Bearer %s', $this->getToken()),
                    ]
                ])->getBody(),
                true
            );
        } catch (\Exception $e) {
            \Log::error($e);
        }
    }
}