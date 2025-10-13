<?php

namespace Tests\Feature\Admin\Settings;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_requires_authentication_to_access_settings_page(): void
    {
        $this->get(route('admin.settings'))
            ->assertRedirect(route('login'));
    }

    public function test_can_access_settings_page_when_authenticated(): void
    {
        $this->actingAs(User::factory()->create());

        $this->get(route('admin.settings'))
            ->assertSuccessful()
            ->assertSee('Website Settings')
            ->assertSee('Categories');
    }

    public function test_displays_settings_grouped_by_category(): void
    {
        $this->actingAs(User::factory()->create());

        Setting::set('consultant_name', ['de' => 'Test Name'], 'string');
        Setting::set('hero_title', ['de' => 'Test Title', 'ar' => 'عنوان الاختبار'], 'string');

        $this->get(route('admin.settings'))
            ->assertSuccessful()
            ->assertSee('Personal Information')
            ->assertSee('Hero Section');
    }

    public function test_displays_settings_with_translations(): void
    {
        $this->actingAs(User::factory()->create());

        // Create a setting in the personal category which is the default selected category
        Setting::set('consultant_name', ['de' => 'German Name', 'ar' => 'اسم عربي'], 'string');

        $this->get(route('admin.settings'))
            ->assertSuccessful()
            ->assertSee('German Name')
            ->assertSee('German')
            ->assertSee('Arabic');
    }

    public function test_can_edit_translatable_setting_inline(): void
    {
        $this->actingAs(User::factory()->create());

        Setting::set('hero_title', ['de' => 'Old Title', 'ar' => 'عنوان قديم'], 'string');

        \Livewire\Livewire::test(\App\Livewire\Admin\Settings\Index::class)
            ->set('editValues.hero_title', ['de' => 'New Title', 'ar' => 'عنوان جديد'])
            ->call('saveSetting', 'hero_title');

        $setting = Setting::where('key', 'hero_title')->first();
        $this->assertEquals('New Title', $setting->getTranslation('value', 'de'));
        $this->assertEquals('عنوان جديد', $setting->getTranslation('value', 'ar'));
    }

    public function test_can_edit_german_value_only(): void
    {
        $this->actingAs(User::factory()->create());

        Setting::set('consultant_name', ['de' => 'Old Name', 'ar' => 'اسم قديم'], 'string');

        \Livewire\Livewire::test(\App\Livewire\Admin\Settings\Index::class)
            ->set('editValues.consultant_name', ['de' => 'New Name', 'ar' => ''])
            ->call('saveSetting', 'consultant_name');

        $setting = Setting::where('key', 'consultant_name')->first();
        $this->assertEquals('New Name', $setting->getTranslation('value', 'de'));
    }

    public function test_validates_german_value_is_required(): void
    {
        $this->actingAs(User::factory()->create());

        Setting::set('consultant_name', ['de' => 'Test Name'], 'string');

        \Livewire\Livewire::test(\App\Livewire\Admin\Settings\Index::class)
            ->set('editValues.consultant_name', ['de' => '', 'ar' => 'اسم عربي'])
            ->call('saveSetting', 'consultant_name')
            ->assertHasErrors(['editValues.consultant_name.de']);
    }

    public function test_validates_values_must_be_strings(): void
    {
        $this->actingAs(User::factory()->create());

        Setting::set('consultant_name', ['de' => 'Test Name'], 'string');

        \Livewire\Livewire::test(\App\Livewire\Admin\Settings\Index::class)
            ->set('editValues.consultant_name', ['de' => 123, 'ar' => ''])
            ->call('saveSetting', 'consultant_name')
            ->assertHasErrors(['editValues.consultant_name.de']);
    }

    public function test_saves_setting_successfully(): void
    {
        $this->actingAs(User::factory()->create());

        Setting::set('consultant_name', ['de' => 'Test Name'], 'string');

        \Livewire\Livewire::test(\App\Livewire\Admin\Settings\Index::class)
            ->set('editValues.consultant_name', ['de' => 'Updated Name', 'ar' => ''])
            ->call('saveSetting', 'consultant_name');

        $setting = Setting::where('key', 'consultant_name')->first();
        $this->assertEquals('Updated Name', $setting->getTranslation('value', 'de'));
    }

    public function test_language_switcher_changes_current_language(): void
    {
        $this->actingAs(User::factory()->create());

        \Livewire\Livewire::test(\App\Livewire\Admin\Settings\Index::class)
            ->assertSet('currentLanguage', 'de')
            ->call('switchLanguage', 'ar')
            ->assertSet('currentLanguage', 'ar');
    }

    public function test_displays_inline_inputs_for_settings(): void
    {
        $this->actingAs(User::factory()->create());

        Setting::set('consultant_name', ['de' => 'Test Name'], 'string');

        $this->get(route('admin.settings'))
            ->assertSuccessful()
            ->assertSee('Save'); // Check for Save button
    }

    public function test_category_navigation_works(): void
    {
        $this->actingAs(User::factory()->create());

        Setting::set('consultant_name', ['de' => 'Name'], 'string');
        Setting::set('hero_title', ['de' => 'Title'], 'string');

        \Livewire\Livewire::test(\App\Livewire\Admin\Settings\Index::class)
            ->assertSet('selectedCategory', 'personal')
            ->call('selectCategory', 'hero')
            ->assertSet('selectedCategory', 'hero');
    }
}
