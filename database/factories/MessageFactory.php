<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $receiverRole = $this->faker->randomElement(['seller', 'customer']);

        $sender = User::query()->where('role_id', 2)->inRandomOrder()->first();

        $receiver = User::where('id', '!=', "2")->inRandomOrder()->first();

        return [
            'sender_id' => $sender->id,
            'receiver_id' => $receiver->id,
            'content' => $this->faker->paragraph,
            'have_been_read' => $this->faker->boolean,
        ];
    }
}
