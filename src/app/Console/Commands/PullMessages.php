<?php

namespace App\Console\Commands;

use App\Actions\ProcesseMessage;
use App\DataTransferObjects\TelegramMessageData;
use App\Infrastructure\HttpClient;
use App\Models\Message;
use Illuminate\Console\Command;

class PullMessages extends Command
{
    public function __construct(protected HttpClient $client)
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:pull-messages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Receive new messages';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $token = config('app.tg_token');
        $apiUrl = config('app.tg_api_url');
        $url = "{$apiUrl}/bot{$token}/getUpdates";

        $lastUpdateId = Message::max('update_id') ?? 0;

        $response = $this->client->post($url, [
            'json' => ['offset' => $lastUpdateId + 1],
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        if (isset($data['result'])) {
            foreach ($data['result'] as $message) {
                $messageData = TelegramMessageData::validateAndCreate($message);
                ProcesseMessage::execute($messageData);
            }
        }
    }
}
