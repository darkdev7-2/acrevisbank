<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();
        $translations = [
            'fr' => ['title' => 'Mentions Légales', 'subtitle' => 'Informations légales et de contact'],
            'de' => ['title' => 'Impressum', 'subtitle' => 'Rechtliche Informationen und Kontakt'],
            'en' => ['title' => 'Legal Notice', 'subtitle' => 'Legal information and contact'],
            'es' => ['title' => 'Aviso Legal', 'subtitle' => 'Información legal y de contacto'],
        ];
        $t = $translations[$currentLocale];
    @endphp

    <x-slot name="title">{{ $t['title'] }}</x-slot>

    <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $t['title'] }}</h1>
            <p class="text-xl text-pink-100">{{ $t['subtitle'] }}</p>
        </div>
    </div>

    <div class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md p-8">
                <div class="space-y-8">
                    <div>
                        <h2 class="text-2xl font-bold mb-4">Acrevis Bank AG</h2>
                        <p class="text-gray-700">
                            St. Leonhardstrasse 25<br>
                            9001 St. Gallen<br>
                            Suisse / Schweiz / Switzerland
                        </p>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold mb-3">Contact</h3>
                        <p class="text-gray-700">
                            <strong>Téléphone / Telefon / Phone:</strong> +41 71 227 27 27<br>
                            <strong>Email:</strong> info@acrevis.ch<br>
                            <strong>Web:</strong> www.acrevis.ch
                        </p>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold mb-3">Informations légales / Rechtliche Informationen / Legal Information</h3>
                        <p class="text-gray-700">
                            <strong>N° d'identification IDE / UID / UID:</strong> CHE-123.456.789<br>
                            <strong>Registre du commerce / Handelsregister / Commercial Register:</strong> St. Gallen<br>
                            <strong>Autorité de surveillance / Aufsichtsbehörde / Supervisory Authority:</strong> FINMA (Autorité fédérale de surveillance des marchés financiers)
                        </p>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold mb-3">Direction / Geschäftsleitung / Management</h3>
                        <p class="text-gray-700">
                            CEO: Dr. Thomas Müller<br>
                            CFO: Markus Weber<br>
                            COO: Sandra Schneider
                        </p>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold mb-3">Assurances / Versicherungen / Insurance</h3>
                        <p class="text-gray-700">
                            Les dépôts sont protégés par le système de garantie des dépôts suisse jusqu'à CHF 100'000 par client.<br>
                            <br>
                            Einlagen sind durch das schweizerische Einlagensicherungssystem bis CHF 100'000 pro Kunde geschützt.<br>
                            <br>
                            Deposits are protected by the Swiss deposit guarantee system up to CHF 100,000 per customer.
                        </p>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold mb-3">Droit d'auteur / Urheberrecht / Copyright</h3>
                        <p class="text-gray-700">
                            © 2025 Acrevis Bank AG. Tous droits réservés. / Alle Rechte vorbehalten. / All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
