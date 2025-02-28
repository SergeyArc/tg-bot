<?php

namespace App\DataTransferObjects;

use Carbon\Carbon;
use App\Models\Message;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Attributes\WithCastAndTransformer;
use App\DataTransferObjects\CastsAndTransformers\CarbonCastAndTransformer;

#[MapInputName(SnakeCaseMapper::class)]
class TelegramMessageData extends Data
{
    public int $updateId;

    #[MapInputName("message.chat.id")]
    public int $chatId;

    #[MapInputName("message.message_id")]
    public int $messageId;

    #[MapInputName("message.from.first_name")]
    public string $user;

    #[MapInputName("message.text")]
    public string $text;

    #[MapInputName("message.date")]
    #[WithCastAndTransformer(CarbonCastAndTransformer::class)]
    public Carbon $date;

    public static function rules(): array
    {
        return [
            'update_id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    if (Message::where('update_id', $value)->exists()) {
                        $fail('Сообщение уже обработано');
                    }
                }
            ],
            'message.message_id' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    if (Message::where('message_id', $value)->exists()) {
                        $fail('Сообщение уже обработано');
                    }
                }
            ],
        ];
    }
}
