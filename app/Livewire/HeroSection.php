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

        // Get hero image with fallback to original image
        $heroImageSetting = Setting::where('key', 'hero_section_image')->first();

        $profilePhoto = $heroImageSetting?->getFirstMediaUrl('hero_section_image', 'high_quality') ?: asset('abdelaziz-kallel-2.png');

        return view('livewire.hero-section', [
            'heroTitle' => $heroTitle,
            'heroSubtitle' => $heroSubtitle,
            'consultantName' => $consultantName,
            'consultantRating' => $consultantRating,
            'profilePhoto' => $profilePhoto,
        ]);
    }
}
