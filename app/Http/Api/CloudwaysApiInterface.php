<?php

namespace App\Http\Api;

use GuzzleHttp\{
    RequestOptions,
    ClientInterface,
};

interface CloudwaysApiInterface
{
    public function __construct(ClientInterface $client, string $clientEmail, string $clientKey);
    public function addDomain();
    public function addCertificate();
}