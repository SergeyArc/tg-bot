<?php

namespace App\Http\Controllers;

use App\Actions\SendMessage;
use App\Infrastructure\HttpClient;
use App\DataTransferObjects\SendMessageData;

class SendMessageController extends Controller
{
    private string $token;
    private string $url;
    private HttpClient $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
        $this->token = config('app.tg_token');
        $apiUrl =  config('app.tg_api_url');
        $this->url = "{$apiUrl}/bot{$this->token}";
    }

    public function __invoke(SendMessageData $messageData)
    {
        SendMessage::execute($messageData, $this->url, $this->client);

        return response()->json([], 204);
    }
}
