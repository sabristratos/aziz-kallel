<?php

namespace App\Livewire\Admin\Settings;

use App\Forms\Settings\HeroSectionForm;
use App\Models\Setting;
use Flux\Flux;
use Livewire\Component;

class HeroSection extends Component
{
    public HeroSectionForm $form;

    public string $currentLanguage = 'de';

    public function mount(): void
    {
        $translations = [
            'hero_title' => Setting::where('key', 'hero_title')->first()?->getTranslations('value') ?? [],
            'hero_subtitle' => Setting::where('key', 'hero_subtitle')->first()?->getTranslations('value') ?? [],
            'hero_description' => Setting::where('key', 'hero_description')->first()?->getTranslations('value') ?? [],
        ];

        $this->form->fillFromTranslations(
            ['hero_title', 'hero_subtitle', 'hero_description'],
            $translations
        );
    }

    public function switchLanguage(string $language): void
    {
        $this->currentLanguage = $language;
    }

    public function save(): void
    {
        $this->form->save();

        Flux::toast(variant: 'success', text: __('Hero section updated successfully'));
    }

    public function render()
    {
        return view('livewire.admin.settings.hero-section')
            ->layout('components.layouts.app', [
                'title' => __('Hero Section Settings'),
            ]);
    }
}
