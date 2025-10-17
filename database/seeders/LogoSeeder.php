<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a setting entry that will hold the site logo
        $logoSetting = Setting::updateOrCreate(
            ['key' => 'site_logo'],
            [
                'value' => null,
                'type' => 'media',
            ]
        );

        // Check if the logo file exists
        $logoPath = public_path('abdelaziz-logo.jpg');

        if (file_exists($logoPath)) {
            // Clear any existing media
            $logoSetting->clearMediaCollection('site_logo');

            // Add the logo from the public directory
            $logoSetting
                ->addMedia($logoPath)
                ->preservingOriginal()
                ->toMediaCollection('site_logo');

            $this->command->info('Site logo attached successfully to settings.');
        } else {
            $this->command->warn('Site logo not found at: '.$logoPath);
        }
    }
}
