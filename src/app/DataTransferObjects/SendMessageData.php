<?php

namespace App\DataTransferObjects;

use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[OA\Schema(
    schema: 'Message-Request-Send',
    type: 'object',
    properties: [
        new OA\Property(
            property: 'chat_id',
            type: 'integer',
            example: 123456789
        ),
        new OA\Property(
            property: 'text',
            type: 'string',
            example: 'Hello, this is a test message'
        ),
        new OA\Property(
            property: 'reply_to_message_id',
            type: 'integer',
            nullable: true,
            example: 391
        ),
    ],
)]
#[MapName(SnakeCaseMapper::class)]
class SendMessageData extends Data
{
    public function __construct(
        public int $chatId,
        public string $text,
        public ?int $replyToMessageId = null,
    ) {}
}
