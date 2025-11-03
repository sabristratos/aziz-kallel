<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Setting extends Model implements HasMedia
{
    use HasTranslations;
    use InteractsWithMedia;

    protected $fillable = [
        'key',
        'value',
        'type',
    ];

    public array $translatable = ['value'];

    public static function get(string $key, mixed $default = null, ?string $locale = null): mixed
    {
        $setting = static::where('key', $key)->first();

        if (! $setting) {
            return $default;
        }

        // Get the current locale if none specified
        $locale = $locale ?? app()->getLocale();

        // For translatable values, use the Spatie translatable method
        if (in_array('value', $setting->translatable)) {
            return $setting->getTranslation('value', $locale) ?? $default;
        }

        return $setting->value ?? $default;
    }

    public static function set(string $key, mixed $value, string $type = 'string', ?string $locale = null): void
    {
        $setting = static::firstOrCreate(['key' => $key], ['type' => $type]);

        // If the value field is translatable, always preserve existing translations
        if (in_array('value', $setting->translatable)) {
            // If locale is specified, update only that locale
            if ($locale) {
                $setting->setTranslation('value', $locale, $value);
            } else {
                // If no locale specified, update current locale without overwriting others
                $currentLocale = app()->getLocale();
                $setting->setTranslation('value', $currentLocale, $value);
            }
        } else {
            // For non-translatable fields, set value directly
            $setting->value = $value;
        }

        $setting->type = $type;
        $setting->save();
    }

    public function scopeByKey($query, string $key)
    {
        return $query->where('key', $key);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profile_photo')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection('site_logo')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml']);

        $this->addMediaCollection('hero_section_image')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection('header_dropdown_avatar')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection('about_section_image')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(300)
            ->height(300)
            ->sharpen(10);

        $this->addMediaConversion('avatar')
            ->width(150)
            ->height(150)
            ->sharpen(10);

        $this->addMediaConversion('high_quality')
            ->width(1000)
            ->height(1000)
            ->sharpen(10)
            ->quality(90)
            ->format('png');

        $this->addMediaConversion('social')
            ->width(1200)
            ->height(630)
            ->background('#1d4587')
            ->fit('contain', 1200, 630)
            ->sharpen(10)
            ->quality(90)
            ->format('jpg');

        // Logo conversions
        $this->addMediaConversion('favicon')
            ->width(32)
            ->height(32)
            ->sharpen(10)
            ->format('png');

        $this->addMediaConversion('logo-sm')
            ->width(80)
            ->height(80)
            ->sharpen(10)
            ->keepOriginalImageFormat();

        $this->addMediaConversion('logo-md')
            ->width(150)
            ->height(150)
            ->sharpen(10)
            ->keepOriginalImageFormat();

        $this->addMediaConversion('logo-lg')
            ->width(300)
            ->height(300)
            ->sharpen(10)
            ->quality(95)
            ->keepOriginalImageFormat();
    }
}
