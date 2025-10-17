<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class SabriUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Sabri',
            'email' => 'sabri@stratosdigital.io',
            'password' => bcrypt('Sabrenski2024'),
            'email_verified_at' => now(),
        ]);
    }
}
