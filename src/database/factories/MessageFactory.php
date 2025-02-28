<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'chat_id' => $this->faker->randomNumber(),
            'update_id' => $this->faker->unique()->randomNumber(),
            'user' => $this->faker->userName(),
            'text' => $this->faker->sentence(),
            'sent_at' => now(),
        ];
    }
}
