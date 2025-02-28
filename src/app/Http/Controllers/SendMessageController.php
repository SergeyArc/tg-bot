<?php

namespace App\Http\Controllers;

use App\Actions\SendMessage;
use App\DataTransferObjects\SendMessageData;
use OpenApi\Attributes as OA;

#[OA\Post(
    path: '/api/send',
    summary: 'Отправить сообщение в Телеграм',
    requestBody: new OA\RequestBody(
        content: new OA\JsonContent(
            ref: '#components/schemas/Message-Request-Send'
        )
    ),
    responses: [
        new OA\Response(
            response: '204',
            description: 'No Content',
        ),
    ]
)]
class SendMessageController extends BaseTelegramController
{
    public function __invoke(SendMessageData $messageData)
    {
        SendMessage::execute($messageData, $this->url, $this->client);

        return response()->json([], 204);
    }
}
