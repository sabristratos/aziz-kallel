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
        // Create admin user from environment variables
        if (env('ADMIN_EMAIL') && env('ADMIN_PASSWORD')) {
            User::create([
                'name' => env('ADMIN_NAME', 'Admin'),
                'email' => env('ADMIN_EMAIL'),
                'password' => bcrypt(env('ADMIN_PASSWORD')),
                'email_verified_at' => now(),
            ]);
        }

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
