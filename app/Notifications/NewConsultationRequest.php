<?php

namespace App\Notifications;

use App\Models\ConsultationRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewConsultationRequest extends Notification implements ShouldQueue
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
        $financialTopics = collect($this->consultationRequest->financial_topics)
            ->map(fn ($topic) => __($topic))
            ->join(', ');

        return (new MailMessage)
            ->subject(__('Neue Beratungsanfrage'))
            ->greeting(__('Neue Beratungsanfrage erhalten'))
            ->line(__('Sie haben eine neue Beratungsanfrage erhalten:'))
            ->line('**'.__('Name').':** '.$this->consultationRequest->name)
            ->line('**'.__('E-Mail').':** '.$this->consultationRequest->email)
            ->line('**'.__('Telefon').':** '.$this->consultationRequest->phone)
            ->line('**'.__('Bevorzugte Kontaktmethode').':** '.__(ucfirst($this->consultationRequest->preferred_contact_method)))
            ->line('**'.__('Beratungsart').':** '.__(ucfirst($this->consultationRequest->meeting_type)))
            ->line('**'.__('Finanzthemen').':** '.$financialTopics)
            ->lineIf($this->consultationRequest->time_preference, '**'.__('Zeitpräferenz').':** '.$this->consultationRequest->time_preference)
            ->lineIf($this->consultationRequest->current_situation, '**'.__('Aktuelle Situation').':** '.$this->consultationRequest->current_situation)
            ->lineIf($this->consultationRequest->specific_goals, '**'.__('Spezifische Ziele').':** '.$this->consultationRequest->specific_goals)
            ->lineIf($this->consultationRequest->additional_notes, '**'.__('Zusätzliche Notizen').':** '.$this->consultationRequest->additional_notes)
            ->action(__('Anfrage ansehen'), route('admin.consultation-requests'))
            ->line(__('Bitte antworten Sie dem Kunden so schnell wie möglich.'));
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
            'name' => $this->consultationRequest->name,
            'email' => $this->consultationRequest->email,
        ];
    }
}
