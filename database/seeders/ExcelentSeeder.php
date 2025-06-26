<?php

namespace Database\Seeders;

use App\Models\Excelent;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ExcelentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $demo_excelent = [
            [
                'name' => 'work'
            ],
            [
                'name' => 'play'
            ],
            [
                'name' => 'sleep'
            ],
            [
                'name' => 'family'
            ],
            [
                'name' => 'exercise'
            ],
            [
                'name' => 'hobbies'
            ],
            [
                'name' => 'finance'
            ],
            [
                'name' => 'socialize'
            ],
            [
                'name' => 'drinks'
            ],
            [
                'name' => 'food'
            ],
            [
                'name' => 'travel'
            ],
            [
                'name' => 'learning'
            ],
            [
                'name' => 'Weather'
            ],
            [
                'name' => 'Health'
            ],
            [
                'name' => 'socilizing'
            ],
            [
                'name' => 'music'
            ],
            [
                'name' => 'Entertainment'
            ],
            [
                'name' => 'Technology'
            ],
            [
                'name' => 'movement'
            ],

        ];

        foreach ($demo_excelent as $excelent) {
          Excelent::create([
                'name' => $excelent['name'],
            ]);
        }
    }
}
