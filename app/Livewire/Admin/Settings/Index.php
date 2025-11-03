<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Setting;
use Flux\Flux;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public string $selectedCategory = 'personal';

    public string $currentLanguage = 'de';

    public array $editValues = [];

    public array $mediaFiles = [];

    public string $testEmailAddress = '';

    public bool $showTestEmailModal = false;

    public array $categories = [
        'personal' => ['label' => 'Personal Information', 'keys' => ['consultant_name', 'consultant_title', 'consultant_credentials', 'consultant_experience', 'consultant_team_size', 'consultant_rating']],
        'contact' => ['label' => 'Contact Information', 'keys' => ['contact_address_street', 'contact_address_city', 'contact_phone', 'contact_mobile', 'contact_email']],
        'company' => ['label' => 'Company Information', 'keys' => ['company_name']],
        'hero' => ['label' => 'Hero Section', 'keys' => ['hero_title', 'hero_subtitle', 'hero_description']],
        'about' => ['label' => 'About Section', 'keys' => ['about_benefit_1_title', 'about_benefit_1_description', 'about_benefit_2_title', 'about_benefit_2_description', 'about_benefit_3_title', 'about_benefit_3_description', 'about_benefit_4_title', 'about_benefit_4_description']],
        'landing' => ['label' => 'Landing Page', 'keys' => ['landing_headline', 'landing_lede', 'landing_meta_title', 'landing_meta_description']],
        'seo' => ['label' => 'SEO/Meta', 'keys' => ['meta_title', 'meta_description']],
        'images' => ['label' => 'Images', 'keys' => ['site_logo', 'consultant_profile_photo', 'hero_section_image', 'header_dropdown_avatar', 'about_section_image']],
        'legal' => ['label' => 'Legal Content', 'keys' => ['impressum_content']],
        'email' => ['label' => 'Email Configuration', 'keys' => ['mail_mailer', 'mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_encryption', 'mail_from_address', 'mail_from_name', 'email_consultation_subject', 'email_consultation_body', 'email_consultation_footer']],
    ];

    public function mount(): void
    {
        // Initialize edit values for all settings
        $emailCustomizationKeys = ['email_consultation_subject', 'email_consultation_body', 'email_consultation_footer'];
        $mailConfigKeys = ['mail_mailer', 'mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_encryption', 'mail_from_address', 'mail_from_name'];

        foreach (Setting::all() as $setting) {
            $isMailConfig = in_array($setting->key, $mailConfigKeys);

            if ($isMailConfig) {
                $this->editValues[$setting->key] = $setting->value ?? '';
            } else {
                $this->editValues[$setting->key] = $setting->getTranslations('value');
            }
        }
    }

    #[Computed]
    public function settings()
    {
        return Setting::query()->orderBy('key')->get()->keyBy('key');
    }

    #[Computed]
    public function categorySettings()
    {
        $keys = $this->categories[$this->selectedCategory]['keys'] ?? [];
        $mailConfigKeys = ['mail_mailer', 'mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_encryption', 'mail_from_address', 'mail_from_name'];

        return $this->settings->filter(fn ($setting) => in_array($setting->key, $keys))->map(function ($setting) use ($mailConfigKeys) {
            return [
                'key' => $setting->key,
                'type' => $setting->type,
                'value' => $setting->value,
                'translations' => $setting->getTranslations('value'),
                'isMailConfig' => in_array($setting->key, $mailConfigKeys),
                'isMedia' => $setting->type === 'media',
                'setting' => $setting,
            ];
        });
    }

    public function selectCategory(string $category): void
    {
        $this->selectedCategory = $category;
    }

    public function switchLanguage(string $language): void
    {
        $this->currentLanguage = $language;
    }

    public function saveCategory(): void
    {
        $keys = $this->categories[$this->selectedCategory]['keys'] ?? [];
        $mailConfigKeys = ['mail_mailer', 'mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_encryption', 'mail_from_address', 'mail_from_name'];

        // Identify which fields have actually changed
        $changedKeys = [];
        foreach ($keys as $key) {
            $setting = Setting::where('key', $key)->first();
            if (! $setting) {
                continue;
            }

            $isMailConfig = in_array($key, $mailConfigKeys);
            $isMediaSetting = $setting->type === 'media';

            // Check if this field has been modified
            $hasChanged = false;

            if ($isMediaSetting && isset($this->mediaFiles[$key])) {
                $hasChanged = true;
            } elseif ($isMailConfig && isset($this->editValues[$key])) {
                $hasChanged = ($this->editValues[$key] !== $setting->value);
            } elseif (! $isMediaSetting && isset($this->editValues[$key])) {
                // For translatable fields, check if any locale changed
                $currentTranslations = $setting->getTranslations('value');
                foreach (['de', 'ar'] as $locale) {
                    if (isset($this->editValues[$key][$locale])) {
                        $currentValue = $currentTranslations[$locale] ?? '';
                        $newValue = $this->editValues[$key][$locale];
                        if ($currentValue !== $newValue) {
                            $hasChanged = true;
                            break;
                        }
                    }
                }
            }

            if ($hasChanged) {
                $changedKeys[] = $key;
            }
        }

        // If no changes, return early
        if (empty($changedKeys)) {
            Flux::toast(variant: 'info', text: __('No changes to save'));

            return;
        }

        // Build validation rules only for changed fields
        $rules = [];
        foreach ($changedKeys as $key) {
            $setting = Setting::where('key', $key)->first();
            if (! $setting) {
                continue;
            }

            $isMailConfig = in_array($key, $mailConfigKeys);
            $isMediaSetting = $setting->type === 'media';

            if ($isMediaSetting && isset($this->mediaFiles[$key])) {
                $rules["mediaFiles.{$key}"] = 'required|image|max:10240';
            } elseif ($isMailConfig) {
                $rules["editValues.{$key}"] = 'required|string';
            } else {
                $rules["editValues.{$key}.de"] = 'required|string';
                $rules["editValues.{$key}.ar"] = 'nullable|string';
            }
        }

        // Validate changed fields
        $this->validate($rules);

        // Save only changed settings
        foreach ($changedKeys as $key) {
            $setting = Setting::where('key', $key)->first();
            if (! $setting) {
                continue;
            }

            $isMailConfig = in_array($key, $mailConfigKeys);
            $isMediaSetting = $setting->type === 'media';

            if ($isMailConfig) {
                $setting->update(['value' => $this->editValues[$key]]);
            } elseif (! $isMediaSetting) {
                // Build complete translations array to prevent overwrites
                $translations = $setting->getTranslations('value');

                // Only update locales that are present and not empty in editValues
                foreach (['de', 'ar'] as $locale) {
                    if (isset($this->editValues[$key][$locale]) && ! empty($this->editValues[$key][$locale])) {
                        $translations[$locale] = $this->editValues[$key][$locale];
                    }
                }

                // Update all translations atomically
                $setting->setTranslations('value', $translations);
                $setting->save();
            }

            // Handle media upload
            if (isset($this->mediaFiles[$key]) && $setting->type === 'media') {
                $collectionName = $key;
                $setting->clearMediaCollection($collectionName);
                $setting->addMedia($this->mediaFiles[$key]->getRealPath())
                    ->usingName(ucwords(str_replace('_', ' ', $key)))
                    ->toMediaCollection($collectionName);

                unset($this->mediaFiles[$key]);
            }
        }

        // Reload mail config if in email category
        if ($this->selectedCategory === 'email') {
            $this->reloadMailConfig();
        }

        $savedCount = count($changedKeys);
        Flux::toast(variant: 'success', text: __('Saved :count settings successfully', ['count' => $savedCount]));
    }

    public function saveSetting(string $key): void
    {
        $setting = Setting::where('key', $key)->firstOrFail();
        $mailConfigKeys = ['mail_mailer', 'mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_encryption', 'mail_from_address', 'mail_from_name'];
        $isMailConfig = in_array($key, $mailConfigKeys);
        $isMediaSetting = $setting->type === 'media';

        // Validate based on setting type
        if ($isMediaSetting) {
            // Media settings: optional file upload (can save without uploading new file)
            if (isset($this->mediaFiles[$key])) {
                $this->validate([
                    "mediaFiles.{$key}" => 'required|image|max:10240', // max 10MB
                ]);
            }
        } elseif ($isMailConfig) {
            $this->validate([
                "editValues.{$key}" => 'required|string',
            ]);

            $setting->update(['value' => $this->editValues[$key]]);
            $this->reloadMailConfig();
        } else {
            $this->validate([
                "editValues.{$key}.de" => 'required|string',
                "editValues.{$key}.ar" => 'nullable|string',
            ]);

            // Build complete translations array to prevent overwrites
            $translations = $setting->getTranslations('value');
            foreach (['de', 'ar'] as $locale) {
                // Only update if value is provided (not empty)
                if (! empty($this->editValues[$key][$locale])) {
                    $translations[$locale] = $this->editValues[$key][$locale];
                }
            }

            // Update all translations atomically
            $setting->setTranslations('value', $translations);
            $setting->save();
        }

        // Handle media upload
        if (isset($this->mediaFiles[$key]) && $setting->type === 'media') {
            $collectionName = $key;
            $setting->clearMediaCollection($collectionName);
            $setting->addMedia($this->mediaFiles[$key]->getRealPath())
                ->usingName(ucwords(str_replace('_', ' ', $key)))
                ->toMediaCollection($collectionName);

            unset($this->mediaFiles[$key]);
        }

        Flux::toast(variant: 'success', text: __('Setting saved successfully'));
    }

    public function removeMedia(string $key): void
    {
        $setting = Setting::where('key', $key)->firstOrFail();

        if ($setting->type !== 'media') {
            return;
        }

        $collectionName = $key;
        $setting->clearMediaCollection($collectionName);

        Flux::toast(variant: 'success', text: __('Image removed successfully'));
    }

    protected function reloadMailConfig(): void
    {
        // Override mail configuration with database values
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

        foreach ($mailConfigMap as $settingKey => $configPath) {
            $value = Setting::get($settingKey);

            if ($value !== null && $value !== '') {
                config()->set($configPath, $value);
            }
        }
    }

    public function openTestEmailModal(): void
    {
        $this->testEmailAddress = auth()->user()->email;
        $this->showTestEmailModal = true;
    }

    public function sendTestEmail(): void
    {
        $this->validate([
            'testEmailAddress' => 'required|email',
        ]);

        // Reload mail config to use latest settings
        $this->reloadMailConfig();

        try {
            \Mail::raw('This is a test email from your website. If you receive this, your email configuration is working correctly!', function ($message) {
                $message->to($this->testEmailAddress)
                    ->subject('Test Email - Email Configuration');
            });

            $this->showTestEmailModal = false;
            $this->reset(['testEmailAddress']);

            Flux::toast(variant: 'success', text: __('Test email sent successfully!'));
        } catch (\Exception $e) {
            Flux::toast(variant: 'danger', text: __('Failed to send email: ').$e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.settings.index')
            ->layout('components.layouts.app', [
                'title' => __('Website Settings'),
            ]);
    }
}
