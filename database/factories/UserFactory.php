<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstname = $this->faker->firstName;
        $lastname = $this->faker->lastName;
        $email = strtolower($firstname) . strtoupper($lastname) . '@gmail.com';

        return [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'bio' => $this->faker->sentences(20, true),
            'role_id' => $this->faker->randomElement([1, 2]),
            'password' => Hash::make('password'),
        ];
    }
}
