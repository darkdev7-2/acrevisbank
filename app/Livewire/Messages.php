<?php

namespace App\Livewire;

use App\Models\Message;
use App\Services\MessagingService;
use Livewire\Component;
use Livewire\WithPagination;

class Messages extends Component
{
    use WithPagination;

    public $filter = 'inbox'; // inbox, sent, archived
    public $selectedMessage = null;
    public $replyText = '';
    public $showCompose = false;
    public $newMessageSubject = '';
    public $newMessageBody = '';

    public function mount()
    {
        //
    }

    public function selectMessage($messageId)
    {
        $message = Message::find($messageId);

        if (!$message || ($message->recipient_id !== auth()->id() && $message->sender_id !== auth()->id())) {
            return;
        }

        $this->selectedMessage = $message;

        // Mark as read if recipient
        if ($message->recipient_id === auth()->id() && !$message->is_read) {
            $message->markAsRead();
            $this->dispatch('message-read');
        }
    }

    public function sendReply()
    {
        $this->validate([
            'replyText' => 'required|min:10',
        ]);

        if (!$this->selectedMessage) {
            return;
        }

        $service = app(MessagingService::class);
        $service->replyToMessage($this->selectedMessage, auth()->user(), $this->replyText);

        session()->flash('success', 'Votre réponse a été envoyée.');
        $this->replyText = '';
        $this->selectMessage($this->selectedMessage->id); // Reload
    }

    public function composeMessage()
    {
        $this->validate([
            'newMessageSubject' => 'required|min:3',
            'newMessageBody' => 'required|min:10',
        ]);

        $service = app(MessagingService::class);
        $service->sendToBank(auth()->user(), [
            'subject' => $this->newMessageSubject,
            'body' => $this->newMessageBody,
        ]);

        session()->flash('success', 'Votre message a été envoyé à la banque.');
        $this->reset(['newMessageSubject', 'newMessageBody', 'showCompose']);
    }

    public function archiveMessage($messageId)
    {
        $message = Message::find($messageId);

        if ($message && $message->recipient_id === auth()->id()) {
            $message->archive();
            $this->selectedMessage = null;
        }
    }

    public function setFilter($filter)
    {
        $this->filter = $filter;
        $this->selectedMessage = null;
        $this->resetPage();
    }

    public function getMessagesProperty()
    {
        $query = Message::query();

        if ($this->filter === 'inbox') {
            $query->forUser(auth()->id())->notArchived();
        } elseif ($this->filter === 'sent') {
            $query->fromUser(auth()->id());
        } elseif ($this->filter === 'archived') {
            $query->forUser(auth()->id())->archived();
        }

        return $query->with(['sender', 'recipient'])->recent()->paginate(15);
    }

    public function getUnreadCountProperty()
    {
        return Message::forUser(auth()->id())->unread()->count();
    }

    public function render()
    {
        return view('livewire.messages', [
            'messages' => $this->messages,
            'unreadCount' => $this->unreadCount,
        ]);
    }
}
