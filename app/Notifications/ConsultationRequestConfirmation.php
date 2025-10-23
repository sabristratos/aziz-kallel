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
        $consultantName = Setting::get('consultant_name', 'Abdelaziz Kallel');
        $contactEmail = Setting::get('contact_email', 'info@abdelaziz-kallel.de');
        $contactPhone = Setting::get('contact_phone', '');

        $financialTopics = collect($this->consultationRequest->financial_topics)
            ->map(fn ($topic) => __($topic))
            ->join(', ');

        return (new MailMessage)
            ->subject(__('Vielen Dank für Ihre Anfrage'))
            ->greeting(__('Guten Tag :name,', ['name' => $this->consultationRequest->first_name.' '.$this->consultationRequest->last_name]))
            ->line(__('vielen Dank für Ihr Interesse an einer persönlichen Finanzberatung. Ihre Anfrage ist bei uns eingegangen.'))
            ->line(__('**Ihre ausgewählten Themen:**'))
            ->line($financialTopics)
            ->line(__('Ich werde mich innerhalb der nächsten 24-48 Stunden bei Ihnen melden, um einen passenden Termin für ein unverbindliches Beratungsgespräch zu vereinbaren.'))
            ->line(__('In diesem Gespräch können wir Ihre finanzielle Situation und Ihre Ziele ausführlich besprechen und gemeinsam die beste Lösung für Sie entwickeln.'))
            ->lineIf($this->consultationRequest->additional_notes, __('**Ihre Anmerkungen:** :notes', ['notes' => $this->consultationRequest->additional_notes]))
            ->line(__('Sollten Sie vorab Fragen haben, können Sie mich gerne kontaktieren:'))
            ->line(__('E-Mail: :email', ['email' => $contactEmail]))
            ->lineIf($contactPhone, __('Telefon: :phone', ['phone' => $contactPhone]))
            ->line(__('Ich freue mich auf unser Gespräch!'))
            ->salutation(__('Mit freundlichen Grüßen,').' '.$consultantName);
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
