<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsultationRequest extends Model
{
    protected $fillable = [
        'name',
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

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }
}
