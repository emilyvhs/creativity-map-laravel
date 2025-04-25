<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('groups')->insert([
            [
                'name' => 'Down To Earth',
                'address' => 'Electric Daisy, 1-4 Bold Lane',
                'city' => 'Derby',
                'postcode' => 'DE1 3NT',
                'activity1' => 5,
                'activity2' => 2,
                'description' => 'A community garden with activities for the whole family',
                'image' => 'https://placehold.co/400',
                'contact_name' => fake()->name(),
                'contact_email' => fake()->email(),
                'approved' => true,

        ],
            [
                'name' => 'Djanogly Community Orchestra',
                'address' => 'Djanogly Learning Trust, Sherwood Rise, Nottingham Road',
                'city' => 'Nottingham',
                'postcode' => 'NG7 7AR',
                'activity1' => 1,
                'activity2' => null,
                'description' => 'A friendly amateur orchestra based in Nottingham',
                'image' => 'https://placehold.co/400',
                'contact_name' => fake()->name(),
                'contact_email' => fake()->email(),
                'approved' => true,
            ],

            [
                'name' => 'Stitch n Bitch',
                'address' => 'Tonne, 1-3 St Martins Walk',
                'city' => 'Leicester',
                'postcode' => 'LE1 5DG',
                'activity1' => 2,
                'activity2' => null,
                'description' => 'A relaxed group for crafters of all abilities',
                'image' => 'https://placehold.co/400',
                'contact_name' => fake()->name(),
                'contact_email' => fake()->email(),
                'approved' => true,
            ],

            [
                'name' => 'Derby Shakespeare Theatre Company',
                'address' => 'Shakespeare House, 93 Kedleston Road',
                'city' => 'Derby',
                'postcode' => 'DE22 1FR',
                'activity1' => 3,
                'activity2' => null,
                'description' => 'One of the oldest amateur theatre companies in the UK',
                'image' => 'https://placehold.co/400',
                'contact_name' => fake()->name(),
                'contact_email' => fake()->email(),
                'approved' => true,
            ],

            [
                'name' => 'Acoustic Hearts',
                'address' => 'Edenderry Library, 43 JKL Street',
                'city' => 'Edenderry',
                'postcode' => null,
                'activity1' => 1,
                'activity2' => null,
                'description' => 'An informal music group aimed at people aged 60+',
                'image' => 'https://placehold.co/400',
                'contact_name' => fake()->name(),
                'contact_email' => fake()->email(),
                'approved' => true,
            ],

            [
                'name' => 'Afton Dance Club',
                'address' => 'Juniper Green Parish Church Hall, 498 Lanark Road',
                'city' => 'Edinburgh',
                'postcode' => 'EH12 8AY',
                'activity1' => 4,
                'activity2' => null,
                'description' => 'Ballroom and Latin American dance classes for all levels',
                'image' => 'https://placehold.co/400',
                'contact_name' => fake()->name(),
                'contact_email' => fake()->email(),
                'approved' => true,
            ],

            [
                'name' => 'St Fagans Sketching Group',
                'address' => 'St Fagans National Museum of History',
                'city' => 'Cardiff',
                'postcode' => 'CF5 6XB',
                'activity1' => 2,
                'activity2' => null,
                'description' => 'An informal sketching group with materials provided',
                'image' => 'https://placehold.co/400',
                'contact_name' => fake()->name(),
                'contact_email' => fake()->email(),
                'approved' => true,
            ],

        ]);
    }
}
