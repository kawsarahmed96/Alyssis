<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $days = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];

        foreach ($days as $day) {
           DB::table('days')->insert([
                'days' => $day,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
