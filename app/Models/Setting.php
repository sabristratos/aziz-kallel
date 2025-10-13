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

        // If locale is specified, set translation
        if ($locale && in_array('value', $setting->translatable)) {
            $setting->setTranslation('value', $locale, $value);
        } else {
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

        // Logo conversions
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
