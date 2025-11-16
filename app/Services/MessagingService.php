<?php

namespace App\Services;

use App\Models\Message;
use App\Models\NotificationPreference;
use App\Models\NotificationTemplate;
use App\Models\User;
use App\Notifications\GenericTemplatedNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class MessagingService
{
    /**
     * Send a message from bank to client
     */
    public function sendToClient(User $recipient, array $data): Message
    {
        $message = Message::create([
            'sender_id' => null, // null = from bank
            'recipient_id' => $recipient->id,
            'subject' => $data['subject'],
            'body' => $data['body'],
            'type' => $data['type'] ?? 'general',
            'priority' => $data['priority'] ?? 'normal',
            'metadata' => $data['metadata'] ?? null,
            'attachments' => $data['attachments'] ?? null,
        ]);

        // Send notification if user prefers
        $this->notifyNewMessage($recipient, $message);

        // Log activity
        activity()
            ->performedOn($message)
            ->withProperties([
                'recipient_id' => $recipient->id,
                'type' => $message->type,
                'priority' => $message->priority,
            ])
            ->log('Message sent from bank to client');

        return $message;
    }

    /**
     * Send a message from client to bank
     */
    public function sendToBank(User $sender, array $data): Message
    {
        // Find first admin or system user
        $bankUser = User::role('Admin')->first();

        $message = Message::create([
            'sender_id' => $sender->id,
            'recipient_id' => $bankUser ? $bankUser->id : $sender->id, // Fallback to self
            'subject' => $data['subject'],
            'body' => $data['body'],
            'type' => $data['type'] ?? 'support',
            'priority' => $data['priority'] ?? 'normal',
            'metadata' => $data['metadata'] ?? null,
            'attachments' => $data['attachments'] ?? null,
        ]);

        // Notify admins
        if ($bankUser) {
            $this->notifyNewMessage($bankUser, $message);
        }

        // Log activity
        activity()
            ->performedOn($message)
            ->causedBy($sender)
            ->withProperties([
                'type' => $message->type,
                'priority' => $message->priority,
            ])
            ->log('Message sent from client to bank');

        return $message;
    }

    /**
     * Reply to a message
     */
    public function replyToMessage(Message $originalMessage, User $sender, string $body): Message
    {
        $reply = Message::create([
            'sender_id' => $sender->id,
            'recipient_id' => $originalMessage->sender_id ?? $originalMessage->recipient_id,
            'subject' => 'Re: ' . $originalMessage->subject,
            'body' => $body,
            'type' => $originalMessage->type,
            'priority' => $originalMessage->priority,
            'parent_id' => $originalMessage->id,
        ]);

        // Mark original as read if replying
        $originalMessage->markAsRead();

        // Notify recipient
        $recipient = User::find($reply->recipient_id);
        if ($recipient) {
            $this->notifyMessageReply($recipient, $reply, $originalMessage);
        }

        // Log activity
        activity()
            ->performedOn($reply)
            ->causedBy($sender)
            ->withProperties([
                'original_message_id' => $originalMessage->id,
            ])
            ->log('Reply sent to message');

        return $reply;
    }

    /**
     * Send notification using template
     */
    public function sendTemplatedNotification(User $user, string $templateCode, array $data = [], array $channels = ['mail', 'database']): void
    {
        $template = NotificationTemplate::getByCode($templateCode);

        if (!$template) {
            Log::warning("Template not found: {$templateCode}");
            return;
        }

        // Check user preferences
        $preferences = NotificationPreference::getOrCreateForUser($user);

        // Filter channels based on preferences and quiet hours
        $channels = $this->filterChannelsByPreferences($channels, $preferences, $templateCode);

        if (empty($channels)) {
            return; // User has disabled all notifications for this type
        }

        try {
            $user->notify(new GenericTemplatedNotification($template, $data, $channels));
        } catch (\Exception $e) {
            Log::error('Failed to send templated notification', [
                'user_id' => $user->id,
                'template_code' => $templateCode,
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Send transaction notification
     */
    public function notifyTransaction(User $user, array $transactionData): void
    {
        $preferences = NotificationPreference::getOrCreateForUser($user);

        // Check if should alert based on preferences
        if (!$preferences->shouldAlertForTransaction($transactionData['amount'], $transactionData['flags'] ?? [])) {
            // Still send if they have general transaction notifications on
            if (!$preferences->email_transactions && !$preferences->push_transactions) {
                return;
            }
        }

        $templateCode = match ($transactionData['type'] ?? 'default') {
            'approved' => 'transaction_approved',
            'declined' => 'transaction_declined',
            'pending' => 'transaction_pending',
            default => 'transaction_notification',
        };

        $this->sendTemplatedNotification($user, $templateCode, $transactionData);

        // Also create internal message for important transactions
        if (($transactionData['amount'] ?? 0) > 1000) {
            $this->sendToClient($user, [
                'subject' => 'Transaction importante effectuée',
                'body' => "Une transaction de {$transactionData['amount']} CHF a été effectuée sur votre compte.",
                'type' => 'transaction',
                'priority' => 'high',
                'metadata' => $transactionData,
            ]);
        }
    }

    /**
     * Send card activity notification
     */
    public function notifyCardActivity(User $user, array $cardData): void
    {
        $preferences = NotificationPreference::getOrCreateForUser($user);

        if (!$preferences->email_card_activities && !$preferences->push_card_activities) {
            return;
        }

        $templateCode = match ($cardData['activity'] ?? 'default') {
            'blocked' => 'card_blocked',
            'activated' => 'card_activated',
            'renewed' => 'card_renewed',
            'transaction' => 'card_transaction',
            default => 'card_activity',
        };

        $this->sendTemplatedNotification($user, $templateCode, $cardData);
    }

    /**
     * Send security alert
     */
    public function notifySecurityAlert(User $user, array $alertData): void
    {
        $preferences = NotificationPreference::getOrCreateForUser($user);

        // Security alerts bypass quiet hours
        $channels = [];
        if ($preferences->email_security_alerts) {
            $channels[] = 'mail';
        }
        if ($preferences->push_security_alerts) {
            $channels[] = 'database'; // Will be push when implemented
        }
        if ($preferences->sms_security_alerts) {
            // $channels[] = 'sms'; // When SMS is implemented
        }

        if (empty($channels)) {
            $channels = ['mail', 'database']; // Force notification for security
        }

        $this->sendTemplatedNotification($user, 'security_alert', $alertData, $channels);

        // Always create internal message for security
        $this->sendToClient($user, [
            'subject' => 'Alerte de sécurité',
            'body' => $alertData['message'] ?? 'Une activité inhabituelle a été détectée sur votre compte.',
            'type' => 'security',
            'priority' => 'urgent',
            'metadata' => $alertData,
        ]);
    }

    /**
     * Notify user of new message
     */
    protected function notifyNewMessage(User $user, Message $message): void
    {
        $preferences = NotificationPreference::getOrCreateForUser($user);

        if (!$preferences->notify_new_messages) {
            return;
        }

        $this->sendTemplatedNotification($user, 'new_message', [
            'subject' => $message->subject,
            'sender' => $message->sender ? $message->sender->full_name : 'AcrevisBank',
            'preview' => \Str::limit($message->body, 100),
            'type' => $message->type_label,
            'priority' => $message->priority_label,
        ]);
    }

    /**
     * Notify user of message reply
     */
    protected function notifyMessageReply(User $user, Message $reply, Message $originalMessage): void
    {
        $preferences = NotificationPreference::getOrCreateForUser($user);

        if (!$preferences->notify_message_replies) {
            return;
        }

        $this->sendTemplatedNotification($user, 'message_reply', [
            'subject' => $originalMessage->subject,
            'sender' => $reply->sender ? $reply->sender->full_name : 'AcrevisBank',
            'preview' => \Str::limit($reply->body, 100),
        ]);
    }

    /**
     * Filter notification channels based on user preferences
     */
    protected function filterChannelsByPreferences(array $channels, NotificationPreference $preferences, string $templateCode): array
    {
        // Check quiet hours
        if ($preferences->isInQuietHours() && !str_contains($templateCode, 'security')) {
            // Remove all channels during quiet hours except for security alerts
            return [];
        }

        $filtered = [];

        // Determine notification category from template code
        $category = $this->getCategoryFromTemplateCode($templateCode);

        foreach ($channels as $channel) {
            if ($channel === 'mail' && $preferences->shouldNotifyEmail($category)) {
                $filtered[] = 'mail';
            } elseif ($channel === 'database' && $preferences->shouldNotifyPush($category)) {
                $filtered[] = 'database';
            }
        }

        return $filtered;
    }

    /**
     * Get category from template code
     */
    protected function getCategoryFromTemplateCode(string $code): string
    {
        if (str_contains($code, 'transaction')) {
            return 'transactions';
        } elseif (str_contains($code, 'card')) {
            return 'card_activities';
        } elseif (str_contains($code, 'security')) {
            return 'security_alerts';
        } elseif (str_contains($code, 'account')) {
            return 'account_updates';
        }

        return 'general';
    }

    /**
     * Get unread message count for user
     */
    public function getUnreadCount(User $user): int
    {
        return Message::forUser($user->id)->unread()->count();
    }

    /**
     * Mark all messages as read for user
     */
    public function markAllAsRead(User $user): int
    {
        return Message::forUser($user->id)->unread()->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
    }
}
