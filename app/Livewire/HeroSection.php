<?php

namespace App\Livewire;

use App\Models\Setting;
use Livewire\Component;

class HeroSection extends Component
{
    public function render()
    {
        // Get hero data from settings
        $heroTitle = Setting::where('key', 'hero_title')->first()?->value;
        $heroSubtitle = Setting::where('key', 'hero_subtitle')->first()?->value;
        $consultantName = Setting::where('key', 'consultant_name')->first()?->value;
        $consultantRating = Setting::where('key', 'consultant_rating')->first()?->value;

        // Get profile photo
        $profilePhotoSetting = Setting::where('key', 'consultant_profile_photo')->first();
        $profilePhoto = $profilePhotoSetting?->getFirstMediaUrl('profile_photo', 'high_quality');

        return view('livewire.hero-section', [
            'heroTitle' => $heroTitle,
            'heroSubtitle' => $heroSubtitle,
            'consultantName' => $consultantName,
            'consultantRating' => $consultantRating,
            'profilePhoto' => $profilePhoto,
        ]);
    }
}
