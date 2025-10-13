<?php

namespace App\Livewire;

use App\Models\ConsultationRequest;
use App\Models\Faq;
use App\Models\Testimonial;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Dashboard extends Component
{
    #[Computed]
    public function totalTestimonials(): int
    {
        return Testimonial::count();
    }

    #[Computed]
    public function activeTestimonials(): int
    {
        return Testimonial::active()->count();
    }

    #[Computed]
    public function inactiveTestimonials(): int
    {
        return Testimonial::where('is_active', false)->count();
    }

    #[Computed]
    public function totalFaqs(): int
    {
        return Faq::count();
    }

    #[Computed]
    public function activeFaqs(): int
    {
        return Faq::active()->count();
    }

    #[Computed]
    public function inactiveFaqs(): int
    {
        return Faq::where('is_active', false)->count();
    }

    #[Computed]
    public function pendingConsultationRequests(): int
    {
        return ConsultationRequest::pending()->count();
    }

    #[Computed]
    public function recentConsultationRequests()
    {
        return ConsultationRequest::query()
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.dashboard')
            ->layout('components.layouts.app', [
                'title' => __('Dashboard'),
            ]);
    }
}
