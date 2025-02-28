<?php

namespace App\DataTransferObjects;

use Carbon\Carbon;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Attributes\WithCastAndTransformer;
use App\DataTransferObjects\CastsAndTransformers\CarbonCastAndTransformer;

#[MapName(SnakeCaseMapper::class)]
class MessageData extends Data
{
    public function __construct(
        public int $id,
        public int $chatId,
        #[WithCastAndTransformer(CarbonCastAndTransformer::class)]
        public ?Carbon $sentAt,
        public string $user,
        public string $text,
    ) {}
}
