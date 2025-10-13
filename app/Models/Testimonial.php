<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model implements HasMedia
{
    use HasFactory;
    use HasTranslations;
    use InteractsWithMedia;

    protected $fillable = [
        'client_name',
        'title',
        'content',
        'rating',
        'consulting_rating',
        'satisfaction_rating',
        'service_rating',
        'customer_since',
        'status',
        'submitted_at',
        'is_active',
        'order',
    ];

    public array $translatable = ['content', 'title'];

    protected $casts = [
        'is_active' => 'boolean',
        'rating' => 'integer',
        'consulting_rating' => 'integer',
        'satisfaction_rating' => 'integer',
        'service_rating' => 'integer',
        'order' => 'integer',
        'submitted_at' => 'datetime',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(150)
            ->height(150)
            ->sharpen(10);

        $this->addMediaConversion('avatar')
            ->width(80)
            ->height(80)
            ->sharpen(10);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Calculate average rating from individual ratings
     */
    public function getAverageRatingAttribute(): ?int
    {
        $ratings = array_filter([
            $this->consulting_rating,
            $this->satisfaction_rating,
            $this->service_rating,
        ]);

        if (empty($ratings)) {
            return null;
        }

        return (int) round(array_sum($ratings) / count($ratings));
    }
}
