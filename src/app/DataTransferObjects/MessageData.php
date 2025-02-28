<?php

namespace App\DataTransferObjects;

use Carbon\Carbon;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Attributes\WithCastAndTransformer;
use App\DataTransferObjects\CastsAndTransformers\CarbonCastAndTransformer;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "MessageData",
    description: "Telegram-сообщение",
    properties: [
        new OA\Property(property: "id", type: "integer", example: 1),
        new OA\Property(property: "chat_id", type: "integer", example: 123456789),
        new OA\Property(property: "date", type: "string", format: "date-time", example: "2024-02-28T12:00:00Z"),
        new OA\Property(property: "user", type: "string", example: "Sergei"),
        new OA\Property(property: "text", type: "string", example: "Hello, world!"),
    ],
    type: "object"
)]
#[MapName(SnakeCaseMapper::class)]
class MessageData extends Data
{
    public function __construct(
        public int $id,
        public int $chatId,
        #[WithCastAndTransformer(CarbonCastAndTransformer::class)]
        public Carbon $date,
        public string $user,
        public string $text,
    ) {}
}
