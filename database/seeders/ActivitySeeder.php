<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('activities')->insert([
            [
                'activity' => 'Music and singing',
            ],
            [
                'activity' => 'Arts and crafts',
            ],
            [
                'activity' => 'Drama and theatre',
            ],
            [
                'activity' => 'Dance',
            ],
            [
                'activity' => 'Gardening',
            ],

        ]);

    }
}
