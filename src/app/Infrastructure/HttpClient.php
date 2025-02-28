<?php

namespace App\Infrastructure;

use GuzzleHttp\Client;
use App\Actions\Contracts\HttpClientInterface;
use Psr\Http\Message\ResponseInterface;

class HttpClient implements HttpClientInterface
{
    public function __construct(protected Client $client) {}

    public function post($uri, array $options = []): ResponseInterface
    {
        return $this->client->post($uri, $options);
    }
}
