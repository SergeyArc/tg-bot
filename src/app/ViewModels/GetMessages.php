<?php

namespace App\ViewModels;

use App\Models\Message;
use App\DataTransferObjects\MessageData;
use Illuminate\Pagination\LengthAwarePaginator;

class GetMessages
{
    private const PER_PAGE = 20;

    public function __construct(private readonly int $currentPage = 1) {}

    public function messages(): LengthAwarePaginator
    {
        $query = Message::orderBy('created_at', 'desc')
            ->paginate(self::PER_PAGE, ['*'], 'page', $this->currentPage);

        return new LengthAwarePaginator(
            $query->map(fn(Message $message) => MessageData::from($message)),
            $query->total(),
            self::PER_PAGE,
            $this->currentPage,
            ['path' => route('message.index')],
        );
    }
}
