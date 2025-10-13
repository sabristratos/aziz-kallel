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
        // Create hardcoded admin user
        User::create([
            'name' => 'Abdelaziz Kallel',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        // Seed financial consultant data
        $this->call([
            SettingsSeeder::class,
            TestimonialsSeeder::class,
            FaqSeeder::class,
            ProfilePhotoSeeder::class,
        ]);
    }
}
