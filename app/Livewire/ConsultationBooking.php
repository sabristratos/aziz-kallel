<?php

namespace App\Livewire;

use App\Models\ConsultationRequest;
use Livewire\Component;

class ConsultationBooking extends Component
{
    public $currentStep = 1;
    public $totalSteps = 4;

    // Step 1: Contact & Financial Topics
    public $name = '';
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
        'name' => 'required|min:2',
        'email' => 'required|email',
        'phone' => 'required|min:10',
        'financialTopics' => 'required|array|min:1',
        'meetingType' => 'required',
        'agreeToTerms' => 'accepted',
    ];

    protected $messages = [
        'name.required' => 'Das Feld Vor- und Nachname ist erforderlich.',
        'email.required' => 'Das Feld E-Mail-Adresse ist erforderlich.',
        'email.email' => 'Das Feld E-Mail-Adresse muss eine gültige E-Mail-Adresse sein.',
        'phone.required' => 'Das Feld Telefonnummer ist erforderlich.',
        'financialTopics.required' => 'Bitte wählen Sie mindestens ein Thema aus.',
        'meetingType.required' => 'Bitte wählen Sie eine Beratungsart aus.',
        'agreeToTerms.accepted' => 'Bitte stimmen Sie der Datenschutzerklärung zu.',
    ];

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
                    'name' => 'required|min:2',
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

        if (!empty($rules)) {
            $this->validate($rules);
        }
    }

    public function submit()
    {
        $this->validate();

        ConsultationRequest::create([
            'name' => $this->name,
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
        $this->reset(['currentStep', 'name', 'email', 'phone', 'financialTopics', 'meetingType', 'preferredContactMethod', 'timePreference', 'currentSituation', 'specificGoals', 'additionalNotes', 'agreeToTerms']);
    }

    public function render()
    {
        return view('livewire.consultation-booking');
    }
}
