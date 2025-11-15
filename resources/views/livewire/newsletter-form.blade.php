<div>
    @php
        $currentLocale = app()->getLocale();
        $texts = [
            'fr' => [
                'email_placeholder' => 'Votre adresse email',
                'subscribe' => 'S\'inscrire',
            ],
            'de' => [
                'email_placeholder' => 'Ihre E-Mail-Adresse',
                'subscribe' => 'Abonnieren',
            ],
            'en' => [
                'email_placeholder' => 'Your email address',
                'subscribe' => 'Subscribe',
            ],
            'es' => [
                'email_placeholder' => 'Su dirección de correo',
                'subscribe' => 'Suscribirse',
            ]
        ];
        $t = $texts[$currentLocale];
    @endphp

    <form wire:submit.prevent="subscribe" class="space-y-4">
        <!-- Success Message -->
        @if($successMessage)
        <div class="p-4 bg-green-50 border border-green-200 rounded-md">
            <p class="text-sm text-green-800">{{ $successMessage }}</p>
        </div>
        @endif

        <!-- Error Message -->
        @if($errorMessage)
        <div class="p-4 bg-red-50 border border-red-200 rounded-md">
            <p class="text-sm text-red-800">{{ $errorMessage }}</p>
        </div>
        @endif

        <!-- Email Input -->
        <div class="flex gap-2">
            <div class="flex-1">
                <input type="email"
                       wire:model="email"
                       placeholder="{{ $t['email_placeholder'] }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500
                              @error('email') border-red-500 @enderror">
                @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                    wire:loading.attr="disabled"
                    class="px-6 py-3 bg-pink-600 hover:bg-pink-700 text-white font-semibold rounded-md transition-colors disabled:opacity-50 disabled:cursor-not-allowed whitespace-nowrap">
                <span wire:loading.remove>{{ $t['subscribe'] }}</span>
                <span wire:loading>
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </span>
            </button>
        </div>
    </form>
</div>
