<?php

namespace Database\Seeders;

use App\Models\Category;
use Database\Factories\RoleFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     */
    public function run(): void
    {
        $this->call([
            CategoriesSeeder::class,
            UsersSeeder::class,
            ServicesSeeder::class,
            OrdersSeeder::class,
        ]);
    }
}
