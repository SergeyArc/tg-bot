<?php

namespace App\Actions;

use App\DataTransferObjects\SendMessageData;
use App\Infrastructure\HttpClient;

class SendMessage
{
    public static function execute(
        SendMessageData $data,
        string $telegramBotUrl,
        HttpClient $client
    ): void {
        $payload = [
            'chat_id' => $data->chatId,
            'text' => $data->text,
        ];

        if ($data->replyToMessageId !== null) {
            $payload['reply_to_message_id'] = $data->replyToMessageId;
        }

        $client->post("{$telegramBotUrl}/sendMessage", [
            'json' => $payload,
        ]);
    }
}
