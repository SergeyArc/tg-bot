<?php

namespace App\Actions;

use App\Infrastructure\HttpClient;
use App\DataTransferObjects\SendMessageData;

class SendMessage
{
    public static function execute(
        SendMessageData $data,
        string $telegramBotUrl,
        HttpClient $client
    ): void {
        $client->post("{$telegramBotUrl}/sendMessage", [
            'json' => [
                'chat_id' => $data->chatId,
                'text' => $data->text,
            ]
        ]);
    }
}
