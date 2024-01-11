<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pokemon;
use Faker\Factory as Faker;
class PokemonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            Pokemon::create([
                'name' => $faker->word,
                'type' => $faker->randomElement(['Fire', 'Water', 'Grass']),
                'level' => $faker->numberBetween(1, 100),
                'image_url' => $faker->imageUrl(),
                'price' => $faker->randomFloat(2, 0.1, 100),
                'rarity' => $faker->randomElement(['Common', 'Uncommon', 'Rare']),
                'quantity' => $faker->numberBetween(1, 100),
                'status' => $faker->randomElement([0, 1]),
                'user_id' => 1, 
            ]);
        }
    }
}
