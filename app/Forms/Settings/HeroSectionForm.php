<?php

namespace App\Forms\Settings;

use App\Forms\TranslatableForm;
use App\Models\Setting;

class HeroSectionForm extends TranslatableForm
{
    public string $hero_title_de = '';

    public string $hero_title_ar = '';

    public string $hero_subtitle_de = '';

    public string $hero_subtitle_ar = '';

    public string $hero_description_de = '';

    public string $hero_description_ar = '';

    public function rules(): array
    {
        return [
            'hero_title_de' => 'required|string|max:255',
            'hero_title_ar' => 'nullable|string|max:255',
            'hero_subtitle_de' => 'required|string|max:255',
            'hero_subtitle_ar' => 'nullable|string|max:255',
            'hero_description_de' => 'required|string',
            'hero_description_ar' => 'nullable|string',
        ];
    }

    public function save(): void
    {
        $this->validate();

        $settings = [
            'hero_title' => $this->getTranslatable('hero_title'),
            'hero_subtitle' => $this->getTranslatable('hero_subtitle'),
            'hero_description' => $this->getTranslatable('hero_description'),
        ];

        foreach ($settings as $key => $translations) {
            $setting = Setting::firstOrCreate(['key' => $key], ['type' => 'string']);

            $existingTranslations = $setting->getTranslations('value');

            $mergedTranslations = array_merge($existingTranslations, $translations);

            $setting->setTranslations('value', $mergedTranslations);
            $setting->save();
        }
    }
}
