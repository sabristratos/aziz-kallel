<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilePhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a setting entry that will hold the profile photo
        $profilePhotoSetting = Setting::updateOrCreate(
            ['key' => 'consultant_profile_photo'],
            [
                'value' => ['de' => 'Profilfoto von Abdelaziz Kallel'],
                'type' => 'media'
            ]
        );

        // Check if the profile photo file exists
        $photoPath = public_path('abdelaziz-kallel.png');

        if (file_exists($photoPath)) {
            // Clear any existing media
            $profilePhotoSetting->clearMediaCollection('profile_photo');

            // Add the profile photo from the public directory
            $profilePhotoSetting
                ->addMedia($photoPath)
                ->preservingOriginal()
                ->toMediaCollection('profile_photo');

            $this->command->info('Profile photo attached successfully to settings.');
        } else {
            $this->command->warn('Profile photo not found at: ' . $photoPath);
        }
    }
}
