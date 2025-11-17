<?php

namespace App\Livewire;

use App\Models\Card;
use App\Models\CardTransaction;
use Livewire\Component;
use Livewire\WithPagination;

class CardTransactions extends Component
{
    use WithPagination;

    public $cardId;
    public $card;
    public $filterStatus = '';
    public $filterType = '';
    public $search = '';

    protected $queryString = [
        'filterStatus' => ['except' => ''],
        'filterType' => ['except' => ''],
        'search' => ['except' => ''],
    ];

    public function mount($cardId = null)
    {
        $this->cardId = $cardId;

        if ($cardId) {
            $this->card = Card::with('account')->find($cardId);

            // Verify ownership
            if (!$this->card || $this->card->account->user_id !== auth()->id()) {
                abort(403);
            }
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function updatingFilterType()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['filterStatus', 'filterType', 'search']);
        $this->resetPage();
    }

    public function render()
    {
        $transactions = $this->getTransactions();

        return view('livewire.card-transactions', [
            'transactions' => $transactions,
        ]);
    }

    protected function getTransactions()
    {
        $query = CardTransaction::query()
            ->when($this->cardId, function ($q) {
                $q->where('card_id', $this->cardId);
            })
            ->when(!$this->cardId, function ($q) {
                // Get all cards owned by the user
                $user = auth()->user();
                $cardIds = Card::whereHas('account', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })->pluck('id');

                $q->whereIn('card_id', $cardIds);
            })
            ->with(['card.account'])
            ->when($this->filterStatus, function ($q) {
                $q->where('status', $this->filterStatus);
            })
            ->when($this->filterType, function ($q) {
                $q->where('type', $this->filterType);
            })
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->where('merchant_name', 'like', '%' . $this->search . '%')
                        ->orWhere('transaction_id', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return $transactions;
    }
}
