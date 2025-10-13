<?php

namespace App\Livewire;

use App\Models\ConsultationRequest;
use Livewire\Component;

class ConsultationBooking extends Component
{
    public $currentStep = 1;

    public $totalSteps = 4;

    // Step 1: Contact & Financial Topics
    public $first_name = '';

    public $last_name = '';

    public $email = '';

    public $phone = '';

    public $financialTopics = [];

    // Step 2: Meeting Preferences
    public $meetingType = '';

    public $preferredContactMethod = 'email';

    public $timePreference = '';

    // Step 3: Details & Goals
    public $currentSituation = '';

    public $specificGoals = '';

    public $additionalNotes = '';

    // Step 4: Terms
    public $agreeToTerms = false;

    // Success state
    public $submitted = false;

    protected $rules = [
        'first_name' => 'required|min:2',
        'last_name' => 'required|min:2',
        'email' => 'required|email',
        'phone' => 'required|min:10',
        'financialTopics' => 'required|array|min:1',
        'meetingType' => 'required',
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
            'meetingType.required' => __('Bitte wählen Sie eine Beratungsart aus.'),
            'agreeToTerms.accepted' => __('Bitte stimmen Sie den Nutzungsbedingungen zu.'),
        ];
    }

    public function nextStep()
    {
        $this->validateCurrentStep();

        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function goToStep($step)
    {
        if ($step <= $this->currentStep || $step == 1) {
            $this->currentStep = $step;
        }
    }

    private function validateCurrentStep()
    {
        $rules = [];

        switch ($this->currentStep) {
            case 1:
                $rules = [
                    'first_name' => 'required|min:2',
                    'last_name' => 'required|min:2',
                    'email' => 'required|email',
                    'phone' => 'required|min:10',
                    'financialTopics' => 'required|array|min:1',
                ];
                break;
            case 2:
                $rules = [
                    'meetingType' => 'required',
                ];
                break;
            case 3:
                // Optional fields, no validation required
                break;
            case 4:
                $rules = [
                    'agreeToTerms' => 'accepted',
                ];
                break;
        }

        if (! empty($rules)) {
            $this->validate($rules);
        }
    }

    public function submit()
    {
        $this->validate();

        ConsultationRequest::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'preferred_contact_method' => $this->preferredContactMethod,
            'financial_topics' => $this->financialTopics,
            'meeting_type' => $this->meetingType,
            'time_preference' => $this->timePreference,
            'current_situation' => $this->currentSituation,
            'specific_goals' => $this->specificGoals,
            'additional_notes' => $this->additionalNotes,
            'status' => 'pending',
        ]);

        $this->submitted = true;
        $this->reset(['currentStep', 'first_name', 'last_name', 'email', 'phone', 'financialTopics', 'meetingType', 'preferredContactMethod', 'timePreference', 'currentSituation', 'specificGoals', 'additionalNotes', 'agreeToTerms']);
    }

    public function render()
    {
        return view('livewire.consultation-booking');
    }
}
