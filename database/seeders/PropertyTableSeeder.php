<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['Apartment', 'House', 'Condo', 'Townhouse', 'Villa'] as $type) {
            PropertyType::create(['name' => $type]);
        }

        // foreach (['Pool', 'Garage', 'Garden', 'Fireplace', 'Basement', 'Solar Panels', 'Gym', 'Balcony', 'Security System', 'Air Conditioning'] as $tag) {
        //     Tag::create(['name' => $tag]);
        // }

        foreach (["Air Conditioning", "Lawn", "TV Cable", "Dryer", "Outdoor Shower", "Washer", "Lake view", "Wine cellar", "Front yard", "Refrigerator",] as $feature) {
            Feature::create(['name' => $feature]);
        }

        Property::factory(300)->create();
    }
}
