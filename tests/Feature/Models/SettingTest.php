<?php

declare(strict_types=1);

namespace Tests\Feature\Models;

use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SettingTest extends TestCase
{
    use RefreshDatabase;

    public function test_preserves_existing_german_translation_when_updating_arabic_only(): void
    {
        Setting::set('test_setting', 'German Value', 'string', 'de');
        Setting::set('test_setting', 'Arabic Value', 'string', 'ar');

        $setting = Setting::where('key', 'test_setting')->first();

        $this->assertEquals('German Value', $setting->getTranslation('value', 'de'));
        $this->assertEquals('Arabic Value', $setting->getTranslation('value', 'ar'));
    }

    public function test_preserves_existing_arabic_translation_when_updating_german_only(): void
    {
        Setting::set('test_setting', 'German Value', 'string', 'de');
        Setting::set('test_setting', 'Arabic Value', 'string', 'ar');

        Setting::set('test_setting', 'Updated German', 'string', 'de');

        $setting = Setting::where('key', 'test_setting')->first();

        $this->assertEquals('Updated German', $setting->getTranslation('value', 'de'));
        $this->assertEquals('Arabic Value', $setting->getTranslation('value', 'ar'));
    }

    public function test_preserves_existing_translations_when_updating_with_current_locale(): void
    {
        $this->app->setLocale('de');

        Setting::set('test_setting', 'German Value', 'string', 'de');
        Setting::set('test_setting', 'Arabic Value', 'string', 'ar');

        Setting::set('test_setting', 'Updated via Current Locale');

        $setting = Setting::where('key', 'test_setting')->first();

        $this->assertEquals('Updated via Current Locale', $setting->getTranslation('value', 'de'));
        $this->assertEquals('Arabic Value', $setting->getTranslation('value', 'ar'));
    }

    public function test_updates_current_locale_when_no_locale_parameter_is_provided(): void
    {
        $this->app->setLocale('ar');

        Setting::set('test_setting', 'German Value', 'string', 'de');

        Setting::set('test_setting', 'Arabic from Current Locale');

        $setting = Setting::where('key', 'test_setting')->first();

        $this->assertEquals('German Value', $setting->getTranslation('value', 'de'));
        $this->assertEquals('Arabic from Current Locale', $setting->getTranslation('value', 'ar'));
    }

    public function test_allows_clearing_a_locale_value_with_empty_string(): void
    {
        Setting::set('test_setting', 'German Value', 'string', 'de');
        Setting::set('test_setting', 'Arabic Value', 'string', 'ar');

        Setting::set('test_setting', '', 'string', 'de');

        $setting = Setting::where('key', 'test_setting')->first();

        $this->assertEquals('', $setting->getTranslation('value', 'de'));
        $this->assertEquals('Arabic Value', $setting->getTranslation('value', 'ar'));
    }

    public function test_creates_new_setting_with_translation_when_key_does_not_exist(): void
    {
        Setting::set('new_setting', 'New German Value', 'string', 'de');

        $setting = Setting::where('key', 'new_setting')->first();

        $this->assertNotNull($setting);
        $this->assertEquals('New German Value', $setting->getTranslation('value', 'de'));
        $this->assertEquals('string', $setting->type);
    }

    public function test_retrieves_value_for_specified_locale(): void
    {
        Setting::set('test_setting', 'German Value', 'string', 'de');
        Setting::set('test_setting', 'Arabic Value', 'string', 'ar');

        $this->assertEquals('German Value', Setting::get('test_setting', null, 'de'));
        $this->assertEquals('Arabic Value', Setting::get('test_setting', null, 'ar'));
    }

    public function test_retrieves_value_for_current_locale_when_no_locale_specified(): void
    {
        $this->app->setLocale('ar');

        Setting::set('test_setting', 'German Value', 'string', 'de');
        Setting::set('test_setting', 'Arabic Value', 'string', 'ar');

        $this->assertEquals('Arabic Value', Setting::get('test_setting'));
    }

    public function test_returns_default_value_when_setting_does_not_exist(): void
    {
        $this->assertEquals('default value', Setting::get('nonexistent', 'default value'));
    }

    public function test_returns_empty_string_when_translation_does_not_exist_for_locale(): void
    {
        Setting::set('test_setting', 'German Only', 'string', 'de');

        // Spatie Translatable returns empty string for missing translations
        $this->assertEquals('', Setting::get('test_setting', 'fallback', 'ar'));
    }

    public function test_properly_stores_translations_as_json_in_database(): void
    {
        Setting::set('test_setting', 'German Value', 'string', 'de');
        Setting::set('test_setting', 'Arabic Value', 'string', 'ar');

        $setting = Setting::where('key', 'test_setting')->first();
        $translations = $setting->getTranslations('value');

        $this->assertIsArray($translations);
        $this->assertArrayHasKey('de', $translations);
        $this->assertArrayHasKey('ar', $translations);
        $this->assertEquals('German Value', $translations['de']);
        $this->assertEquals('Arabic Value', $translations['ar']);
    }

    public function test_handles_multiple_setting_updates_without_losing_data(): void
    {
        Setting::set('hero_title', 'Willkommen', 'string', 'de');
        Setting::set('hero_title', 'مرحبا', 'string', 'ar');

        Setting::set('hero_subtitle', 'Finanzberatung', 'string', 'de');
        Setting::set('hero_subtitle', 'الاستشارات المالية', 'string', 'ar');

        Setting::set('hero_title', 'Willkommen zurück', 'string', 'de');

        $heroTitle = Setting::where('key', 'hero_title')->first();
        $heroSubtitle = Setting::where('key', 'hero_subtitle')->first();

        $this->assertEquals('Willkommen zurück', $heroTitle->getTranslation('value', 'de'));
        $this->assertEquals('مرحبا', $heroTitle->getTranslation('value', 'ar'));
        $this->assertEquals('Finanzberatung', $heroSubtitle->getTranslation('value', 'de'));
        $this->assertEquals('الاستشارات المالية', $heroSubtitle->getTranslation('value', 'ar'));
    }
}
