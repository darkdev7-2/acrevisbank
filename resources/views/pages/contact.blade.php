<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();

        $texts = [
            'fr' => [
                'title' => 'Contactez-nous',
                'subtitle' => 'Nous sommes là pour vous aider',
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
                'title' => 'Kontaktieren Sie uns',
                'subtitle' => 'Wir sind für Sie da',
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
                'title' => 'Contact Us',
                'subtitle' => 'We are here to help you',
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
                'title' => 'Contáctenos',
                'subtitle' => 'Estamos aquí para ayudarle',
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

    <x-slot name="title">{{ $t['title'] }}</x-slot>

    <!-- Hero -->
    <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-bold mb-4">{{ $t['title'] }}</h1>
            <p class="text-xl">{{ $t['subtitle'] }}</p>
        </div>
    </div>

    <!-- Contact Form & Info -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <form method="POST" action="#" class="space-y-6">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ $t['name'] }}
                            </label>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ $t['email'] }}
                            </label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ $t['phone'] }}
                            </label>
                            <input type="tel"
                                   id="phone"
                                   name="phone"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                        </div>

                        <!-- Subject -->
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ $t['subject'] }}
                            </label>
                            <input type="text"
                                   id="subject"
                                   name="subject"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                        </div>

                        <!-- Contact Method -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ $t['contact_methods'] }}
                            </label>
                            <div class="flex space-x-4">
                                <label class="flex items-center">
                                    <input type="radio" name="preferred_contact_method" value="email" checked class="text-pink-600 focus:ring-pink-500">
                                    <span class="ml-2 text-sm text-gray-700">{{ $t['method_email'] }}</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="preferred_contact_method" value="phone" class="text-pink-600 focus:ring-pink-500">
                                    <span class="ml-2 text-sm text-gray-700">{{ $t['method_phone'] }}</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="preferred_contact_method" value="whatsapp" class="text-pink-600 focus:ring-pink-500">
                                    <span class="ml-2 text-sm text-gray-700">{{ $t['method_whatsapp'] }}</span>
                                </label>
                            </div>
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ $t['message'] }}
                            </label>
                            <textarea id="message"
                                      name="message"
                                      rows="6"
                                      required
                                      class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                                class="w-full bg-pink-600 hover:bg-pink-700 text-white font-semibold py-3 rounded-md transition-colors">
                            {{ $t['send'] }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="lg:col-span-1">
                <div class="bg-gray-50 rounded-lg p-6 space-y-6">
                    <!-- Address -->
                    <div>
                        <h3 class="font-semibold mb-3">
                            @if($currentLocale === 'fr')
                                Siège social
                            @elseif($currentLocale === 'de')
                                Hauptsitz
                            @elseif($currentLocale === 'en')
                                Headquarters
                            @else
                                Sede central
                            @endif
                        </h3>
                        <p class="text-sm text-gray-600">
                            acrevis Bank AG<br>
                            Marktplatz 1<br>
                            9004 St.Gallen<br>
                            Switzerland
                        </p>
                    </div>

                    <!-- Phone -->
                    <div>
                        <h3 class="font-semibold mb-3">{{ $t['phone'] }}</h3>
                        <p class="text-sm text-gray-600">+41 71 227 27 27</p>
                    </div>

                    <!-- Email -->
                    <div>
                        <h3 class="font-semibold mb-3">{{ $t['email'] }}</h3>
                        <p class="text-sm text-gray-600">info@acrevis.ch</p>
                    </div>

                    <!-- Opening Hours -->
                    <div>
                        <h3 class="font-semibold mb-3">
                            @if($currentLocale === 'fr')
                                Horaires d'ouverture
                            @elseif($currentLocale === 'de')
                                Öffnungszeiten
                            @elseif($currentLocale === 'en')
                                Opening Hours
                            @else
                                Horario de apertura
                            @endif
                        </h3>
                        <p class="text-sm text-gray-600">
                            @if($currentLocale === 'fr')
                                Lundi - Vendredi: 08:00 - 17:00
                            @elseif($currentLocale === 'de')
                                Montag - Freitag: 08:00 - 17:00
                            @elseif($currentLocale === 'en')
                                Monday - Friday: 08:00 - 17:00
                            @else
                                Lunes - Viernes: 08:00 - 17:00
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
