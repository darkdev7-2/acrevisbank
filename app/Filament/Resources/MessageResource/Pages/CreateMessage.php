<?php

namespace App\Filament\Resources\MessageResource\Pages;

use App\Filament\Resources\MessageResource;
use App\Services\MessagingService;
use Filament\Resources\Pages\CreateRecord;

class CreateMessage extends CreateRecord
{
    protected static string $resource = MessageResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // sender_id is null for bank messages
        $data['sender_id'] = null;

        return $data;
    }

    protected function afterCreate(): void
    {
        // Send notification to recipient
        $service = app(MessagingService::class);
        $preferences = \App\Models\NotificationPreference::getOrCreateForUser($this->record->recipient);

        if ($preferences->notify_new_messages) {
            $this->record->recipient->notify(
                new \App\Notifications\GenericTemplatedNotification(
                    \App\Models\NotificationTemplate::getByCode('new_message'),
                    [
                        'subject' => $this->record->subject,
                        'sender' => 'AcrevisBank',
                        'preview' => \Str::limit($this->record->body, 100),
                        'type' => $this->record->type_label,
                        'priority' => $this->record->priority_label,
                    ]
                )
            );
        }
    }
}
