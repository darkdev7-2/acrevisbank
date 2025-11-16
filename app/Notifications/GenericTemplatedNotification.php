<?php

namespace App\Notifications;

use App\Models\NotificationTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GenericTemplatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected NotificationTemplate $template;
    protected array $data;
    protected array $channels;

    public function __construct(NotificationTemplate $template, array $data = [], array $channels = ['mail', 'database'])
    {
        $this->template = $template;
        $this->data = $data;
        $this->channels = $channels;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return $this->channels;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $subject = $this->template->renderSubject($this->data) ?? $this->template->name;
        $body = $this->template->render($this->data);

        // Convert markdown-style formatting to basic formatting
        $body = $this->formatBody($body);

        return (new MailMessage)
            ->subject($subject)
            ->greeting($this->data['greeting'] ?? "Bonjour {$notifiable->first_name},")
            ->line($body)
            ->when(isset($this->data['action_url']) && isset($this->data['action_text']), function ($mail) {
                return $mail->action($this->data['action_text'], $this->data['action_url']);
            })
            ->salutation($this->data['salutation'] ?? 'Cordialement, L\'équipe AcrevisBank');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'template_code' => $this->template->code,
            'subject' => $this->template->renderSubject($this->data) ?? $this->template->name,
            'body' => $this->template->render($this->data),
            'data' => $this->data,
            'type' => $this->template->category ?? 'general',
        ];
    }

    /**
     * Format body text
     */
    protected function formatBody(string $body): string
    {
        // Split by line breaks to preserve formatting
        $lines = explode("\n", $body);

        return implode("\n", array_map(function ($line) {
            return trim($line);
        }, $lines));
    }
}
