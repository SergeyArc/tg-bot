<?php

namespace App\ViewModels;

use App\Models\Message;
use App\DataTransferObjects\MessageData;
use Illuminate\Pagination\LengthAwarePaginator;
use OpenApi\Attributes as OA;

#[OA\Get(
    path: "/messages",
    description: "получить список сообщений",
    tags: ["messages"],
    parameters: [
        new OA\Parameter(
            name: "page",
            in: "query",
            description: "Текущая страница",
            required: false,
            schema: new OA\Schema(type: "integer", example: 1)
        )
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: "success",
            content: new OA\JsonContent(
                type: "object",
                properties: [
                    new OA\Property(
                        property: "data",
                        type: "array",
                        items: new OA\Items(ref: "#/components/schemas/MessageData")
                    ),
                    new OA\Property(property: "total", type: "integer", example: 100),
                    new OA\Property(property: "per_page", type: "integer", example: 20),
                    new OA\Property(property: "current_page", type: "integer", example: 1),
                    new OA\Property(property: "last_page", type: "integer", example: 5),
                ]
            )
        )
    ]
)]
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
