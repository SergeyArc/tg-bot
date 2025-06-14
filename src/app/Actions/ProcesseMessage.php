<?php

namespace App\Actions;

use App\DataTransferObjects\TelegramMessageData;
use App\Models\Message;

class ProcesseMessage
{
    public static function execute(TelegramMessageData $data): int
    {
        $message = Message::create([
            'update_id' => $data->updateId,
            'chat_id' => $data->chatId,
            'message_id' => $data->messageId,
            'text' => $data->text,
            'date' => $data->date,
            'user' => $data->user,
        ]);

        return $message->id;
    }
}
