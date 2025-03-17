<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++){
            DB::table('groups')->insert([
                'name' => fake()->words(2, true),
                'address' => fake()->streetAddress(),
                'city' => fake()->city(),
                'postcode' => fake()->postcode(),
                'activity1' => fake()->numberBetween(1, 9),
//                'activity2' => fake()->numberBetween(1, 9),
                'activity3' => fake()->numberBetween(1, 9),
                'description' => fake()->paragraphs(3, true),
                'image' => fake()->imageUrl(),
                'contact_name' => fake()->name(),
                'contact_email' => fake()->email()
            ]);
        }
    }
}
