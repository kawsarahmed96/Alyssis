<?php

namespace Database\Seeders;

use App\Models\Mood;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $demo = [
            [
                'name' => 'Happy',
                'icon' => '😊',
            ],
            [
                'name' => 'Sad',
                'icon' => '😢',
            ],
            [
                'name' => 'Angry',
                'icon' => '😠',
            ],
            [
                'name' => 'Excited',
                'icon' => '🤩',
            ],
            [
                'name' => 'Relaxed',
                'icon' => '😌',
            ],
        ];


        foreach ($demo as $mood) {
            Mood::create([
                'name' => $mood['name'],
                'icon' => $mood['icon'],
            ]);
        }
      
    }
}
