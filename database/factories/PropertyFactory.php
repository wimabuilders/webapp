<?php

namespace Database\Factories;

use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    public function definition(): array
    {
        $cities = ['New York', 'Los Angeles', 'Chicago', 'Houston', 'Phoenix', 'Philadelphia', 'San Antonio', 'San Diego', 'Dallas', 'San Jose'];

        return [
            'id' => (string) Str::uuid(),
            'title' => fake()->sentence(6, true),
            'city' => fake()->randomElement($cities),
            'location' => fake()->address(),
            'user_id' => User::inRandomOrder()->first()->id,
            'bed' => fake()->numberBetween(1, 10),
            'bath' => fake()->numberBetween(1, 10),
            'sqft' => fake()->numberBetween(500, 10000),
            'price' => fake()->randomFloat(2, 50000, 10000000),
            'for_rent' => fake()->boolean(),
            'property_type_id' => PropertyType::inRandomOrder()->first()->id,
            'year' => fake()->year(),
            'featured' => fake()->boolean(10), // 10% chance to be featured
            'lat' => fake()->latitude(),
            'long' => fake()->longitude(),
            'created_at' => fake()->dateTimeBetween('-2 years', 'now'),
            'updated_at' => fake()->dateTimeBetween('now', '+1 year'),
        ];
    }
}
