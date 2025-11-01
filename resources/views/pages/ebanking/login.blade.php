<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();

        $texts = [
            'fr' => [
                'title' => 'Login acrevis E-Banking',
                'contract' => 'Numéro de contrat',
                'password' => 'Mot de passe',
                'login' => 'Login',
                'forgot' => 'Mot de passe oublié? Cliquez',
                'here' => 'ici',
                'info_title' => 'Informations',
                'secure_title' => 'E-Banking – mais sécurisé!',
                'faq_title' => 'Questions et réponses sur l\'E-Banking'
            ],
            'de' => [
                'title' => 'Login acrevis E-Banking',
                'contract' => 'Vertragsnummer',
                'password' => 'Passwort',
                'login' => 'Login',
                'forgot' => 'Passwort vergessen? Klicken Sie',
                'here' => 'hier',
                'info_title' => 'Informationen',
                'secure_title' => 'E-Banking – aber sicher!',
                'faq_title' => 'Fragen und Antworten zum E-Banking'
            ],
            'en' => [
                'title' => 'Login acrevis E-Banking',
                'contract' => 'Contract number',
                'password' => 'Password',
                'login' => 'Login',
                'forgot' => 'Forgot password? Click',
                'here' => 'here',
                'info_title' => 'Information',
                'secure_title' => 'E-Banking – but secure!',
                'faq_title' => 'Questions and answers about E-Banking'
            ],
            'es' => [
                'title' => 'Login acrevis E-Banking',
                'contract' => 'Número de contrato',
                'password' => 'Contraseña',
                'login' => 'Iniciar sesión',
                'forgot' => '¿Olvidó su contraseña? Haga clic',
                'here' => 'aquí',
                'info_title' => 'Información',
                'secure_title' => 'E-Banking – ¡pero seguro!',
                'faq_title' => 'Preguntas y respuestas sobre E-Banking'
            ]
        ];

        $t = $texts[$currentLocale];
    @endphp

    <x-slot name="title">{{ $t['title'] }}</x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex items-center justify-center mb-8">
            <div class="text-center">
                <span class="text-3xl font-bold text-pink-600">acrevis</span>
                <p class="text-sm text-gray-600 mt-1">Meine Bank fürs Leben</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Login Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <h1 class="text-2xl font-bold mb-6">{{ $t['title'] }}</h1>

                    <form method="POST" action="#" class="space-y-6">
                        @csrf

                        <!-- Contract Number -->
                        <div>
                            <label for="contract_number" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ $t['contract'] }}
                            </label>
                            <input type="text"
                                   id="contract_number"
                                   name="contract_number"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ $t['password'] }}
                            </label>
                            <input type="password"
                                   id="password"
                                   name="password"
                                   required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                                class="w-full bg-pink-600 hover:bg-pink-700 text-white font-semibold py-3 rounded-md transition-colors">
                            {{ $t['login'] }}
                        </button>

                        <!-- Forgot Password -->
                        <p class="text-sm text-center text-gray-600">
                            {{ $t['forgot'] }}
                            <a href="{{ route('ebanking.lost-password', ['locale' => $currentLocale]) }}" class="text-pink-600 hover:text-pink-700 font-medium">
                                {{ $t['here'] }}
                            </a>
                        </p>
                    </form>

                    <!-- New E-Banking Notice -->
                    <div class="mt-8 p-6 bg-gray-50 rounded-lg">
                        <h3 class="font-semibold mb-2">
                            @if($currentLocale === 'fr')
                                Nouveau E-Banking et Mobile Banking: Lancement fin octobre 2025
                            @elseif($currentLocale === 'de')
                                Neues E-Banking und Mobile Banking: Einführung ab Ende Oktober 2025
                            @elseif($currentLocale === 'en')
                                New E-Banking and Mobile Banking: Launch end of October 2025
                            @else
                                Nuevo E-Banking y Mobile Banking: Lanzamiento finales de octubre 2025
                            @endif
                        </h3>
                        <p class="text-sm text-gray-600">
                            @if($currentLocale === 'fr')
                                Nous passerons progressivement à un nouveau digital banking dès fin octobre. Peu avant l'accès au nouvel E-Banking, vous serez informés.
                            @elseif($currentLocale === 'de')
                                Wir stellen ab Ende Oktober schrittweise auf ein neues Digital Banking um. Kurz bevor Ihr Zugang für den Wechsel auf das neue E-Banking bereitsteht, werden Sie von uns informiert.
                            @elseif($currentLocale === 'en')
                                We are gradually switching to new digital banking from the end of October. Shortly before your access to the new E-Banking is ready, you will be informed by us.
                            @else
                                Cambiaremos progresivamente a una nueva banca digital a partir de finales de octubre. Poco antes de que su acceso a la nueva E-Banking esté listo, será informado por nosotros.
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Info Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-gray-50 rounded-lg p-6">
                    <h2 class="text-lg font-semibold mb-4">{{ $t['info_title'] }}</h2>

                    <div class="space-y-4">
                        <a href="#" class="flex items-start space-x-2 text-gray-700 hover:text-pink-600 group">
                            <svg class="w-5 h-5 mt-0.5 group-hover:text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            <span class="text-sm">{{ $t['secure_title'] }}</span>
                        </a>

                        <a href="#" class="flex items-start space-x-2 text-gray-700 hover:text-pink-600 group">
                            <svg class="w-5 h-5 mt-0.5 group-hover:text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            <span class="text-sm">{{ $t['faq_title'] }}</span>
                        </a>
                    </div>

                    <!-- Security Notice -->
                    <div class="mt-6 p-4 bg-white rounded border border-gray-200">
                        <h3 class="font-semibold text-sm mb-2">
                            @if($currentLocale === 'fr')
                                Conseils de sécurité
                            @elseif($currentLocale === 'de')
                                Sicherheitshinweis
                            @elseif($currentLocale === 'en')
                                Security Notice
                            @else
                                Aviso de Seguridad
                            @endif
                        </h3>
                        <p class="text-xs text-gray-600">
                            @if($currentLocale === 'fr')
                                Protégez vos données en ne donnant jamais votre mot de passe à des tiers. N'utilisez l'E-Banking que via notre site officiel acrevis.ch.
                            @elseif($currentLocale === 'de')
                                Schützen Sie Ihre Daten vor unberechtigtem Zugriff und geben Sie diese niemals an Dritte weiter. Klicken Sie nicht auf Suchmaschinen-Anzeigen oder auf fremde Links, die zu gefälschten Login-Seiten führen können.
                            @elseif($currentLocale === 'en')
                                Protect your data and never share it with third parties. Do not click on search engine ads or foreign links that may lead to fake login pages.
                            @else
                                Proteja sus datos y nunca los comparta con terceros. No haga clic en anuncios de motores de búsqueda ni en enlaces extraños que puedan conducir a páginas de inicio de sesión falsas.
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>
