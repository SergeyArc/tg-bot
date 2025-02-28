<?php

namespace App\Http\Controllers;

use App\Actions\SendMessage;
use App\DataTransferObjects\SendMessageData;

class SendMessageController extends BaseTelegramController
{
    public function __invoke(SendMessageData $messageData)
    {
        SendMessage::execute($messageData, $this->url, $this->client);

        return response()->json([], 204);
    }
}
