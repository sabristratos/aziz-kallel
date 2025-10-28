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
        'financial_topics',
        'additional_notes',
        'status',
    ];

    protected $casts = [
        'financial_topics' => 'array',
    ];

    protected static function booted(): void
    {
        static::created(function (ConsultationRequest $consultationRequest) {
            // Get contact email from settings (always use 'de' locale for system emails)
            $contactEmail = Setting::get('contact_email', null, 'de');

            if ($contactEmail) {
                // Send notification to the contact email (admin)
                Notification::route('mail', $contactEmail)
                    ->notify(new NewConsultationRequest($consultationRequest));
            }

            // Send confirmation email to the user
            Notification::route('mail', $consultationRequest->email)
                ->notify(new \App\Notifications\ConsultationRequestConfirmation($consultationRequest));
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
