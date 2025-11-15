<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TwoFactorCodeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected string $code;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $code)
    {
        $this->code = $code;
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
        return (new MailMessage)
            ->subject(__('Votre code de vérification à deux facteurs'))
            ->greeting(__('Bonjour :name', ['name' => $notifiable->name]))
            ->line(__('Vous recevez cet email car une tentative de connexion a été effectuée sur votre compte.'))
            ->line(__('Votre code de vérification à deux facteurs est:'))
            ->line('## ' . $this->code)
            ->line(__('Ce code expirera dans 10 minutes.'))
            ->line(__('Si vous n\'avez pas tenté de vous connecter, veuillez ignorer cet email et changer votre mot de passe immédiatement.'))
            ->line(__('Pour des raisons de sécurité, ne partagez jamais ce code avec personne.'))
            ->salutation(__('Cordialement, L\'équipe AcrevisBank'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'code_sent' => true,
            'timestamp' => now()->toISOString(),
        ];
    }
}
