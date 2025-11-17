<?php

namespace App\Notifications;

use App\Models\SuspiciousActivity;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserSuspiciousActivityNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected SuspiciousActivity $activity
    ) {}

    /**
     * Get the notification's delivery channels.
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
        $activityType = $this->getActivityTypeLabel($this->activity->type);
        $severity = $this->getSeverityLabel($this->activity->severity);

        return (new MailMessage)
            ->subject('Alerte de Sécurité - Activité Suspecte Détectée')
            ->greeting("Bonjour {$notifiable->first_name},")
            ->line("Nous avons détecté une activité suspecte sur votre compte AcrevisBank.")
            ->line("**Type d'activité:** {$activityType}")
            ->line("**Niveau de gravité:** {$severity}")
            ->line("**Date et heure:** {$this->activity->created_at->format('d/m/Y H:i:s')}")
            ->line("**Adresse IP:** {$this->activity->ip_address}")
            ->when($this->activity->location, function ($mail) {
                return $mail->line("**Localisation:** {$this->activity->location}");
            })
            ->line('Si vous êtes à l\'origine de cette activité, vous pouvez ignorer ce message.')
            ->line('Si vous ne reconnaissez pas cette activité, nous vous recommandons de:')
            ->line('• Changer immédiatement votre mot de passe')
            ->line('• Vérifier les transactions récentes sur votre compte')
            ->line('• Contacter notre service client')
            ->action('Accéder à mon compte', url('/dashboard'))
            ->line('Pour votre sécurité, nous surveillons en permanence les activités inhabituelles.')
            ->salutation('L\'équipe AcrevisBank');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'activity_id' => $this->activity->id,
            'type' => $this->activity->type,
            'severity' => $this->activity->severity,
            'risk_score' => $this->activity->risk_score,
            'ip_address' => $this->activity->ip_address,
            'location' => $this->activity->location,
            'created_at' => $this->activity->created_at->toDateTimeString(),
        ];
    }

    /**
     * Get human-readable activity type label.
     */
    protected function getActivityTypeLabel(string $type): string
    {
        return match ($type) {
            'multiple_login_failures' => 'Tentatives de connexion échouées multiples',
            'ip_change' => 'Changement d\'adresse IP',
            'unusual_time' => 'Connexion à une heure inhabituelle',
            'rapid_transactions' => 'Transactions rapides',
            'high_value_transaction' => 'Transaction de montant élevé',
            'brute_force' => 'Tentative de force brute',
            default => ucfirst(str_replace('_', ' ', $type)),
        };
    }

    /**
     * Get human-readable severity label.
     */
    protected function getSeverityLabel(string $severity): string
    {
        return match ($severity) {
            'low' => 'Faible',
            'medium' => 'Moyen',
            'high' => 'Élevé',
            'critical' => 'Critique',
            default => $severity,
        };
    }
}
