<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $usersIds = User::pluck("id")->toArray();
        $servicesIds = Service::pluck("id")->toArray();

        $status = $this->faker->randomElement(["pending", "done", "cancelled"]);

        return [
            'user_id' => $this->faker->randomElement($usersIds),
            'service_id' => $this->faker->randomElement($servicesIds),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'status' => $status,
            "review_type" => $status === "done" ? $this->faker->randomElement(['positive', 'negative']) : null,
            "review_content" => $status === "done" ? $this->faker->text : null,
        ];
    }
}
