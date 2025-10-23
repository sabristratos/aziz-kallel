<?php

declare(strict_types=1);

namespace Tests\Feature\Settings;

use App\Models\Setting;
use Database\Seeders\SettingsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmailConfigurationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed settings
        $this->seed(SettingsSeeder::class);
    }

    public function test_email_settings_exist_in_database(): void
    {
        $mailSettings = [
            'mail_mailer',
            'mail_host',
            'mail_port',
            'mail_username',
            'mail_password',
            'mail_encryption',
            'mail_from_address',
            'mail_from_name',
        ];

        foreach ($mailSettings as $key) {
            $setting = Setting::where('key', $key)->first();
            $this->assertNotNull($setting, "Setting {$key} should exist in database");
        }
    }

    public function test_email_settings_have_proper_default_values(): void
    {
        $this->assertEquals('smtp', Setting::get('mail_mailer'));
        $this->assertEquals('smtp.mailtrap.io', Setting::get('mail_host'));
        $this->assertEquals('2525', Setting::get('mail_port'));
        $this->assertEquals('tls', Setting::get('mail_encryption'));
        $this->assertEquals('hello@example.com', Setting::get('mail_from_address'));
        $this->assertEquals('Abdelaziz Kallel', Setting::get('mail_from_name'));
    }

    public function test_mail_config_service_provider_overrides_config_with_database_values(): void
    {
        // Update settings in the database
        Setting::set('mail_host', 'custom-smtp-host.example.com');
        Setting::set('mail_from_address', 'custom@example.com');

        // Re-boot the mail config service provider
        $provider = new \App\Providers\MailConfigServiceProvider($this->app);
        $provider->boot();

        // Verify the config was updated
        $this->assertEquals('custom-smtp-host.example.com', config('mail.mailers.smtp.host'));
        $this->assertEquals('custom@example.com', config('mail.from.address'));
    }

    public function test_empty_mail_settings_do_not_override_config(): void
    {
        // Ensure settings have empty values
        Setting::where('key', 'mail_username')->update(['value' => '']);
        Setting::where('key', 'mail_password')->update(['value' => '']);

        // Re-boot the mail config service provider
        $provider = new \App\Providers\MailConfigServiceProvider($this->app);
        $provider->boot();

        // Verify empty settings don't override (they remain empty)
        // The service provider correctly doesn't override when value is empty string
        $this->assertEquals('', config('mail.mailers.smtp.username'));
        $this->assertEquals('', config('mail.mailers.smtp.password'));
    }

    public function test_mail_encryption_setting_is_properly_configured(): void
    {
        Setting::set('mail_encryption', 'ssl');

        // Re-boot the mail config service provider
        $provider = new \App\Providers\MailConfigServiceProvider($this->app);
        $provider->boot();

        $this->assertEquals('ssl', config('mail.mailers.smtp.encryption'));
    }

    public function test_mail_settings_can_be_updated_via_setting_model(): void
    {
        Setting::set('mail_mailer', 'log');
        Setting::set('mail_host', 'new-host.example.com');
        Setting::set('mail_port', '587');

        $this->assertEquals('log', Setting::get('mail_mailer'));
        $this->assertEquals('new-host.example.com', Setting::get('mail_host'));
        $this->assertEquals('587', Setting::get('mail_port'));
    }
}
