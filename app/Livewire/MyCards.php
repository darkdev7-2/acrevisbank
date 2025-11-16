<?php

namespace App\Livewire;

use App\Models\Card;
use App\Services\CardService;
use Livewire\Component;
use Livewire\Attributes\On;

class MyCards extends Component
{
    public $cards;
    public $revealedCards = [];
    public $selectedCard = null;
    public $blockReason = '';

    public function mount()
    {
        $this->loadCards();
    }

    public function loadCards()
    {
        $user = auth()->user();
        $this->cards = Card::whereHas('account', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
            ->with('account')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function toggleReveal($cardId)
    {
        if (isset($this->revealedCards[$cardId])) {
            unset($this->revealedCards[$cardId]);
        } else {
            $this->revealedCards[$cardId] = true;
        }
    }

    public function requestBlock($cardId)
    {
        $this->selectedCard = $cardId;
        $this->dispatch('open-block-modal');
    }

    public function blockCard()
    {
        if (!$this->selectedCard || !$this->blockReason) {
            session()->flash('error', 'Veuillez fournir une raison pour le blocage.');
            return;
        }

        $card = Card::find($this->selectedCard);
        if (!$card || $card->account->user_id !== auth()->id()) {
            session()->flash('error', 'Carte introuvable.');
            return;
        }

        $service = app(CardService::class);
        if ($service->blockCard($card, $this->blockReason, auth()->user())) {
            session()->flash('success', 'Votre carte a été bloquée avec succès.');
            $this->loadCards();
            $this->reset(['selectedCard', 'blockReason']);
            $this->dispatch('close-block-modal');
        } else {
            session()->flash('error', 'Impossible de bloquer la carte.');
        }
    }

    public function requestUnblock($cardId)
    {
        $card = Card::find($cardId);
        if (!$card || $card->account->user_id !== auth()->id()) {
            session()->flash('error', 'Carte introuvable.');
            return;
        }

        $service = app(CardService::class);
        if ($service->unblockCard($card, auth()->user())) {
            session()->flash('success', 'Votre carte a été débloquée avec succès.');
            $this->loadCards();
        } else {
            session()->flash('error', 'Impossible de débloquer la carte.');
        }
    }

    #[On('card-created')]
    public function cardCreated()
    {
        $this->loadCards();
        session()->flash('success', 'Nouvelle carte créée avec succès!');
    }

    public function render()
    {
        return view('livewire.my-cards');
    }
}
