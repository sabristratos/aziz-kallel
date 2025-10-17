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
        // Create hardcoded admin users
        User::create([
            'name' => 'Abdelaziz Kallel',
            'email' => 'admin@example.com',
            'password' => bcrypt('password1234'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Sabri',
            'email' => 'sabri@stratosdigital.io',
            'password' => bcrypt('Sabrenski2024'),
            'email_verified_at' => now(),
        ]);

        // Seed financial consultant data
        $this->call([
            SettingsSeeder::class,
            TestimonialsSeeder::class,
            FaqSeeder::class,
            ProfilePhotoSeeder::class,
            LogoSeeder::class,
        ]);
    }
}
