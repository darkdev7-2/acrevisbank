<?php

namespace App\Notifications;

use App\Models\SuspiciousActivity;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SuspiciousActivityDetected extends Notification implements ShouldQueue
{
    use Queueable;

    protected SuspiciousActivity $activity;

    /**
     * Create a new notification instance.
     */
    public function __construct(SuspiciousActivity $activity)
    {
        $this->activity = $activity;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $userName = $this->activity->user ? $this->activity->user->name : 'Unknown User';
        $userEmail = $this->activity->user ? $this->activity->user->email : 'N/A';

        return (new MailMessage)
            ->subject('⚠️ Activité Suspecte Détectée - AcrevisBank')
            ->greeting('Alerte Sécurité')
            ->line('Une activité suspecte a été détectée sur le système AcrevisBank.')
            ->line('**Détails de l\'activité:**')
            ->line('• Type: ' . $this->activity->type_description)
            ->line('• Utilisateur: ' . $userName . ' (' . $userEmail . ')')
            ->line('• Sévérité: ' . strtoupper($this->activity->severity))
            ->line('• Score de risque: ' . $this->activity->risk_score . '/100')
            ->line('• Adresse IP: ' . $this->activity->ip_address)
            ->line('• Date: ' . $this->activity->created_at->format('d/m/Y H:i:s'))
            ->action('Voir les détails', url('/admin/suspicious-activities/' . $this->activity->id))
            ->line('Veuillez examiner cette activité et prendre les mesures appropriées si nécessaire.')
            ->salutation('Système de Sécurité AcrevisBank');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'activity_id' => $this->activity->id,
            'type' => $this->activity->type,
            'severity' => $this->activity->severity,
            'risk_score' => $this->activity->risk_score,
            'user_id' => $this->activity->user_id,
            'user_name' => $this->activity->user ? $this->activity->user->name : null,
            'ip_address' => $this->activity->ip_address,
            'created_at' => $this->activity->created_at->toISOString(),
        ];
    }
}
