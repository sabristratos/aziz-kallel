<?php

namespace App\Models;

use App\Notifications\NewConsultationRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;

class ConsultationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'preferred_contact_method',
        'financial_topics',
        'meeting_type',
        'preferred_dates',
        'time_preference',
        'current_situation',
        'specific_goals',
        'additional_notes',
        'status',
    ];

    protected $casts = [
        'financial_topics' => 'array',
        'preferred_dates' => 'array',
    ];

    protected static function booted(): void
    {
        static::created(function (ConsultationRequest $consultationRequest) {
            // Get contact email from settings
            $contactEmail = Setting::where('key', 'contact_email')->first()?->value;

            if ($contactEmail) {
                // Send notification to the contact email
                Notification::route('mail', $contactEmail)
                    ->notify(new NewConsultationRequest($consultationRequest));
            }
        });
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}
