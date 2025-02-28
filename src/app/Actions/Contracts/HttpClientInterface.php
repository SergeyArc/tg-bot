<?php

namespace App\Actions\Contracts;

use Psr\Http\Message\ResponseInterface;


interface HttpClientInterface
{
    public function post($uri, array $options = []): ResponseInterface;
}
