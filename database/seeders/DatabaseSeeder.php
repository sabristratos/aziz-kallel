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
        // Create admin user
        User::factory()->create([
            'name' => 'Abdelaziz Kallel',
            'email' => 'abdelaziz.kallel@dvag.de',
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
