<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    public function definition(): array
    {
        $propertyTypes = ['Apartment', 'House', 'Condo', 'Townhouse', 'Villa'];
        $cities = ['New York', 'Los Angeles', 'Chicago', 'Houston', 'Phoenix', 'Philadelphia', 'San Antonio', 'San Diego', 'Dallas', 'San Jose'];

        // Generate random tags
        $availableTags = ['Pool', 'Garage', 'Garden', 'Fireplace', 'Basement', 'Solar Panels', 'Gym', 'Balcony', 'Security System', 'Air Conditioning'];
        $selectedTags = fake()->randomElements($availableTags, fake()->numberBetween(1, 5));

        return [
            'id' => (string) Str::uuid(),
            'title' => fake()->optional()->sentence(6, true),
            'city' => fake()->optional()->randomElement($cities),
            'location' => fake()->optional()->address(),
            'bed' => fake()->optional()->numberBetween(1, 10),
            'bath' => fake()->optional()->numberBetween(1, 10),
            'sqft' => fake()->optional()->numberBetween(500, 10000),
            'price' => fake()->randomFloat(2, 50000, 10000000),
            'for_rent' => fake()->boolean(),
            'type' => fake()->optional()->randomElement($propertyTypes),
            'year' => fake()->optional()->year(),
            'featured' => fake()->boolean(10), // 10% chance to be featured
            'lat' => fake()->optional()->latitude(),
            'long' => fake()->optional()->longitude(),
            'created_at' => fake()->dateTimeBetween('-2 years', 'now'),
            'updated_at' => fake()->dateTimeBetween('now', '+1 year'),
        ];
    }
}
