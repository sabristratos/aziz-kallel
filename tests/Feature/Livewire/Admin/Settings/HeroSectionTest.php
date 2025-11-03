<?php

namespace Tests\Feature\Livewire\Admin\Settings;

use App\Livewire\Admin\Settings\HeroSection;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class HeroSectionTest extends TestCase
{
    use RefreshDatabase;

    public function test_renders_successfully(): void
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(HeroSection::class)
            ->assertStatus(200);
    }

    public function test_loads_existing_hero_section_translations(): void
    {
        $this->actingAs(User::factory()->create());

        Setting::set('hero_title', ['de' => 'German Title', 'ar' => 'Arabic Title']);
        Setting::set('hero_subtitle', ['de' => 'German Subtitle', 'ar' => 'Arabic Subtitle']);
        Setting::set('hero_description', ['de' => 'German Description', 'ar' => 'Arabic Description']);

        Livewire::test(HeroSection::class)
            ->assertSet('form.hero_title_de', 'German Title')
            ->assertSet('form.hero_title_ar', 'Arabic Title')
            ->assertSet('form.hero_subtitle_de', 'German Subtitle')
            ->assertSet('form.hero_subtitle_ar', 'Arabic Subtitle')
            ->assertSet('form.hero_description_de', 'German Description')
            ->assertSet('form.hero_description_ar', 'Arabic Description');
    }

    public function test_can_switch_between_languages(): void
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(HeroSection::class)
            ->assertSet('currentLanguage', 'de')
            ->call('switchLanguage', 'ar')
            ->assertSet('currentLanguage', 'ar')
            ->call('switchLanguage', 'de')
            ->assertSet('currentLanguage', 'de');
    }

    public function test_can_save_hero_section_settings(): void
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(HeroSection::class)
            ->set('form.hero_title_de', 'New German Title')
            ->set('form.hero_title_ar', 'New Arabic Title')
            ->set('form.hero_subtitle_de', 'New German Subtitle')
            ->set('form.hero_subtitle_ar', 'New Arabic Subtitle')
            ->set('form.hero_description_de', 'New German Description')
            ->set('form.hero_description_ar', 'New Arabic Description')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertEquals('New German Title', Setting::get('hero_title'));

        app()->setLocale('ar');
        $this->assertEquals('New Arabic Title', Setting::get('hero_title'));
    }

    public function test_validates_required_german_fields(): void
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(HeroSection::class)
            ->set('form.hero_title_de', '')
            ->set('form.hero_subtitle_de', '')
            ->set('form.hero_description_de', '')
            ->call('save')
            ->assertHasErrors([
                'form.hero_title_de' => 'required',
                'form.hero_subtitle_de' => 'required',
                'form.hero_description_de' => 'required',
            ]);
    }

    public function test_allows_arabic_fields_to_be_optional(): void
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(HeroSection::class)
            ->set('form.hero_title_de', 'German Title')
            ->set('form.hero_subtitle_de', 'German Subtitle')
            ->set('form.hero_description_de', 'German Description')
            ->set('form.hero_title_ar', '')
            ->set('form.hero_subtitle_ar', '')
            ->set('form.hero_description_ar', '')
            ->call('save')
            ->assertHasNoErrors();
    }

    public function test_preserves_german_when_updating_arabic(): void
    {
        $this->actingAs(User::factory()->create());

        Setting::set('hero_title', ['de' => 'Original German', 'ar' => 'Original Arabic']);
        Setting::set('hero_subtitle', ['de' => 'Original Subtitle', 'ar' => 'Original Arabic Subtitle']);
        Setting::set('hero_description', ['de' => 'Original Description', 'ar' => 'Original Arabic Description']);

        Livewire::test(HeroSection::class)
            ->set('form.hero_title_ar', 'Updated Arabic')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertEquals('Original German', Setting::get('hero_title'));

        app()->setLocale('ar');
        $this->assertEquals('Updated Arabic', Setting::get('hero_title'));
    }

    public function test_preserves_arabic_when_updating_german(): void
    {
        $this->actingAs(User::factory()->create());

        Setting::set('hero_title', ['de' => 'Original German', 'ar' => 'Original Arabic']);
        Setting::set('hero_subtitle', ['de' => 'Original Subtitle', 'ar' => 'Original Arabic Subtitle']);
        Setting::set('hero_description', ['de' => 'Original Description', 'ar' => 'Original Arabic Description']);

        Livewire::test(HeroSection::class)
            ->set('form.hero_title_de', 'Updated German')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertEquals('Updated German', Setting::get('hero_title'));

        app()->setLocale('ar');
        $this->assertEquals('Original Arabic', Setting::get('hero_title'));
    }

    public function test_handles_empty_settings_gracefully(): void
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(HeroSection::class)
            ->assertSet('form.hero_title_de', '')
            ->assertSet('form.hero_title_ar', '')
            ->assertSet('form.hero_subtitle_de', '')
            ->assertSet('form.hero_subtitle_ar', '')
            ->assertSet('form.hero_description_de', '')
            ->assertSet('form.hero_description_ar', '');
    }

    public function test_shows_success_toast_after_saving(): void
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(HeroSection::class)
            ->set('form.hero_title_de', 'Test Title')
            ->set('form.hero_subtitle_de', 'Test Subtitle')
            ->set('form.hero_description_de', 'Test Description')
            ->call('save')
            ->assertDispatched('toast');
    }
}
