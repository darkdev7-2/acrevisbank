<x-layouts.app>
    @php $currentLocale = app()->getLocale(); @endphp
    <x-slot name="title">{{ $currentLocale === 'fr' ? 'Mot de passe oublié' : ($currentLocale === 'de' ? 'Passwort vergessen' : ($currentLocale === 'en' ? 'Forgot password' : 'Contraseña olvidada')) }}</x-slot>

    <div class="py-16 bg-gray-50">
        <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md p-8">
                <div class="text-center mb-6">
                    <h1 class="text-3xl font-bold mb-2">{{ $currentLocale === 'fr' ? 'Mot de passe oublié' : ($currentLocale === 'de' ? 'Passwort vergessen' : ($currentLocale === 'en' ? 'Forgot password' : 'Contraseña olvidada')) }}</h1>
                    <p class="text-gray-600">{{ $currentLocale === 'fr' ? 'Entrez votre identifiant pour réinitialiser votre mot de passe' : ($currentLocale === 'de' ? 'Geben Sie Ihre Benutzer-ID ein, um Ihr Passwort zurückzusetzen' : ($currentLocale === 'en' ? 'Enter your username to reset your password' : 'Introduzca su nombre de usuario para restablecer su contraseña')) }}</p>
                </div>

                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ $currentLocale === 'fr' ? 'Identifiant' : ($currentLocale === 'de' ? 'Benutzer-ID' : ($currentLocale === 'en' ? 'Username' : 'Nombre de usuario')) }}</label>
                        <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-pink-500 focus:border-pink-500" required>
                    </div>

                    <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white py-3 rounded-md font-semibold transition-colors">
                        {{ $currentLocale === 'fr' ? 'Réinitialiser' : ($currentLocale === 'de' ? 'Zurücksetzen' : ($currentLocale === 'en' ? 'Reset' : 'Restablecer')) }}
                    </button>

                    <div class="text-center text-sm">
                        <a href="{{ route('ebanking.login', ['locale' => $currentLocale]) }}" class="text-pink-600 hover:text-pink-700">
                            {{ $currentLocale === 'fr' ? '← Retour à la connexion' : ($currentLocale === 'de' ? '← Zurück zur Anmeldung' : ($currentLocale === 'en' ? '← Back to login' : '← Volver al inicio de sesión')) }}
                        </a>
                    </div>
                </form>

                <div class="mt-6 pt-6 border-t border-gray-200 text-sm text-gray-600">
                    <p>{{ $currentLocale === 'fr' ? 'Besoin d\'aide ?' : ($currentLocale === 'de' ? 'Brauchen Sie Hilfe?' : ($currentLocale === 'en' ? 'Need help?' : '¿Necesita ayuda?')) }}</p>
                    <p class="mt-2">{{ $currentLocale === 'fr' ? 'Contactez-nous au' : ($currentLocale === 'de' ? 'Kontaktieren Sie uns unter' : ($currentLocale === 'en' ? 'Contact us at' : 'Contáctenos al')) }} <a href="tel:+41712272727" class="text-pink-600 hover:underline">+41 71 227 27 27</a></p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
