<x-layouts.app>
    @php
        $currentLocale = app()->getLocale();
        $translations = [
            'fr' => [
                'title' => 'Politique de Confidentialité',
                'subtitle' => 'Protection de vos données personnelles',
                'updated' => 'Dernière mise à jour : 1er novembre 2025',
            ],
            'de' => [
                'title' => 'Datenschutzrichtlinie',
                'subtitle' => 'Schutz Ihrer persönlichen Daten',
                'updated' => 'Letzte Aktualisierung: 1. November 2025',
            ],
            'en' => [
                'title' => 'Privacy Policy',
                'subtitle' => 'Protection of your personal data',
                'updated' => 'Last updated: November 1, 2025',
            ],
            'es' => [
                'title' => 'Política de Privacidad',
                'subtitle' => 'Protección de sus datos personales',
                'updated' => 'Última actualización: 1 de noviembre de 2025',
            ],
        ];
        $t = $translations[$currentLocale];
    @endphp

    <x-slot name="title">{{ $t['title'] }}</x-slot>

    <!-- Hero -->
    <div class="bg-gradient-to-r from-pink-600 to-pink-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $t['title'] }}</h1>
            <p class="text-xl text-pink-100">{{ $t['subtitle'] }}</p>
            <p class="text-sm text-pink-200 mt-4">{{ $t['updated'] }}</p>
        </div>
    </div>

    <!-- Content -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md p-8 prose max-w-none">
                @if($currentLocale === 'fr')
                    <h2>1. Introduction</h2>
                    <p>Acrevis Bank AG s'engage à protéger la confidentialité et la sécurité de vos données personnelles. Cette politique explique comment nous collectons, utilisons et protégeons vos informations.</p>

                    <h2>2. Données collectées</h2>
                    <p>Nous collectons les données suivantes :</p>
                    <ul>
                        <li>Informations d'identification (nom, prénom, date de naissance)</li>
                        <li>Coordonnées (adresse, téléphone, email)</li>
                        <li>Données financières (transactions, soldes de comptes)</li>
                        <li>Données de navigation (cookies, logs)</li>
                    </ul>

                    <h2>3. Utilisation des données</h2>
                    <p>Vos données sont utilisées pour :</p>
                    <ul>
                        <li>Fournir nos services bancaires</li>
                        <li>Respecter nos obligations légales</li>
                        <li>Prévenir la fraude et assurer la sécurité</li>
                        <li>Améliorer nos services</li>
                    </ul>

                    <h2>4. Protection des données</h2>
                    <p>Nous mettons en œuvre des mesures de sécurité strictes conformes aux normes bancaires suisses et internationales, incluant le chiffrement, l'authentification forte et la surveillance continue.</p>

                    <h2>5. Vos droits</h2>
                    <p>Vous avez le droit de :</p>
                    <ul>
                        <li>Accéder à vos données personnelles</li>
                        <li>Rectifier vos données</li>
                        <li>Demander l'effacement de vos données</li>
                        <li>Vous opposer au traitement</li>
                        <li>Demander la portabilité de vos données</li>
                    </ul>

                    <h2>6. Contact</h2>
                    <p>Pour toute question concernant vos données personnelles, contactez notre Délégué à la Protection des Données :</p>
                    <p><strong>Email :</strong> privacy@acrevis.ch<br>
                    <strong>Téléphone :</strong> +41 71 227 27 27<br>
                    <strong>Adresse :</strong> Acrevis Bank AG, St. Leonhardstrasse 25, 9001 St. Gallen</p>

                @elseif($currentLocale === 'de')
                    <h2>1. Einleitung</h2>
                    <p>Die Acrevis Bank AG verpflichtet sich, die Vertraulichkeit und Sicherheit Ihrer personenbezogenen Daten zu schützen. Diese Richtlinie erklärt, wie wir Ihre Informationen erfassen, verwenden und schützen.</p>

                    <h2>2. Erfasste Daten</h2>
                    <p>Wir erfassen folgende Daten:</p>
                    <ul>
                        <li>Identifikationsinformationen (Name, Vorname, Geburtsdatum)</li>
                        <li>Kontaktdaten (Adresse, Telefon, E-Mail)</li>
                        <li>Finanzdaten (Transaktionen, Kontostände)</li>
                        <li>Navigationsdaten (Cookies, Logs)</li>
                    </ul>

                    <h2>3. Verwendung der Daten</h2>
                    <p>Ihre Daten werden verwendet für:</p>
                    <ul>
                        <li>Bereitstellung unserer Bankdienstleistungen</li>
                        <li>Einhaltung unserer gesetzlichen Verpflichtungen</li>
                        <li>Betrugsbekämpfung und Sicherheit</li>
                        <li>Verbesserung unserer Dienstleistungen</li>
                    </ul>

                    <h2>4. Datenschutz</h2>
                    <p>Wir setzen strenge Sicherheitsmaßnahmen gemäß Schweizer und internationalen Bankenstandards um, einschließlich Verschlüsselung, starker Authentifizierung und kontinuierlicher Überwachung.</p>

                    <h2>5. Ihre Rechte</h2>
                    <p>Sie haben das Recht:</p>
                    <ul>
                        <li>Zugang zu Ihren personenbezogenen Daten</li>
                        <li>Berichtigung Ihrer Daten</li>
                        <li>Löschung Ihrer Daten zu verlangen</li>
                        <li>Der Verarbeitung zu widersprechen</li>
                        <li>Datenübertragbarkeit zu verlangen</li>
                    </ul>

                    <h2>6. Kontakt</h2>
                    <p>Für Fragen zu Ihren personenbezogenen Daten kontaktieren Sie unseren Datenschutzbeauftragten:</p>
                    <p><strong>E-Mail:</strong> privacy@acrevis.ch<br>
                    <strong>Telefon:</strong> +41 71 227 27 27<br>
                    <strong>Adresse:</strong> Acrevis Bank AG, St. Leonhardstrasse 25, 9001 St. Gallen</p>

                @elseif($currentLocale === 'en')
                    <h2>1. Introduction</h2>
                    <p>Acrevis Bank AG is committed to protecting the confidentiality and security of your personal data. This policy explains how we collect, use, and protect your information.</p>

                    <h2>2. Data Collected</h2>
                    <p>We collect the following data:</p>
                    <ul>
                        <li>Identification information (name, first name, date of birth)</li>
                        <li>Contact details (address, phone, email)</li>
                        <li>Financial data (transactions, account balances)</li>
                        <li>Navigation data (cookies, logs)</li>
                    </ul>

                    <h2>3. Use of Data</h2>
                    <p>Your data is used to:</p>
                    <ul>
                        <li>Provide our banking services</li>
                        <li>Comply with our legal obligations</li>
                        <li>Prevent fraud and ensure security</li>
                        <li>Improve our services</li>
                    </ul>

                    <h2>4. Data Protection</h2>
                    <p>We implement strict security measures in accordance with Swiss and international banking standards, including encryption, strong authentication, and continuous monitoring.</p>

                    <h2>5. Your Rights</h2>
                    <p>You have the right to:</p>
                    <ul>
                        <li>Access your personal data</li>
                        <li>Rectify your data</li>
                        <li>Request deletion of your data</li>
                        <li>Object to processing</li>
                        <li>Request data portability</li>
                    </ul>

                    <h2>6. Contact</h2>
                    <p>For any questions regarding your personal data, contact our Data Protection Officer:</p>
                    <p><strong>Email:</strong> privacy@acrevis.ch<br>
                    <strong>Phone:</strong> +41 71 227 27 27<br>
                    <strong>Address:</strong> Acrevis Bank AG, St. Leonhardstrasse 25, 9001 St. Gallen</p>

                @else
                    <h2>1. Introducción</h2>
                    <p>Acrevis Bank AG se compromete a proteger la confidencialidad y seguridad de sus datos personales. Esta política explica cómo recopilamos, utilizamos y protegemos su información.</p>

                    <h2>2. Datos Recopilados</h2>
                    <p>Recopilamos los siguientes datos:</p>
                    <ul>
                        <li>Información de identificación (nombre, apellido, fecha de nacimiento)</li>
                        <li>Datos de contacto (dirección, teléfono, email)</li>
                        <li>Datos financieros (transacciones, saldos)</li>
                        <li>Datos de navegación (cookies, logs)</li>
                    </ul>

                    <h2>3. Uso de los Datos</h2>
                    <p>Sus datos se utilizan para:</p>
                    <ul>
                        <li>Proporcionar nuestros servicios bancarios</li>
                        <li>Cumplir con nuestras obligaciones legales</li>
                        <li>Prevenir el fraude y garantizar la seguridad</li>
                        <li>Mejorar nuestros servicios</li>
                    </ul>

                    <h2>4. Protección de Datos</h2>
                    <p>Implementamos medidas de seguridad estrictas conforme a las normas bancarias suizas e internacionales, incluyendo cifrado, autenticación fuerte y monitoreo continuo.</p>

                    <h2>5. Sus Derechos</h2>
                    <p>Usted tiene derecho a:</p>
                    <ul>
                        <li>Acceder a sus datos personales</li>
                        <li>Rectificar sus datos</li>
                        <li>Solicitar la eliminación de sus datos</li>
                        <li>Oponerse al procesamiento</li>
                        <li>Solicitar la portabilidad de datos</li>
                    </ul>

                    <h2>6. Contacto</h2>
                    <p>Para cualquier pregunta sobre sus datos personales, contacte a nuestro Delegado de Protección de Datos:</p>
                    <p><strong>Email:</strong> privacy@acrevis.ch<br>
                    <strong>Teléfono:</strong> +41 71 227 27 27<br>
                    <strong>Dirección:</strong> Acrevis Bank AG, St. Leonhardstrasse 25, 9001 St. Gallen</p>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
