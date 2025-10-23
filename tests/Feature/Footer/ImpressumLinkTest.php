<?php

namespace Tests\Feature\Footer;

use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImpressumLinkTest extends TestCase
{
    use RefreshDatabase;

    public function test_footer_impressum_link_includes_german_locale(): void
    {
        Setting::set('impressum_content', ['de' => 'Test Impressum'], 'text');

        $response = $this->get('/de');

        $response->assertOk();
        $response->assertSee('/de/impressum', false);
    }

    public function test_footer_impressum_link_includes_arabic_locale(): void
    {
        Setting::set('impressum_content', ['ar' => 'محتوى الإعلان القانوني'], 'text');

        $response = $this->get('/ar');

        $response->assertOk();
        $response->assertSee('/ar/impressum', false);
    }

    public function test_impressum_link_is_clickable_from_german_homepage(): void
    {
        Setting::set('impressum_content', ['de' => 'Test Impressum'], 'text');

        $response = $this->get('/de');
        $response->assertOk();

        // Follow the impressum link
        $response = $this->get('/de/impressum');
        $response->assertOk();
        $response->assertSee('Impressum', false);
    }

    public function test_impressum_link_is_clickable_from_arabic_homepage(): void
    {
        Setting::set('impressum_content', ['de' => 'German Content', 'ar' => 'محتوى الإعلان القانوني'], 'text');

        $response = $this->get('/ar');
        $response->assertOk();

        // Follow the impressum link
        $response = $this->get('/ar/impressum');
        $response->assertOk();
        $response->assertSee('محتوى الإعلان القانوني', false);
    }

    public function test_impressum_without_locale_returns_404(): void
    {
        $response = $this->get('/impressum');

        $response->assertNotFound();
    }
}
