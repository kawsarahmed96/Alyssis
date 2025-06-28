<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'md kawsar ali',
            'username' => 'mdkawsar',
            'email' => 'mdkawsar@gmail.com',
            'password' => '123456',
            'role' => 'admin',
            'status' => 'active',

        ]);


        $this->call([
            DaySeeder::class,
            // MoodSeeder::class,
        ]);
    }
}
