<div>
    <div class="mb-6">
        @if($card)
            <div class="mb-4">
                <a href="{{ route('cards.index') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Retour aux cartes
                </a>
            </div>
            <h2 class="text-2xl font-bold text-gray-900">Transactions - {{ $card->masked_card_number }}</h2>
            <p class="mt-1 text-sm text-gray-600">Historique complet des transactions pour cette carte</p>
        @else
            <h2 class="text-2xl font-bold text-gray-900">Toutes mes transactions</h2>
            <p class="mt-1 text-sm text-gray-600">Historique complet de toutes vos cartes</p>
        @endif
    </div>

    {{-- Filters --}}
    <div class="mb-6 rounded-lg bg-white p-4 shadow">
        <div class="grid gap-4 md:grid-cols-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Recherche</label>
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Marchand, ID transaction..."
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Statut</label>
                <select
                    wire:model.live="filterStatus"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    <option value="">Tous</option>
                    <option value="pending">En attente</option>
                    <option value="approved">Approuvée</option>
                    <option value="declined">Refusée</option>
                    <option value="reversed">Annulée</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Type</label>
                <select
                    wire:model.live="filterType"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    <option value="">Tous</option>
                    <option value="purchase">Achat</option>
                    <option value="withdrawal">Retrait</option>
                    <option value="refund">Remboursement</option>
                    <option value="fee">Frais</option>
                    <option value="reversal">Annulation</option>
                </select>
            </div>

            <div class="flex items-end">
                <button
                    wire:click="resetFilters"
                    class="w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                    Réinitialiser
                </button>
            </div>
        </div>
    </div>

    {{-- Transactions List --}}
    <div class="overflow-hidden rounded-lg bg-white shadow">
        @if($transactions->isEmpty())
            <div class="p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Aucune transaction</h3>
                <p class="mt-1 text-sm text-gray-500">Aucune transaction trouvée avec les filtres actuels.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Date</th>
                            @if(!$card)
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Carte</th>
                            @endif
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Marchand</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Montant</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Détails</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @foreach($transactions as $transaction)
                            <tr class="hover:bg-gray-50">
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                    {{ $transaction->created_at->format('d/m/Y H:i') }}
                                </td>
                                @if(!$card)
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                        {{ $transaction->card->masked_card_number }}
                                    </td>
                                @endif
                                <td class="px-6 py-4 text-sm">
                                    <div class="font-medium text-gray-900">{{ $transaction->merchant_name ?? 'N/A' }}</div>
                                    <div class="text-gray-500">{{ $transaction->merchant_location }}</div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm">
                                    <span class="inline-flex rounded-full px-2 py-1 text-xs font-semibold
                                        {{ $transaction->type === 'purchase' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $transaction->type === 'withdrawal' ? 'bg-purple-100 text-purple-800' : '' }}
                                        {{ $transaction->type === 'refund' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $transaction->type === 'fee' ? 'bg-orange-100 text-orange-800' : '' }}
                                        {{ $transaction->type === 'reversal' ? 'bg-gray-100 text-gray-800' : '' }}">
                                        {{ $transaction->type_label }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                    {{ $transaction->formatted_amount }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm">
                                    <span class="inline-flex rounded-full px-2 py-1 text-xs font-semibold
                                        {{ $transaction->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $transaction->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $transaction->status === 'declined' ? 'bg-red-100 text-red-800' : '' }}
                                        {{ $transaction->status === 'reversed' ? 'bg-gray-100 text-gray-800' : '' }}">
                                        @if($transaction->status === 'approved') Approuvée
                                        @elseif($transaction->status === 'pending') En attente
                                        @elseif($transaction->status === 'declined') Refusée
                                        @elseif($transaction->status === 'reversed') Annulée
                                        @endif
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                    <div class="flex gap-2">
                                        @if($transaction->is_online)
                                            <span class="rounded bg-blue-50 px-2 py-1 text-xs text-blue-700" title="Transaction en ligne">
                                                <svg class="inline h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                                                </svg>
                                            </span>
                                        @endif
                                        @if($transaction->is_international)
                                            <span class="rounded bg-purple-50 px-2 py-1 text-xs text-purple-700" title="Transaction internationale">
                                                <svg class="inline h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>
</div>
