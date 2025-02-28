<?php

namespace App\Actions;

use App\Models\Message;
use App\DataTransferObjects\TelegramMessageData;

class ProcesseMessage
{
    public static function execute(TelegramMessageData $data): int
    {
        $message = Message::create([
            'update_id' => $data->updateId,
            'chat_id' => $data->chatId,
            'text' => $data->text,
            'date' => $data->date,
            'user' => $data->user,
        ]);

        return $message->id;
    }
}
