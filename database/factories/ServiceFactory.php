<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoriesIds = Category::pluck('id')->toArray();

        $sellersIds = User::join('roles', 'users.role_id', '=', 'roles.id')
            ->where('roles.name', 'seller')
            ->get('users.id');



        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->text(1500),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'user_id' => $this->faker->randomElement($sellersIds),
            'category_id' => $this->faker->randomElement($categoriesIds),
        ];
    }
}
