<?php

namespace Tests\Feature\Settings;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImpressumEditingTest extends TestCase
{
    use RefreshDatabase;

    public function test_impressum_content_setting_exists_in_database(): void
    {
        // Create the setting first
        Setting::set('impressum_content', ['de' => 'German Content', 'ar' => 'Arabic Content'], 'text');

        $setting = Setting::where('key', 'impressum_content')->first();

        $this->assertNotNull($setting);
        $this->assertEquals('text', $setting->type);
        $this->assertArrayHasKey('de', $setting->getTranslations('value'));
        $this->assertArrayHasKey('ar', $setting->getTranslations('value'));
    }

    public function test_legal_category_appears_in_admin_settings(): void
    {
        $this->actingAs(User::factory()->create());

        \Livewire\Livewire::test(\App\Livewire\Admin\Settings\Index::class)
            ->assertSee('Legal Content');
    }

    public function test_impressum_content_can_be_edited_in_german(): void
    {
        $this->actingAs(User::factory()->create());

        Setting::set('impressum_content', ['de' => 'Old Content', 'ar' => 'محتوى قديم'], 'text');

        $newContent = '<p>Updated German Impressum Content</p>';

        \Livewire\Livewire::test(\App\Livewire\Admin\Settings\Index::class)
            ->set('selectedCategory', 'legal')
            ->set('currentLanguage', 'de')
            ->set('editValues.impressum_content', ['de' => $newContent, 'ar' => 'محتوى قديم'])
            ->call('saveSetting', 'impressum_content')
            ->assertHasNoErrors();

        $setting = Setting::where('key', 'impressum_content')->first();
        $this->assertEquals($newContent, $setting->getTranslation('value', 'de'));
    }

    public function test_impressum_content_can_be_edited_in_arabic(): void
    {
        $this->actingAs(User::factory()->create());

        Setting::set('impressum_content', ['de' => 'Old Content', 'ar' => 'محتوى قديم'], 'text');

        $newContent = '<p dir="rtl">محتوى الإعلان القانوني المحدث</p>';

        \Livewire\Livewire::test(\App\Livewire\Admin\Settings\Index::class)
            ->set('selectedCategory', 'legal')
            ->set('currentLanguage', 'ar')
            ->set('editValues.impressum_content', ['de' => 'Old Content', 'ar' => $newContent])
            ->call('saveSetting', 'impressum_content')
            ->assertHasNoErrors();

        $setting = Setting::where('key', 'impressum_content')->first();
        $this->assertEquals($newContent, $setting->getTranslation('value', 'ar'));
    }

    public function test_impressum_page_displays_content_from_database(): void
    {
        Setting::set('impressum_content', ['de' => '<p>Test Impressum Content - Abdelaziz Kallel</p>'], 'text');

        $response = $this->get('/de/impressum');

        $response->assertOk();
        $response->assertSee('Abdelaziz Kallel', false);
    }

    public function test_impressum_page_displays_arabic_content_when_locale_is_arabic(): void
    {
        Setting::set('impressum_content', ['de' => 'German Content', 'ar' => '<p dir="rtl">محتوى عربي - عبد العزيز</p>'], 'text');

        $response = $this->get('/ar/impressum');

        $response->assertOk();
        $response->assertSee('عبد العزيز', false);
    }

    public function test_legal_category_is_accessible(): void
    {
        Setting::set('impressum_content', ['de' => 'German Content', 'ar' => 'Arabic Content'], 'text');

        $this->actingAs(User::factory()->create());

        \Livewire\Livewire::test(\App\Livewire\Admin\Settings\Index::class)
            ->set('selectedCategory', 'legal')
            ->assertSet('selectedCategory', 'legal')
            ->assertSee('Impressum Content');
    }
}
