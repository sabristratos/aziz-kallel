<?php

namespace App\Console\Commands;

use App\Models\Setting;
use Illuminate\Console\Command;

class SyncSettings extends Command
{
    protected $signature = 'settings:sync
                            {--force : Skip confirmation prompt}
                            {--overwrite : Overwrite existing settings (use with caution in production)}';

    protected $description = 'Sync settings from config/site_settings.php to database (only creates missing settings by default)';

    public function handle(): int
    {
        $settings = config('site_settings');
        $overwrite = $this->option('overwrite');

        if (empty($settings)) {
            $this->error('No settings found in config/site_settings.php');

            return self::FAILURE;
        }

        $this->info('Found '.count($settings).' settings to sync.');

        if ($overwrite) {
            $this->warn('⚠️  OVERWRITE mode enabled - existing settings will be replaced with config values!');
        } else {
            $this->info('ℹ️  Running in safe mode - only missing settings will be created.');
        }

        if (! $this->option('force')) {
            $confirmMessage = $overwrite
                ? 'Are you sure you want to OVERWRITE existing settings?'
                : 'Do you want to create missing settings?';

            if (! $this->confirm($confirmMessage, ! $overwrite)) {
                $this->info('Sync cancelled.');

                return self::SUCCESS;
            }
        }

        $created = 0;
        $updated = 0;
        $existed = 0;
        $skipped = 0;

        $this->withProgressBar($settings, function ($setting) use (&$created, &$updated, &$existed, &$skipped, $overwrite) {
            // Skip media settings (they should be managed via admin panel)
            if ($setting['type'] === 'media') {
                $skipped++;

                return;
            }

            if ($overwrite) {
                // Overwrite mode: update existing or create new
                $model = Setting::updateOrCreate(
                    ['key' => $setting['key']],
                    [
                        'value' => $setting['value'],
                        'type' => $setting['type'],
                    ]
                );

                if ($model->wasRecentlyCreated) {
                    $created++;
                } else {
                    $updated++;
                }
            } else {
                // Safe mode: only create if doesn't exist
                $model = Setting::firstOrCreate(
                    ['key' => $setting['key']],
                    [
                        'value' => $setting['value'],
                        'type' => $setting['type'],
                    ]
                );

                if ($model->wasRecentlyCreated) {
                    $created++;
                } else {
                    $existed++;
                }
            }
        });

        $this->newLine(2);

        if ($overwrite) {
            $this->info("✓ Created {$created} new settings.");
            $this->info("✓ Updated {$updated} existing settings.");
        } else {
            $this->info("✓ Created {$created} new settings.");
            if ($existed > 0) {
                $this->comment("→ {$existed} settings already exist (preserved).");
            }
        }

        if ($skipped > 0) {
            $this->comment("→ Skipped {$skipped} media settings (managed via admin panel).");
        }

        return self::SUCCESS;
    }
}
