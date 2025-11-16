<x-layouts.app>
    @php
        use App\Models\ContactInfo;
        $currentLocale = app()->getLocale();
        $contactInfos = ContactInfo::active()->get();

        $texts = [
            'fr' => [
                'title' => 'Contactez-nous',
                'subtitle' => 'Nous sommes là pour vous aider',
                'email' => 'Email',
                'phone' => 'Téléphone',
            ],
            'de' => [
                'title' => 'Kontaktieren Sie uns',
                'subtitle' => 'Wir sind für Sie da',
                'email' => 'E-Mail',
                'phone' => 'Telefon',
            ],
            'en' => [
                'title' => 'Contact Us',
                'subtitle' => 'We are here to help you',
                'email' => 'Email',
                'phone' => 'Phone',
            ],
            'es' => [
                'title' => 'Contáctenos',
                'subtitle' => 'Estamos aquí para ayudarle',
                'email' => 'Correo electrónico',
                'phone' => 'Teléfono',
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
                    @livewire('contact-form')
                </div>
            </div>

            <!-- Contact Info -->
            <div class="lg:col-span-1 space-y-6">
                @foreach($contactInfos as $contactInfo)
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h3 class="font-bold text-lg mb-4 text-pink-600">{{ $contactInfo->name }}</h3>

                        @if($contactInfo->address || $contactInfo->city)
                            <div class="mb-4">
                                <h4 class="font-semibold text-sm mb-2">
                                    @if($currentLocale === 'fr') Adresse
                                    @elseif($currentLocale === 'de') Adresse
                                    @elseif($currentLocale === 'en') Address
                                    @else Dirección @endif
                                </h4>
                                <p class="text-sm text-gray-600">
                                    @if($contactInfo->type === 'headquarters')acrevis Bank AG<br>@endif
                                    @if($contactInfo->address){{ $contactInfo->getTranslation('address', $currentLocale) }}<br>@endif
                                    @if($contactInfo->postal_code && $contactInfo->city){{ $contactInfo->postal_code }} {{ $contactInfo->city }}<br>@endif
                                    @if($contactInfo->country){{ $contactInfo->country }}@endif
                                </p>
                            </div>
                        @endif

                        @if($contactInfo->phone)
                            <div class="mb-4">
                                <h4 class="font-semibold text-sm mb-2">{{ $t['phone'] }}</h4>
                                <p class="text-sm text-gray-600">
                                    <a href="tel:{{ $contactInfo->phone }}" class="hover:text-pink-600">{{ $contactInfo->phone }}</a>
                                    @if($contactInfo->phone_alt)
                                        <br><a href="tel:{{ $contactInfo->phone_alt }}" class="hover:text-pink-600">{{ $contactInfo->phone_alt }}</a>
                                    @endif
                                </p>
                            </div>
                        @endif

                        @if($contactInfo->email)
                            <div class="mb-4">
                                <h4 class="font-semibold text-sm mb-2">{{ $t['email'] }}</h4>
                                <p class="text-sm text-gray-600">
                                    <a href="mailto:{{ $contactInfo->email }}" class="hover:text-pink-600">{{ $contactInfo->email }}</a>
                                    @if($contactInfo->email_alt)
                                        <br><a href="mailto:{{ $contactInfo->email_alt }}" class="hover:text-pink-600">{{ $contactInfo->email_alt }}</a>
                                    @endif
                                </p>
                            </div>
                        @endif

                        @if($contactInfo->whatsapp)
                            <div class="mb-4">
                                <h4 class="font-semibold text-sm mb-2">WhatsApp</h4>
                                <p class="text-sm text-gray-600">
                                    <a href="https://wa.me/{{ str_replace(['+', ' '], '', $contactInfo->whatsapp) }}" target="_blank" class="hover:text-pink-600">
                                        {{ $contactInfo->whatsapp }}
                                    </a>
                                </p>
                            </div>
                        @endif

                        @if($contactInfo->opening_hours)
                            <div>
                                <h4 class="font-semibold text-sm mb-2">
                                    @if($currentLocale === 'fr') Horaires d'ouverture
                                    @elseif($currentLocale === 'de') Öffnungszeiten
                                    @elseif($currentLocale === 'en') Opening Hours
                                    @else Horario de apertura @endif
                                </h4>
                                <div class="text-sm text-gray-600 space-y-1">
                                    @foreach($contactInfo->formatted_opening_hours as $day => $hours)
                                        <div class="flex justify-between">
                                            <span>{{ $day }}:</span>
                                            <span class="font-medium">{{ $hours }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</x-layouts.app>
