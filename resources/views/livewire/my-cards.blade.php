<div>
    {{-- Flash Messages --}}
    @if (session()->has('success'))
        <div class="mb-6 rounded-lg bg-green-50 p-4 text-green-800">
            <div class="flex">
                <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <p class="ml-3 text-sm font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-6 rounded-lg bg-red-50 p-4 text-red-800">
            <div class="flex">
                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <p class="ml-3 text-sm font-medium">{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Mes Cartes Bancaires</h2>
        <p class="mt-1 text-sm text-gray-600">Gérez vos cartes bancaires virtuelles</p>
    </div>

    @if($cards->isEmpty())
        <div class="rounded-lg border-2 border-dashed border-gray-300 p-12 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Aucune carte</h3>
            <p class="mt-1 text-sm text-gray-500">Vous n'avez pas encore de carte bancaire.</p>
            <div class="mt-6">
                <a href="{{ route('cards.request') }}" class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                    <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Demander une carte
                </a>
            </div>
        </div>
    @else
        <div class="grid gap-6 sm:grid-cols-1 lg:grid-cols-2">
            @foreach($cards as $card)
                <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-gray-900 to-gray-800 p-6 text-white shadow-xl">
                    {{-- Card Type Logo --}}
                    <div class="flex items-start justify-between">
                        <div class="text-sm font-medium uppercase opacity-75">{{ $card->card_type }}</div>
                        @if($card->card_type === 'Visa')
                            <div class="text-2xl font-bold">VISA</div>
                        @else
                            <div class="text-2xl font-bold">MC</div>
                        @endif
                    </div>

                    {{-- Card Number --}}
                    <div class="mt-8">
                        <div class="mb-2 text-xs font-medium uppercase opacity-50">Numéro de carte</div>
                        <div class="flex items-center justify-between">
                            <div class="font-mono text-lg tracking-wider">
                                @if(isset($revealedCards[$card->id]))
                                    {{ $card->formatted_card_number }}
                                @else
                                    {{ $card->masked_card_number }}
                                @endif
                            </div>
                            <button
                                wire:click="toggleReveal({{ $card->id }})"
                                class="rounded-full p-2 hover:bg-white/10 transition"
                                title="{{ isset($revealedCards[$card->id]) ? 'Masquer' : 'Révéler' }}">
                                @if(isset($revealedCards[$card->id]))
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                    </svg>
                                @else
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                @endif
                            </button>
                        </div>
                    </div>

                    {{-- Cardholder and Expiry --}}
                    <div class="mt-6 flex items-end justify-between">
                        <div>
                            <div class="text-xs font-medium uppercase opacity-50">Titulaire</div>
                            <div class="mt-1 font-medium">{{ $card->cardholder_name }}</div>
                        </div>
                        <div class="text-right">
                            <div class="text-xs font-medium uppercase opacity-50">Expire</div>
                            <div class="mt-1 font-mono">{{ $card->expiry_date }}</div>
                        </div>
                        <div class="text-right">
                            <div class="text-xs font-medium uppercase opacity-50">CVV</div>
                            <div class="mt-1 font-mono">
                                @if(isset($revealedCards[$card->id]))
                                    {{ $card->cvv }}
                                @else
                                    •••
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Status Badge --}}
                    <div class="absolute top-6 right-6">
                        @if($card->status === 'active')
                            <span class="rounded-full bg-green-500/20 px-3 py-1 text-xs font-semibold text-green-300">Active</span>
                        @elseif($card->status === 'blocked')
                            <span class="rounded-full bg-red-500/20 px-3 py-1 text-xs font-semibold text-red-300">Bloquée</span>
                        @elseif($card->status === 'pending')
                            <span class="rounded-full bg-yellow-500/20 px-3 py-1 text-xs font-semibold text-yellow-300">En attente</span>
                        @else
                            <span class="rounded-full bg-gray-500/20 px-3 py-1 text-xs font-semibold text-gray-300">{{ ucfirst($card->status) }}</span>
                        @endif
                    </div>

                    {{-- Card Actions --}}
                    <div class="mt-6 flex gap-2 border-t border-white/10 pt-4">
                        @if($card->status === 'active')
                            <button
                                wire:click="requestBlock({{ $card->id }})"
                                class="flex-1 rounded-lg bg-red-600/20 px-3 py-2 text-sm font-medium text-red-300 hover:bg-red-600/30 transition">
                                Bloquer
                            </button>
                        @elseif($card->status === 'blocked')
                            <button
                                wire:click="requestUnblock({{ $card->id }})"
                                class="flex-1 rounded-lg bg-green-600/20 px-3 py-2 text-sm font-medium text-green-300 hover:bg-green-600/30 transition">
                                Débloquer
                            </button>
                        @endif
                        <a
                            href="{{ route('cards.transactions', $card->id) }}"
                            class="flex-1 rounded-lg bg-white/10 px-3 py-2 text-center text-sm font-medium hover:bg-white/20 transition">
                            Transactions
                        </a>
                    </div>

                    {{-- Spending Info --}}
                    <div class="mt-4 rounded-lg bg-white/5 p-3">
                        <div class="flex justify-between text-xs">
                            <span class="opacity-75">Dépenses du jour</span>
                            <span class="font-semibold">{{ number_format($card->daily_spent, 2) }} / {{ number_format($card->daily_limit, 2) }} CHF</span>
                        </div>
                        <div class="mt-1 h-1.5 overflow-hidden rounded-full bg-white/10">
                            <div class="h-full bg-blue-400 transition-all" style="width: {{ min(($card->daily_spent / $card->daily_limit) * 100, 100) }}%"></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- Block Card Modal - Simple version --}}
    @if($selectedCard)
        <div
            x-data="{ open: @entangle('selectedCard') !== null }"
            x-show="open"
            x-cloak
            class="fixed inset-0 z-50 overflow-y-auto"
            aria-labelledby="modal-title"
            role="dialog"
            aria-modal="true">
            <div class="flex min-h-screen items-end justify-center px-4 pb-20 pt-4 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="$wire.set('selectedCard', null)"></div>
                <div class="inline-block transform overflow-hidden rounded-lg bg-white text-left align-bottom shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:align-middle">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Bloquer la carte</h3>
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Raison du blocage</label>
                            <textarea
                                wire:model="blockReason"
                                rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                placeholder="Veuillez indiquer la raison du blocage..."></textarea>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button
                            wire:click="blockCard"
                            type="button"
                            class="inline-flex w-full justify-center rounded-md border border-transparent bg-red-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm">
                            Bloquer
                        </button>
                        <button
                            @click="$wire.set('selectedCard', null)"
                            type="button"
                            class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 sm:mt-0 sm:w-auto sm:text-sm">
                            Annuler
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
