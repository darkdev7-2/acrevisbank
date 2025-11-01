@php
    $currentLocale = app()->getLocale();

    $cookieTexts = [
        'fr' => [
            'message' => 'Nous utilisons des cookies pour améliorer votre expérience sur notre site. En continuant, vous acceptez notre politique de cookies.',
            'accept' => 'Accepter',
            'decline' => 'Refuser',
            'settings' => 'Paramètres',
            'privacy' => 'En savoir plus'
        ],
        'de' => [
            'message' => 'Wir verwenden Cookies, um Ihr Erlebnis auf unserer Website zu verbessern. Wenn Sie fortfahren, akzeptieren Sie unsere Cookie-Richtlinie.',
            'accept' => 'Akzeptieren',
            'decline' => 'Ablehnen',
            'settings' => 'Einstellungen',
            'privacy' => 'Mehr erfahren'
        ],
        'en' => [
            'message' => 'We use cookies to improve your experience on our site. By continuing, you accept our cookie policy.',
            'accept' => 'Accept',
            'decline' => 'Decline',
            'settings' => 'Settings',
            'privacy' => 'Learn more'
        ],
        'es' => [
            'message' => 'Utilizamos cookies para mejorar su experiencia en nuestro sitio. Al continuar, acepta nuestra política de cookies.',
            'accept' => 'Aceptar',
            'decline' => 'Rechazar',
            'settings' => 'Configuración',
            'privacy' => 'Saber más'
        ]
    ];

    $texts = $cookieTexts[$currentLocale];
@endphp

<div x-data="{
    show: !localStorage.getItem('cookie_consent'),
    accept() {
        localStorage.setItem('cookie_consent', 'accepted');
        this.show = false;
    },
    decline() {
        localStorage.setItem('cookie_consent', 'declined');
        this.show = false;
    }
}"
x-show="show"
x-transition:enter="transition ease-out duration-300"
x-transition:enter-start="opacity-0 translate-y-4"
x-transition:enter-end="opacity-100 translate-y-0"
x-transition:leave="transition ease-in duration-200"
x-transition:leave-start="opacity-100"
x-transition:leave-end="opacity-0"
class="fixed bottom-0 inset-x-0 pb-2 sm:pb-5 z-50"
style="display: none;">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="p-4 rounded-lg bg-gray-900 shadow-lg sm:p-6">
            <div class="flex items-center justify-between flex-wrap">
                <div class="w-0 flex-1 flex items-center">
                    <span class="flex p-2 rounded-lg bg-gray-800">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                    </span>
                    <p class="ml-3 font-medium text-white text-sm">
                        {{ $texts['message'] }}
                        <a href="{{ route('legal.privacy', ['locale' => $currentLocale]) }}" class="text-pink-400 hover:text-pink-300 underline ml-1">
                            {{ $texts['privacy'] }}
                        </a>
                    </p>
                </div>
                <div class="order-3 mt-2 flex-shrink-0 w-full sm:order-2 sm:mt-0 sm:w-auto">
                    <div class="flex space-x-2">
                        <button @click="decline()"
                                class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-900 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                            {{ $texts['decline'] }}
                        </button>
                        <button @click="accept()"
                                class="flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pink-600 hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                            {{ $texts['accept'] }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
