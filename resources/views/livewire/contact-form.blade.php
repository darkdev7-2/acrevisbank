<div>
    @php
        $currentLocale = app()->getLocale();

        $texts = [
            'fr' => [
                'name' => 'Nom complet',
                'email' => 'Email',
                'phone' => 'Téléphone',
                'subject' => 'Sujet',
                'message' => 'Votre message',
                'send' => 'Envoyer',
                'contact_methods' => 'Moyens de contact préférés',
                'method_email' => 'Email',
                'method_phone' => 'Téléphone',
                'method_whatsapp' => 'WhatsApp'
            ],
            'de' => [
                'name' => 'Vollständiger Name',
                'email' => 'E-Mail',
                'phone' => 'Telefon',
                'subject' => 'Betreff',
                'message' => 'Ihre Nachricht',
                'send' => 'Senden',
                'contact_methods' => 'Bevorzugte Kontaktmethode',
                'method_email' => 'E-Mail',
                'method_phone' => 'Telefon',
                'method_whatsapp' => 'WhatsApp'
            ],
            'en' => [
                'name' => 'Full Name',
                'email' => 'Email',
                'phone' => 'Phone',
                'subject' => 'Subject',
                'message' => 'Your Message',
                'send' => 'Send',
                'contact_methods' => 'Preferred Contact Method',
                'method_email' => 'Email',
                'method_phone' => 'Phone',
                'method_whatsapp' => 'WhatsApp'
            ],
            'es' => [
                'name' => 'Nombre completo',
                'email' => 'Correo electrónico',
                'phone' => 'Teléfono',
                'subject' => 'Asunto',
                'message' => 'Su mensaje',
                'send' => 'Enviar',
                'contact_methods' => 'Método de contacto preferido',
                'method_email' => 'Correo electrónico',
                'method_phone' => 'Teléfono',
                'method_whatsapp' => 'WhatsApp'
            ]
        ];

        $t = $texts[$currentLocale];
    @endphp

    <form wire:submit.prevent="submit" class="space-y-6">
        <!-- Success Message -->
        @if($successMessage)
        <div class="p-4 bg-green-50 border border-green-200 rounded-md">
            <div class="flex">
                <svg class="w-5 h-5 text-green-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <p class="text-sm text-green-800">{{ $successMessage }}</p>
            </div>
        </div>
        @endif

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                {{ $t['name'] }} <span class="text-red-500">*</span>
            </label>
            <input type="text"
                   id="name"
                   wire:model="name"
                   class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500
                          @error('name') border-red-500 @enderror">
            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                {{ $t['email'] }} <span class="text-red-500">*</span>
            </label>
            <input type="email"
                   id="email"
                   wire:model="email"
                   class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500
                          @error('email') border-red-500 @enderror">
            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Phone -->
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                {{ $t['phone'] }}
            </label>
            <input type="tel"
                   id="phone"
                   wire:model="phone"
                   class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
        </div>

        <!-- Subject -->
        <div>
            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                {{ $t['subject'] }}
            </label>
            <input type="text"
                   id="subject"
                   wire:model="subject"
                   class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
        </div>

        <!-- Contact Method -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                {{ $t['contact_methods'] }} <span class="text-red-500">*</span>
            </label>
            <div class="flex space-x-4">
                <label class="flex items-center">
                    <input type="radio"
                           wire:model="preferred_contact_method"
                           value="email"
                           class="text-pink-600 focus:ring-pink-500">
                    <span class="ml-2 text-sm text-gray-700">{{ $t['method_email'] }}</span>
                </label>
                <label class="flex items-center">
                    <input type="radio"
                           wire:model="preferred_contact_method"
                           value="phone"
                           class="text-pink-600 focus:ring-pink-500">
                    <span class="ml-2 text-sm text-gray-700">{{ $t['method_phone'] }}</span>
                </label>
                <label class="flex items-center">
                    <input type="radio"
                           wire:model="preferred_contact_method"
                           value="whatsapp"
                           class="text-pink-600 focus:ring-pink-500">
                    <span class="ml-2 text-sm text-gray-700">{{ $t['method_whatsapp'] }}</span>
                </label>
            </div>
            @error('preferred_contact_method') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Message -->
        <div>
            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                {{ $t['message'] }} <span class="text-red-500">*</span>
            </label>
            <textarea id="message"
                      wire:model="message"
                      rows="6"
                      maxlength="2000"
                      class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500
                             @error('message') border-red-500 @enderror"></textarea>
            @error('message') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit"
                wire:loading.attr="disabled"
                class="w-full bg-pink-600 hover:bg-pink-700 text-white font-semibold py-3 rounded-md transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
            <span wire:loading.remove>{{ $t['send'] }}</span>
            <span wire:loading class="flex items-center justify-center">
                <svg class="animate-spin h-5 w-5 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                {{ $t['send'] }}...
            </span>
        </button>
    </form>
</div>
