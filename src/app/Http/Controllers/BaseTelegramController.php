<?php

namespace App\Http\Controllers;

use App\Infrastructure\HttpClient;

class BaseTelegramController extends Controller
{
    protected string $token;
    protected string $url;
    protected HttpClient $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
        $this->token = config('app.tg_token');
        $apiUrl =  config('app.tg_api_url');
        $this->url = "{$apiUrl}/bot{$this->token}";
    }
}
