<?php

declare(strict_types=1);

namespace Tests\Feature\Livewire\Admin\Settings;

use App\Livewire\Admin\Settings\Index;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::factory()->create());
    }

    public function test_initializes_edit_values_with_both_locales_for_all_settings(): void
    {
        Setting::set('test_setting', 'German Value', 'string', 'de');
        Setting::set('test_setting', 'Arabic Value', 'string', 'ar');

        Livewire::test(Index::class)
            ->assertSet('editValues.test_setting.de', 'German Value')
            ->assertSet('editValues.test_setting.ar', 'Arabic Value');
    }

    public function test_initializes_edit_values_with_empty_strings_for_missing_locales(): void
    {
        Setting::set('partial_setting', 'German Only', 'string', 'de');

        Livewire::test(Index::class)
            ->assertSet('editValues.partial_setting.de', 'German Only')
            ->assertSet('editValues.partial_setting.ar', '');
    }

    public function test_preserves_arabic_when_updating_only_german(): void
    {
        Setting::set('hero_title', 'Original German', 'string', 'de');
        Setting::set('hero_title', 'Original Arabic', 'string', 'ar');

        Livewire::test(Index::class)
            ->set('selectedCategory', 'hero')
            ->set('editValues.hero_title.de', 'Updated German')
            ->set('editValues.hero_title.ar', 'Original Arabic')
            ->call('saveCategory')
            ->assertHasNoErrors();

        $setting = Setting::where('key', 'hero_title')->first();

        $this->assertEquals('Updated German', $setting->getTranslation('value', 'de'));
        $this->assertEquals('Original Arabic', $setting->getTranslation('value', 'ar'));
    }

    public function test_preserves_german_when_updating_only_arabic(): void
    {
        Setting::set('hero_title', 'Original German', 'string', 'de');
        Setting::set('hero_title', 'Original Arabic', 'string', 'ar');

        Livewire::test(Index::class)
            ->set('selectedCategory', 'hero')
            ->set('editValues.hero_title.de', 'Original German')
            ->set('editValues.hero_title.ar', 'Updated Arabic')
            ->call('saveCategory')
            ->assertHasNoErrors();

        $setting = Setting::where('key', 'hero_title')->first();

        $this->assertEquals('Original German', $setting->getTranslation('value', 'de'));
        $this->assertEquals('Updated Arabic', $setting->getTranslation('value', 'ar'));
    }

    public function test_updates_both_locales_when_both_are_changed(): void
    {
        Setting::set('hero_title', 'Original German', 'string', 'de');
        Setting::set('hero_title', 'Original Arabic', 'string', 'ar');

        Livewire::test(Index::class)
            ->set('selectedCategory', 'hero')
            ->set('editValues.hero_title.de', 'New German')
            ->set('editValues.hero_title.ar', 'New Arabic')
            ->call('saveCategory')
            ->assertHasNoErrors();

        $setting = Setting::where('key', 'hero_title')->first();

        $this->assertEquals('New German', $setting->getTranslation('value', 'de'));
        $this->assertEquals('New Arabic', $setting->getTranslation('value', 'ar'));
    }

    public function test_allows_clearing_arabic_locale_value_with_empty_string(): void
    {
        Setting::set('hero_title', 'Original German', 'string', 'de');
        Setting::set('hero_title', 'Original Arabic', 'string', 'ar');

        Livewire::test(Index::class)
            ->set('selectedCategory', 'hero')
            ->set('editValues.hero_title.de', 'Original German')
            ->set('editValues.hero_title.ar', '')
            ->call('saveCategory')
            ->assertHasNoErrors();

        $setting = Setting::where('key', 'hero_title')->first();

        $this->assertEquals('Original German', $setting->getTranslation('value', 'de'));
        $this->assertEquals('', $setting->getTranslation('value', 'ar'));
    }

    public function test_preserves_unchanged_settings_when_updating_others(): void
    {
        Setting::set('hero_title', 'Title German', 'string', 'de');
        Setting::set('hero_title', 'Title Arabic', 'string', 'ar');
        Setting::set('hero_subtitle', 'Subtitle German', 'string', 'de');
        Setting::set('hero_subtitle', 'Subtitle Arabic', 'string', 'ar');

        Livewire::test(Index::class)
            ->set('selectedCategory', 'hero')
            ->set('editValues.hero_title.de', 'Updated Title German')
            ->set('editValues.hero_title.ar', 'Title Arabic')
            ->call('saveCategory')
            ->assertHasNoErrors();

        $titleSetting = Setting::where('key', 'hero_title')->first();
        $subtitleSetting = Setting::where('key', 'hero_subtitle')->first();

        $this->assertEquals('Updated Title German', $titleSetting->getTranslation('value', 'de'));
        $this->assertEquals('Title Arabic', $titleSetting->getTranslation('value', 'ar'));
        $this->assertEquals('Subtitle German', $subtitleSetting->getTranslation('value', 'de'));
        $this->assertEquals('Subtitle Arabic', $subtitleSetting->getTranslation('value', 'ar'));
    }

    public function test_preserves_arabic_when_updating_only_german_via_save_setting(): void
    {
        Setting::set('hero_title', 'Original German', 'string', 'de');
        Setting::set('hero_title', 'Original Arabic', 'string', 'ar');

        Livewire::test(Index::class)
            ->set('editValues.hero_title.de', 'Updated German')
            ->set('editValues.hero_title.ar', 'Original Arabic')
            ->call('saveSetting', 'hero_title')
            ->assertHasNoErrors();

        $setting = Setting::where('key', 'hero_title')->first();

        $this->assertEquals('Updated German', $setting->getTranslation('value', 'de'));
        $this->assertEquals('Original Arabic', $setting->getTranslation('value', 'ar'));
    }

    public function test_preserves_german_when_updating_only_arabic_via_save_setting(): void
    {
        Setting::set('hero_title', 'Original German', 'string', 'de');
        Setting::set('hero_title', 'Original Arabic', 'string', 'ar');

        Livewire::test(Index::class)
            ->set('editValues.hero_title.de', 'Original German')
            ->set('editValues.hero_title.ar', 'Updated Arabic')
            ->call('saveSetting', 'hero_title')
            ->assertHasNoErrors();

        $setting = Setting::where('key', 'hero_title')->first();

        $this->assertEquals('Original German', $setting->getTranslation('value', 'de'));
        $this->assertEquals('Updated Arabic', $setting->getTranslation('value', 'ar'));
    }

    public function test_requires_german_translation_for_translatable_settings(): void
    {
        Setting::set('hero_title', 'Original German', 'string', 'de');

        Livewire::test(Index::class)
            ->set('editValues.hero_title.de', '')
            ->set('editValues.hero_title.ar', 'Arabic Value')
            ->call('saveSetting', 'hero_title')
            ->assertHasErrors(['editValues.hero_title.de']);
    }

    public function test_allows_optional_arabic_translation(): void
    {
        Setting::set('hero_title', 'Original German', 'string', 'de');

        Livewire::test(Index::class)
            ->set('editValues.hero_title.de', 'Valid German')
            ->set('editValues.hero_title.ar', '')
            ->call('saveSetting', 'hero_title')
            ->assertHasNoErrors();
    }
}
