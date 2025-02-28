<?php

namespace Tests\Feature;

use App\Actions\Contracts\HttpClientInterface;
use App\Infrastructure\HttpClient;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Mockery;

class SendMessageControllerTest extends BaseControllerTest
{
    public function test_send_message_returns_204(): void
    {
        $mockGuzzleClient = Mockery::mock(Client::class);
        $mockGuzzleClient->shouldReceive('post')
            ->once()
            ->with('https://api.telegram.org/botTOKEN/sendMessage', Mockery::type('array'))
            ->andReturn(new Response(200, [], json_encode(['ok' => true])));

        $this->app->instance(Client::class, $mockGuzzleClient);
        $httpClient = new HttpClient($mockGuzzleClient);
        $this->app->instance(HttpClientInterface::class, $httpClient);

        $response = $httpClient->post('https://api.telegram.org/botTOKEN/sendMessage', [
            'json' => [
                'chat_id' => 123456,
                'text' => 'Hello, world!',
            ],
        ]);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString('{"ok": true}', $response->getBody()->getContents());
    }
}
