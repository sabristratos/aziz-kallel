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
        // Always send admin notifications in German
        app()->setLocale('de');

        $financialTopics = collect($this->consultationRequest->financial_topics)
            ->map(fn ($topic) => __($topic))
            ->join(', ');

        return (new MailMessage)
            ->subject(__('Neue Beratungsanfrage'))
            ->greeting(__('Neue Beratungsanfrage erhalten'))
            ->line(__('Sie haben eine neue Beratungsanfrage erhalten:'))
            ->line('**'.__('Name').':** '.$this->consultationRequest->first_name.' '.$this->consultationRequest->last_name)
            ->line('**'.__('E-Mail').':** '.$this->consultationRequest->email)
            ->line('**'.__('Telefon').':** '.$this->consultationRequest->phone)
            ->line('**'.__('Finanzthemen').':** '.$financialTopics)
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
            'name' => $this->consultationRequest->first_name.' '.$this->consultationRequest->last_name,
            'email' => $this->consultationRequest->email,
        ];
    }
}
