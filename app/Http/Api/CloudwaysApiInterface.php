<?php

namespace App\Http\Api;

use GuzzleHttp\{
    RequestOptions,
    ClientInterface,
};

interface CloudwaysApiInterface
{
    public function __construct(ClientInterface $client, string $clientServerId, string $clientAppId, string $clientEmail, string $clientKey, string $defaultDomain);
    public function addDomain();
    public function addCertificate();
}