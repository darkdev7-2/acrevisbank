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

    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-bold text-gray-900">Messagerie Sécurisée</h2>
        <button
            wire:click="$set('showCompose', true)"
            class="inline-flex items-center rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
            <svg class="-ml-0.5 mr-1.5 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nouveau Message
        </button>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        {{-- Left Sidebar: Message List --}}
        <div class="lg:col-span-1">
            <div class="overflow-hidden rounded-lg bg-white shadow">
                {{-- Filter Tabs --}}
                <div class="border-b border-gray-200 bg-gray-50 p-4">
                    <nav class="-mb-px flex space-x-4">
                        <button
                            wire:click="setFilter('inbox')"
                            class="flex items-center border-b-2 px-1 pb-3 text-sm font-medium {{ $filter === 'inbox' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                            <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            Reçus
                            @if($filter === 'inbox' && $unreadCount > 0)
                                <span class="ml-2 rounded-full bg-blue-100 px-2 py-0.5 text-xs font-medium text-blue-800">
                                    {{ $unreadCount }}
                                </span>
                            @endif
                        </button>
                        <button
                            wire:click="setFilter('sent')"
                            class="flex items-center border-b-2 px-1 pb-3 text-sm font-medium {{ $filter === 'sent' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                            <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                            Envoyés
                        </button>
                        <button
                            wire:click="setFilter('archived')"
                            class="flex items-center border-b-2 px-1 pb-3 text-sm font-medium {{ $filter === 'archived' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                            <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                            </svg>
                            Archivés
                        </button>
                    </nav>
                </div>

                {{-- Messages List --}}
                <div class="divide-y divide-gray-200">
                    @forelse($messages as $message)
                        <button
                            wire:click="selectMessage({{ $message->id }})"
                            class="w-full p-4 text-left hover:bg-gray-50 {{ $selectedMessage && $selectedMessage->id === $message->id ? 'bg-blue-50' : '' }} {{ !$message->is_read && $message->recipient_id === auth()->id() ? 'bg-blue-50/30' : '' }}">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center">
                                        @if(!$message->is_read && $message->recipient_id === auth()->id())
                                            <span class="mr-2 h-2 w-2 rounded-full bg-blue-600"></span>
                                        @endif
                                        <p class="text-sm font-semibold text-gray-900">
                                            {{ $filter === 'sent' ? ($message->recipient ? $message->recipient->full_name : 'AcrevisBank') : ($message->sender ? $message->sender->full_name : 'AcrevisBank') }}
                                        </p>
                                    </div>
                                    <p class="mt-1 text-sm font-medium text-gray-700 line-clamp-1">
                                        {{ $message->subject }}
                                    </p>
                                    <p class="mt-1 text-xs text-gray-500 line-clamp-2">
                                        {{ \Str::limit($message->body, 60) }}
                                    </p>
                                    <div class="mt-2 flex items-center space-x-2">
                                        <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-medium
                                            {{ $message->priority === 'urgent' ? 'bg-red-100 text-red-800' : '' }}
                                            {{ $message->priority === 'high' ? 'bg-orange-100 text-orange-800' : '' }}
                                            {{ $message->priority === 'normal' ? 'bg-blue-100 text-blue-800' : '' }}
                                            {{ $message->priority === 'low' ? 'bg-gray-100 text-gray-800' : '' }}">
                                            {{ $message->priority_label }}
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            {{ $message->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </button>
                    @empty
                        <div class="p-8 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <p class="mt-2 text-sm text-gray-500">Aucun message</p>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                @if($messages->hasPages())
                    <div class="border-t border-gray-200 bg-white px-4 py-3">
                        {{ $messages->links() }}
                    </div>
                @endif
            </div>
        </div>

        {{-- Right Panel: Message Detail or Compose --}}
        <div class="lg:col-span-2">
            @if($showCompose)
                {{-- Compose New Message --}}
                <div class="overflow-hidden rounded-lg bg-white shadow">
                    <div class="border-b border-gray-200 bg-gray-50 p-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Nouveau Message</h3>
                            <button wire:click="$set('showCompose', false)" class="text-gray-400 hover:text-gray-500">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="p-6">
                        <form wire:submit.prevent="composeMessage">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Destinataire</label>
                                <input type="text" value="AcrevisBank" disabled class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 shadow-sm">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Sujet</label>
                                <input
                                    type="text"
                                    wire:model="newMessageSubject"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Objet de votre message">
                                @error('newMessageSubject') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Message</label>
                                <textarea
                                    wire:model="newMessageBody"
                                    rows="6"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Écrivez votre message..."></textarea>
                                @error('newMessageBody') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex justify-end gap-3">
                                <button
                                    type="button"
                                    wire:click="$set('showCompose', false)"
                                    class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                                    Annuler
                                </button>
                                <button
                                    type="submit"
                                    class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                                    Envoyer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @elseif($selectedMessage)
                {{-- Message Detail --}}
                <div class="overflow-hidden rounded-lg bg-white shadow">
                    {{-- Header --}}
                    <div class="border-b border-gray-200 bg-gray-50 p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ $selectedMessage->subject }}</h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    De: {{ $selectedMessage->sender ? $selectedMessage->sender->full_name : 'AcrevisBank' }} •
                                    {{ $selectedMessage->created_at->format('d/m/Y H:i') }}
                                </p>
                            </div>
                            <div class="flex items-center space-x-2">
                                @if($selectedMessage->recipient_id === auth()->id() && !$selectedMessage->is_archived)
                                    <button
                                        wire:click="archiveMessage({{ $selectedMessage->id }})"
                                        class="rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500"
                                        title="Archiver">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                        </svg>
                                    </button>
                                @endif
                                <button
                                    wire:click="$set('selectedMessage', null)"
                                    class="rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Badges --}}
                        <div class="mt-3 flex items-center space-x-2">
                            <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $selectedMessage->type_label }}
                            </span>
                            <span class="inline-flex rounded-full px-2 py-0.5 text-xs font-medium
                                {{ $selectedMessage->priority === 'urgent' ? 'bg-red-100 text-red-800' : '' }}
                                {{ $selectedMessage->priority === 'high' ? 'bg-orange-100 text-orange-800' : '' }}
                                {{ $selectedMessage->priority === 'normal' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $selectedMessage->priority === 'low' ? 'bg-gray-100 text-gray-800' : '' }}">
                                {{ $selectedMessage->priority_label }}
                            </span>
                        </div>
                    </div>

                    {{-- Message Body --}}
                    <div class="p-6">
                        <div class="prose max-w-none">
                            <p class="whitespace-pre-line text-gray-700">{{ $selectedMessage->body }}</p>
                        </div>

                        {{-- Replies --}}
                        @if($selectedMessage->replies->isNotEmpty())
                            <div class="mt-6 border-t border-gray-200 pt-6">
                                <h4 class="mb-4 text-sm font-semibold text-gray-900">Réponses</h4>
                                @foreach($selectedMessage->replies as $reply)
                                    <div class="mb-4 rounded-lg bg-gray-50 p-4">
                                        <div class="mb-2 flex items-center justify-between">
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ $reply->sender ? $reply->sender->full_name : 'AcrevisBank' }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                {{ $reply->created_at->format('d/m/Y H:i') }}
                                            </p>
                                        </div>
                                        <p class="whitespace-pre-line text-sm text-gray-700">{{ $reply->body }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        {{-- Reply Form --}}
                        <div class="mt-6 border-t border-gray-200 pt-6">
                            <h4 class="mb-3 text-sm font-semibold text-gray-900">Répondre</h4>
                            <form wire:submit.prevent="sendReply">
                                <textarea
                                    wire:model="replyText"
                                    rows="4"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                    placeholder="Votre réponse..."></textarea>
                                @error('replyText') <span class="mt-1 text-sm text-red-600">{{ $message }}</span> @enderror

                                <div class="mt-3 flex justify-end">
                                    <button
                                        type="submit"
                                        class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-700">
                                        Envoyer la réponse
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                {{-- Empty State --}}
                <div class="flex h-full items-center justify-center rounded-lg bg-white shadow">
                    <div class="text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Sélectionnez un message</h3>
                        <p class="mt-1 text-sm text-gray-500">Choisissez un message dans la liste pour le lire</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
