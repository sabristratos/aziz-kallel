<?php

namespace App\Livewire;

use App\Models\ConsultationRequest;
use Livewire\Component;

class ConsultationBooking extends Component
{
    // Contact & Financial Topics
    public $first_name = '';

    public $last_name = '';

    public $email = '';

    public $phone = '';

    public $financialTopics = [];

    // Additional Notes
    public $additionalNotes = '';

    // Terms
    public $agreeToTerms = false;

    // Success state
    public $submitted = false;

    protected $rules = [
        'first_name' => 'required|min:2',
        'last_name' => 'required|min:2',
        'email' => 'required|email',
        'phone' => 'required|min:10',
        'financialTopics' => 'required|array|min:1',
        'agreeToTerms' => 'accepted',
    ];

    protected function messages()
    {
        return [
            'first_name.required' => __('Das Feld Vorname ist erforderlich.'),
            'last_name.required' => __('Das Feld Nachname ist erforderlich.'),
            'email.required' => __('Das Feld E-Mail-Adresse ist erforderlich.'),
            'email.email' => __('Das Feld E-Mail-Adresse muss eine gültige E-Mail-Adresse sein.'),
            'phone.required' => __('Das Feld Telefonnummer ist erforderlich.'),
            'financialTopics.required' => __('Bitte wählen Sie mindestens ein Thema aus.'),
            'agreeToTerms.accepted' => __('Bitte stimmen Sie den Nutzungsbedingungen zu.'),
        ];
    }

    public function submit()
    {
        $this->validate();

        ConsultationRequest::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'financial_topics' => $this->financialTopics,
            'additional_notes' => $this->additionalNotes,
            'status' => 'pending',
        ]);

        $this->submitted = true;
        $this->reset(['first_name', 'last_name', 'email', 'phone', 'financialTopics', 'additionalNotes', 'agreeToTerms']);
    }

    public function render()
    {
        return view('livewire.consultation-booking');
    }
}
