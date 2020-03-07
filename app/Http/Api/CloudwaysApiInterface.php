<?php

namespace App\Http\Api;

interface CloudwaysApiInterface
{
    public function __construct(ClientInterface $client, string $clientEmail, string $clientKey);
    function getToken();
    public function addDomain();
    public function addCertificate();
}