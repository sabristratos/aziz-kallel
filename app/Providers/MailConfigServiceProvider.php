<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Override mail configuration with database values
        try {
            // Check if settings table exists (avoid errors during migrations)
            if (! Schema::hasTable('settings')) {
                return;
            }

            // Map setting keys to config paths
            $mailConfigMap = [
                'mail_mailer' => 'mail.default',
                'mail_host' => 'mail.mailers.smtp.host',
                'mail_port' => 'mail.mailers.smtp.port',
                'mail_username' => 'mail.mailers.smtp.username',
                'mail_password' => 'mail.mailers.smtp.password',
                'mail_encryption' => 'mail.mailers.smtp.encryption',
                'mail_from_address' => 'mail.from.address',
                'mail_from_name' => 'mail.from.name',
            ];

            // Load and set each mail configuration from database
            foreach ($mailConfigMap as $settingKey => $configPath) {
                $value = Setting::get($settingKey);

                if ($value !== null) {
                    config()->set($configPath, $value);
                }
            }
        } catch (\Exception $e) {
            // Silently fail if settings can't be loaded (e.g., during installation)
            report($e);
        }
    }
}
