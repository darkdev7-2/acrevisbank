@php
    $currentLocale = app()->getLocale();

    $footerTranslations = [
        'headquarters' => ['fr' => 'Siège social', 'de' => 'Hauptsitz', 'en' => 'Headquarters', 'es' => 'Sede central'],
        'privacy' => ['fr' => 'Protection des données', 'de' => 'Datenschutz', 'en' => 'Privacy', 'es' => 'Privacidad'],
        'legal' => ['fr' => 'Mentions légales', 'de' => 'Rechtliche Hinweise zur Website', 'en' => 'Legal Notice', 'es' => 'Aviso Legal'],
        'impressum' => ['fr' => 'Impressum', 'de' => 'Impressum', 'en' => 'Impressum', 'es' => 'Impressum'],
        'newsletter_title' => ['fr' => 'Restez informé', 'de' => 'Bleiben Sie informiert', 'en' => 'Stay informed', 'es' => 'Manténgase informado'],
        'newsletter_desc' => ['fr' => 'Recevez nos dernières actualités et offres exclusives', 'de' => 'Erhalten Sie unsere neuesten Nachrichten und exklusiven Angebote', 'en' => 'Receive our latest news and exclusive offers', 'es' => 'Reciba nuestras últimas noticias y ofertas exclusivas'],
        'email_placeholder' => ['fr' => 'Votre email', 'de' => 'Ihre E-Mail', 'en' => 'Your email', 'es' => 'Su email'],
        'subscribe' => ['fr' => 'S\'inscrire', 'de' => 'Abonnieren', 'en' => 'Subscribe', 'es' => 'Suscribirse'],
    ];
@endphp

<footer class="bg-slate-900 text-slate-300 mt-20">
    <!-- Main Footer Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
            <!-- Company Info -->
            <div class="lg:col-span-2">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-white">Acrevis Bank</span>
                </div>
                <p class="text-sm text-slate-400 mb-6 max-w-sm">
                    @if($currentLocale === 'fr')
                        Votre banque de proximité en Suisse. Depuis plus de 10 ans, nous accompagnons particuliers et entreprises avec professionnalisme et expertise.
                    @elseif($currentLocale === 'de')
                        Ihre Bank in der Nähe in der Schweiz. Seit über 10 Jahren begleiten wir Privatpersonen und Unternehmen mit Professionalität und Expertise.
                    @elseif($currentLocale === 'en')
                        Your local bank in Switzerland. For over 10 years, we have been supporting individuals and businesses with professionalism and expertise.
                    @else
                        Su banco local en Suiza. Durante más de 10 años, apoyamos a particulares y empresas con profesionalismo y experiencia.
                    @endif
                </p>

                <h4 class="text-sm font-semibold text-white mb-3">{{ $footerTranslations['headquarters'][$currentLocale] }}</h4>
                <p class="text-sm text-slate-400 mb-4">
                    acrevis Bank AG<br>
                    Marktplatz 1<br>
                    9004 St.Gallen<br>
                    Switzerland
                </p>

                <!-- Social Media -->
                <div class="flex space-x-3">
                    <a href="https://linkedin.com" target="_blank" class="w-9 h-9 bg-slate-800 hover:bg-blue-600 rounded-lg flex items-center justify-center transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                        </svg>
                    </a>
                    <a href="https://youtube.com" target="_blank" class="w-9 h-9 bg-slate-800 hover:bg-red-600 rounded-lg flex items-center justify-center transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                        </svg>
                    </a>
                    <a href="https://facebook.com" target="_blank" class="w-9 h-9 bg-slate-800 hover:bg-blue-700 rounded-lg flex items-center justify-center transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/>
                        </svg>
                    </a>
                    <a href="https://instagram.com" target="_blank" class="w-9 h-9 bg-slate-800 hover:bg-pink-600 rounded-lg flex items-center justify-center transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Services Column -->
            <div>
                <h3 class="text-sm font-semibold text-white mb-4">
                    @if($currentLocale === 'fr')
                        Services Bancaires
                    @elseif($currentLocale === 'de')
                        Bankdienstleistungen
                    @elseif($currentLocale === 'en')
                        Banking Services
                    @else
                        Servicios Bancarios
                    @endif
                </h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('services.accounts', ['locale' => $currentLocale]) }}" class="text-sm text-slate-400 hover:text-blue-400 transition-colors">
                            {{ $currentLocale === 'fr' ? 'Comptes & Cartes' : ($currentLocale === 'de' ? 'Konto & Karte' : ($currentLocale === 'en' ? 'Accounts & Cards' : 'Cuentas y Tarjetas')) }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('services.housing', ['locale' => $currentLocale]) }}" class="text-sm text-slate-400 hover:text-blue-400 transition-colors">
                            {{ $currentLocale === 'fr' ? 'Hypothèques' : ($currentLocale === 'de' ? 'Hypotheken' : ($currentLocale === 'en' ? 'Mortgages' : 'Hipotecas')) }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('services.invest', ['locale' => $currentLocale]) }}" class="text-sm text-slate-400 hover:text-blue-400 transition-colors">
                            {{ $currentLocale === 'fr' ? 'Placements' : ($currentLocale === 'de' ? 'Anlagen' : ($currentLocale === 'en' ? 'Investments' : 'Inversiones')) }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('services.planning', ['locale' => $currentLocale]) }}" class="text-sm text-slate-400 hover:text-blue-400 transition-colors">
                            {{ $currentLocale === 'fr' ? 'Prévoyance' : ($currentLocale === 'de' ? 'Vorsorge' : ($currentLocale === 'en' ? 'Pension' : 'Previsión')) }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('credit.request', ['locale' => $currentLocale]) }}" class="text-sm text-slate-400 hover:text-blue-400 transition-colors">
                            {{ $currentLocale === 'fr' ? 'Demande de crédit' : ($currentLocale === 'de' ? 'Kreditantrag' : ($currentLocale === 'en' ? 'Credit request' : 'Solicitud de crédito')) }}
                        </a>
                    </li>
                </ul>
            </div>

            <!-- About Column -->
            <div>
                <h3 class="text-sm font-semibold text-white mb-4">
                    {{ $currentLocale === 'fr' ? 'À propos' : ($currentLocale === 'de' ? 'Über uns' : ($currentLocale === 'en' ? 'About' : 'Nosotros')) }}
                </h3>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('about', ['locale' => $currentLocale]) }}" class="text-sm text-slate-400 hover:text-blue-400 transition-colors">
                            {{ $currentLocale === 'fr' ? 'Notre banque' : ($currentLocale === 'de' ? 'Unsere Bank' : ($currentLocale === 'en' ? 'Our Bank' : 'Nuestro Banco')) }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('agencies', ['locale' => $currentLocale]) }}" class="text-sm text-slate-400 hover:text-blue-400 transition-colors">
                            {{ $currentLocale === 'fr' ? 'Nos agences' : ($currentLocale === 'de' ? 'Standorte' : ($currentLocale === 'en' ? 'Branches' : 'Agencias')) }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('career.index', ['locale' => $currentLocale]) }}" class="text-sm text-slate-400 hover:text-blue-400 transition-colors">
                            {{ $currentLocale === 'fr' ? 'Carrières' : ($currentLocale === 'de' ? 'Karriere' : ($currentLocale === 'en' ? 'Careers' : 'Carreras')) }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('blog', ['locale' => $currentLocale]) }}" class="text-sm text-slate-400 hover:text-blue-400 transition-colors">
                            Blog
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact', ['locale' => $currentLocale]) }}" class="text-sm text-slate-400 hover:text-blue-400 transition-colors">
                            Contact
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('faq', ['locale' => $currentLocale]) }}" class="text-sm text-slate-400 hover:text-blue-400 transition-colors">
                            FAQ
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Newsletter Column -->
            <div>
                <h3 class="text-sm font-semibold text-white mb-4">{{ $footerTranslations['newsletter_title'][$currentLocale] }}</h3>
                <p class="text-sm text-slate-400 mb-4">
                    {{ $footerTranslations['newsletter_desc'][$currentLocale] }}
                </p>
                <form action="#" method="POST" class="space-y-3">
                    @csrf
                    <input type="email"
                           name="email"
                           placeholder="{{ $footerTranslations['email_placeholder'][$currentLocale] }}"
                           class="w-full px-4 py-2.5 bg-slate-800 border border-slate-700 rounded-lg text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2.5 rounded-lg transition-colors text-sm">
                        {{ $footerTranslations['subscribe'][$currentLocale] }}
                    </button>
                </form>
            </div>
        </div>

    <!-- Bottom Bar -->
    <div class="border-t border-slate-800 mt-12 pt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-sm text-slate-400 mb-4 md:mb-0">
                    © {{ date('Y') }} acrevis Bank AG -
                    @if($currentLocale === 'fr')
                        Tous droits réservés
                    @elseif($currentLocale === 'de')
                        Alle Rechte vorbehalten
                    @elseif($currentLocale === 'en')
                        All rights reserved
                    @else
                        Todos los derechos reservados
                    @endif
                </div>
                <div class="flex flex-wrap justify-center gap-6">
                    <a href="{{ route('legal.privacy', ['locale' => $currentLocale]) }}" class="text-sm text-slate-400 hover:text-blue-400 transition-colors">
                        {{ $footerTranslations['privacy'][$currentLocale] }}
                    </a>
                    <a href="{{ route('legal.terms', ['locale' => $currentLocale]) }}" class="text-sm text-slate-400 hover:text-blue-400 transition-colors">
                        {{ $footerTranslations['legal'][$currentLocale] }}
                    </a>
                    <a href="{{ route('legal.impressum', ['locale' => $currentLocale]) }}" class="text-sm text-slate-400 hover:text-blue-400 transition-colors">
                        {{ $footerTranslations['impressum'][$currentLocale] }}
                    </a>
                    <a href="{{ route('faq', ['locale' => $currentLocale]) }}" class="text-sm text-slate-400 hover:text-blue-400 transition-colors">
                        FAQ
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
