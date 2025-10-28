<?php

namespace App\Notifications;

use App\Models\ConsultationRequest;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConsultationRequestConfirmation extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public ConsultationRequest $consultationRequest)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        // Set locale for user confirmation email (default to German)
        // TODO: Store user's locale preference in consultation_request and use it here
        app()->setLocale('de');

        $consultantName = Setting::get('consultant_name', 'Abdelaziz Kallel');
        $contactEmail = Setting::get('contact_email', 'info@abdelaziz-kallel.de');
        $contactPhone = Setting::get('contact_phone', '');

        // Get customizable email content from settings
        $subject = Setting::get('email_consultation_subject', 'Vielen Dank für Ihre Anfrage');
        $bodyTemplate = Setting::get('email_consultation_body');
        $footer = Setting::get('email_consultation_footer', 'Mit freundlichen Grüßen,');

        // Prepare placeholders
        $fullName = $this->consultationRequest->first_name.' '.$this->consultationRequest->last_name;
        $financialTopics = collect($this->consultationRequest->financial_topics)
            ->map(fn ($topic) => __($topic))
            ->join(', ');

        $notesText = '';
        if ($this->consultationRequest->additional_notes) {
            $notesText = '**'.__('Ihre Anmerkungen').':** '.$this->consultationRequest->additional_notes;
        }

        $phoneText = $contactPhone ? __('Telefon').': '.$contactPhone : '';

        // Replace placeholders in body template
        $placeholders = [
            '{name}' => $fullName,
            '{topics}' => $financialTopics,
            '{notes}' => $notesText,
            '{email}' => $contactEmail,
            '{phone}' => $phoneText,
        ];

        $body = str_replace(array_keys($placeholders), array_values($placeholders), $bodyTemplate);

        // Split body into lines and build mail message
        $mailMessage = (new MailMessage)->subject($subject);

        foreach (explode("\n", $body) as $line) {
            if (trim($line) !== '') {
                $mailMessage->line($line);
            }
        }

        $mailMessage->salutation($footer.' '.$consultantName);

        return $mailMessage;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'consultation_request_id' => $this->consultationRequest->id,
        ];
    }
}
