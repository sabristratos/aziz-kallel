<?php

namespace App\Livewire;

use App\Models\Testimonial;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SubmitReview extends Component
{
    // Form fields
    public $consulting_rating = 0;

    public $satisfaction_rating = 0;

    public $service_rating = 0;

    public $title = '';

    public $content = '';

    public $client_name = '';

    public $customer_since = '';

    // UI state
    public $submitted = false;

    public $showModal = false;

    protected $rules = [
        'consulting_rating' => 'required|integer|min:1|max:5',
        'satisfaction_rating' => 'required|integer|min:1|max:5',
        'service_rating' => 'required|integer|min:1|max:5',
        'title' => 'nullable|string|max:100',
        'content' => 'required|string|min:10|max:300',
        'client_name' => 'required|string|min:2|max:100',
        'customer_since' => 'nullable|string',
    ];

    protected function messages()
    {
        return [
            'consulting_rating.required' => __('Bitte bewerten Sie die Beratungskompetenz.'),
            'consulting_rating.min' => __('Bitte wählen Sie mindestens 1 Stern.'),
            'satisfaction_rating.required' => __('Bitte bewerten Sie Ihre Zufriedenheit.'),
            'satisfaction_rating.min' => __('Bitte wählen Sie mindestens 1 Stern.'),
            'service_rating.required' => __('Bitte bewerten Sie die Servicequalität.'),
            'service_rating.min' => __('Bitte wählen Sie mindestens 1 Stern.'),
            'content.required' => __('Bitte schreiben Sie einen Kommentar.'),
            'content.min' => __('Der Kommentar muss mindestens :min Zeichen lang sein.', ['min' => 10]),
            'content.max' => __('Der Kommentar darf maximal :max Zeichen lang sein.', ['max' => 300]),
            'client_name.required' => __('Bitte geben Sie Ihren Namen an.'),
        ];
    }

    public function submit()
    {
        $this->validate();

        // Calculate average rating
        $averageRating = (int) round(
            ($this->consulting_rating + $this->satisfaction_rating + $this->service_rating) / 3
        );

        // Create testimonial with pending status
        Testimonial::create([
            'client_name' => $this->client_name,
            'title' => [
                'de' => $this->title,
                'ar' => $this->title,
            ],
            'content' => [
                'de' => $this->content,
                'ar' => $this->content,
            ],
            'rating' => $averageRating,
            'consulting_rating' => $this->consulting_rating,
            'satisfaction_rating' => $this->satisfaction_rating,
            'service_rating' => $this->service_rating,
            'customer_since' => $this->customer_since,
            'status' => 'pending',
            'submitted_at' => now(),
            'is_active' => false,
            'sort_order' => 0,
        ]);

        $this->submitted = true;
        $this->showModal = false;

        $this->reset([
            'consulting_rating',
            'satisfaction_rating',
            'service_rating',
            'title',
            'content',
            'client_name',
            'customer_since',
        ]);

        // Reset submitted state after 3 seconds
        $this->dispatch('review-submitted');
    }

    public function openModal()
    {
        $this->showModal = true;
        $this->submitted = false;
    }

    #[Computed]
    public function testimonials()
    {
        return Testimonial::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
    }

    public function render()
    {
        // Generate years from 2009 to current year
        $years = range(2009, date('Y'));
        rsort($years);

        return view('livewire.submit-review', [
            'years' => $years,
        ]);
    }
}
