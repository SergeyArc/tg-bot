<?php

namespace Tests\Feature;

class ListMessagesControllerTest extends BaseControllerTest
{
    public function test_index_returns_200(): void
    {
        $response = $this->actingAs($this->user)->getJson(route('message.index'));
        $response->assertStatus(200)->assertJsonStructure(['data', 'links']);
        $responseData = $response->json();
        $this->assertCount(20, $responseData['data']);
    }

    public function test_index_returns_410(): void
    {
        $response = $this->getJson(route('message.index'));
        $response->assertStatus(410);
    }
}
