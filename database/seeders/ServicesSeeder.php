<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServicesSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            // CATÉGORIE 1: COMPTES & CARTES
            [
                'slug' => 'compte-prive',
                'category' => 'Comptes & Cartes',
                'segment' => 'privat',
                'icon' => 'heroicon-o-credit-card',
                'order' => 1,
                'title' => [
                    'fr' => 'Compte Privé',
                    'de' => 'Privatkonto',
                    'en' => 'Private Account',
                    'es' => 'Cuenta Privada'
                ],
                'description' => [
                    'fr' => 'Le compte courant flexible pour votre quotidien. Gérez vos finances en toute simplicité avec notre e-banking.',
                    'de' => 'Das flexible Girokonto für Ihren Alltag. Verwalten Sie Ihre Finanzen ganz einfach mit unserem E-Banking.',
                    'en' => 'The flexible current account for your daily needs. Manage your finances easily with our e-banking.',
                    'es' => 'La cuenta corriente flexible para su día a día. Gestione sus finanzas fácilmente con nuestra banca electrónica.'
                ],
                'content' => [
                    'fr' => '<h2>Votre compte au quotidien</h2><p>Le compte privé Acrevis est votre partenaire financier au quotidien. Conçu pour simplifier la gestion de vos finances, il vous offre un accès complet à tous nos services bancaires.</p><h3>Fonctionnalités principales</h3><ul><li>Virements illimités en Suisse</li><li>Paiements internationaux</li><li>Standing orders automatiques</li><li>E-banking et Mobile banking inclus</li><li>Carte de débit gratuite</li></ul><h3>Frais transparents</h3><p>CHF 5.- par mois, gratuit pour les jeunes jusqu\'à 25 ans.</p>',
                    'de' => '<h2>Ihr Konto für den Alltag</h2><p>Das Acrevis Privatkonto ist Ihr täglicher Finanzpartner. Es wurde entwickelt, um die Verwaltung Ihrer Finanzen zu vereinfachen und bietet Ihnen vollständigen Zugriff auf alle unsere Bankdienstleistungen.</p><h3>Hauptfunktionen</h3><ul><li>Unbegrenzte Überweisungen in der Schweiz</li><li>Internationale Zahlungen</li><li>Automatische Daueraufträge</li><li>E-Banking und Mobile Banking inklusive</li><li>Kostenlose Debitkarte</li></ul><h3>Transparente Gebühren</h3><p>CHF 5.- pro Monat, kostenlos für Jugendliche bis 25 Jahre.</p>',
                    'en' => '<h2>Your everyday account</h2><p>The Acrevis private account is your daily financial partner. Designed to simplify your financial management, it gives you complete access to all our banking services.</p><h3>Main features</h3><ul><li>Unlimited transfers in Switzerland</li><li>International payments</li><li>Automatic standing orders</li><li>E-banking and Mobile banking included</li><li>Free debit card</li></ul><h3>Transparent fees</h3><p>CHF 5.- per month, free for young people up to 25 years.</p>',
                    'es' => '<h2>Su cuenta diaria</h2><p>La cuenta privada Acrevis es su socio financiero diario. Diseñada para simplificar la gestión de sus finanzas, le ofrece acceso completo a todos nuestros servicios bancarios.</p><h3>Características principales</h3><ul><li>Transferencias ilimitadas en Suiza</li><li>Pagos internacionales</li><li>Órdenes permanentes automáticas</li><li>Banca electrónica y móvil incluidas</li><li>Tarjeta de débito gratuita</li></ul><h3>Tarifas transparentes</h3><p>CHF 5.- por mes, gratis para jóvenes hasta 25 años.</p>'
                ],
                'features' => [
                    'fr' => ['E-banking 24/7', 'Mobile Banking', 'Carte de débit gratuite', 'Virements SEPA', 'Standing orders'],
                    'de' => ['E-Banking 24/7', 'Mobile Banking', 'Kostenlose Debitkarte', 'SEPA-Überweisungen', 'Daueraufträge'],
                    'en' => ['E-banking 24/7', 'Mobile Banking', 'Free debit card', 'SEPA transfers', 'Standing orders'],
                    'es' => ['Banca electrónica 24/7', 'Banca móvil', 'Tarjeta de débito gratuita', 'Transferencias SEPA', 'Órdenes permanentes']
                ],
                'benefits' => [
                    'fr' => ['Gratuit jusqu\'à 25 ans', 'Accès multi-canal', 'Service client dédié', 'Sécurité maximale'],
                    'de' => ['Kostenlos bis 25 Jahre', 'Multi-Kanal-Zugang', 'Dedizierter Kundenservice', 'Maximale Sicherheit'],
                    'en' => ['Free up to 25 years', 'Multi-channel access', 'Dedicated customer service', 'Maximum security'],
                    'es' => ['Gratis hasta 25 años', 'Acceso multicanal', 'Servicio al cliente dedicado', 'Máxima seguridad']
                ],
            ],

            [
                'slug' => 'compte-epargne',
                'category' => 'Comptes & Cartes',
                'segment' => 'privat',
                'icon' => 'heroicon-o-banknotes',
                'order' => 2,
                'title' => [
                    'fr' => 'Compte d\'Épargne',
                    'de' => 'Sparkonto',
                    'en' => 'Savings Account',
                    'es' => 'Cuenta de Ahorro'
                ],
                'description' => [
                    'fr' => 'Épargnez en toute sécurité avec un taux d\'intérêt attractif. Votre argent disponible à tout moment.',
                    'de' => 'Sparen Sie sicher mit attraktivem Zinssatz. Ihr Geld jederzeit verfügbar.',
                    'en' => 'Save safely with an attractive interest rate. Your money available at any time.',
                    'es' => 'Ahorre de forma segura con una tasa de interés atractiva. Su dinero disponible en cualquier momento.'
                ],
                'content' => [
                    'fr' => '<h2>Faites fructifier votre épargne</h2><p>Le compte d\'épargne Acrevis vous permet de constituer votre réserve financière en toute sécurité tout en bénéficiant d\'une rémunération attractive.</p><h3>Taux d\'intérêt progressifs</h3><ul><li>Jusqu\'à CHF 25\'000: 0.50%</li><li>De CHF 25\'001 à 100\'000: 0.75%</li><li>Au-delà de CHF 100\'000: 1.00%</li></ul><h3>Flexibilité totale</h3><p>Retraits possibles à tout moment sans frais. Capital garanti par la garantie des dépôts suisse jusqu\'à CHF 100\'000.</p>',
                    'de' => '<h2>Lassen Sie Ihre Ersparnisse wachsen</h2><p>Das Acrevis Sparkonto ermöglicht es Ihnen, Ihre finanzielle Reserve sicher aufzubauen und gleichzeitig von einer attraktiven Verzinsung zu profitieren.</p><h3>Progressive Zinssätze</h3><ul><li>Bis CHF 25\'000: 0.50%</li><li>Von CHF 25\'001 bis 100\'000: 0.75%</li><li>Über CHF 100\'000: 1.00%</li></ul><h3>Volle Flexibilität</h3><p>Abhebungen jederzeit kostenlos möglich. Kapital durch die Schweizer Einlagensicherung bis CHF 100\'000 garantiert.</p>',
                    'en' => '<h2>Grow your savings</h2><p>The Acrevis savings account allows you to build your financial reserve safely while benefiting from attractive returns.</p><h3>Progressive interest rates</h3><ul><li>Up to CHF 25,000: 0.50%</li><li>From CHF 25,001 to 100,000: 0.75%</li><li>Over CHF 100,000: 1.00%</li></ul><h3>Total flexibility</h3><p>Withdrawals possible at any time without fees. Capital guaranteed by Swiss deposit insurance up to CHF 100,000.</p>',
                    'es' => '<h2>Haga crecer sus ahorros</h2><p>La cuenta de ahorro Acrevis le permite construir su reserva financiera de forma segura mientras se beneficia de rendimientos atractivos.</p><h3>Tasas de interés progresivas</h3><ul><li>Hasta CHF 25.000: 0.50%</li><li>De CHF 25.001 a 100.000: 0.75%</li><li>Más de CHF 100.000: 1.00%</li></ul><h3>Flexibilidad total</h3><p>Retiros posibles en cualquier momento sin comisiones. Capital garantizado por el seguro de depósitos suizo hasta CHF 100.000.</p>'
                ],
                'features' => [
                    'fr' => ['Taux progressifs', 'Aucun frais', 'Retraits illimités', 'Capital garanti'],
                    'de' => ['Progressive Zinsen', 'Keine Gebühren', 'Unbegrenzte Abhebungen', 'Garantiertes Kapital'],
                    'en' => ['Progressive rates', 'No fees', 'Unlimited withdrawals', 'Guaranteed capital'],
                    'es' => ['Tasas progresivas', 'Sin comisiones', 'Retiros ilimitados', 'Capital garantizado']
                ],
                'benefits' => [
                    'fr' => ['Rémunération attractive', 'Sécurité maximale', 'Disponibilité immédiate', 'Pas de montant minimum'],
                    'de' => ['Attraktive Verzinsung', 'Maximale Sicherheit', 'Sofortige Verfügbarkeit', 'Kein Mindestbetrag'],
                    'en' => ['Attractive returns', 'Maximum security', 'Immediate availability', 'No minimum amount'],
                    'es' => ['Rendimientos atractivos', 'Máxima seguridad', 'Disponibilidad inmediata', 'Sin monto mínimo']
                ],
            ],

            // Reste de Comptes & Cartes
            [
                'slug' => 'compte-jeunes',
                'category' => 'Comptes & Cartes',
                'segment' => 'privat',
                'icon' => 'heroicon-o-academic-cap',
                'order' => 3,
                'title' => [
                    'fr' => 'Compte Jeunes',
                    'de' => 'Jugendkonto',
                    'en' => 'Youth Account',
                    'es' => 'Cuenta Joven'
                ],
                'description' => [
                    'fr' => 'Le compte gratuit pour les jeunes de 12 à 25 ans. Apprenez à gérer votre argent dès maintenant.',
                    'de' => 'Das kostenlose Konto für Jugendliche von 12 bis 25 Jahren. Lernen Sie jetzt, Ihr Geld zu verwalten.',
                    'en' => 'Free account for young people aged 12 to 25. Learn to manage your money now.',
                    'es' => 'Cuenta gratuita para jóvenes de 12 a 25 años. Aprenda a gestionar su dinero ahora.'
                ],
                'content' => [
                    'fr' => '<h2>Votre premier compte bancaire</h2><p>Le compte jeunes Acrevis est conçu pour accompagner les jeunes dans leur apprentissage de la gestion financière. Totalement gratuit jusqu\'à 25 ans.</p><h3>Avantages exclusifs</h3><ul><li>Aucun frais de tenue de compte</li><li>Carte de débit gratuite</li><li>Application mobile intuitive</li><li>Cashback sur certains achats</li><li>Conseils financiers personnalisés</li></ul><h3>Éducation financière</h3><p>Accédez à notre plateforme d\'éducation financière avec des cours, vidéos et outils pour apprendre à budgétiser, épargner et investir.</p>',
                    'de' => '<h2>Ihr erstes Bankkonto</h2><p>Das Acrevis Jugendkonto wurde entwickelt, um junge Menschen beim Erlernen des Finanzmanagements zu begleiten. Völlig kostenlos bis 25 Jahre.</p><h3>Exklusive Vorteile</h3><ul><li>Keine Kontoführungsgebühren</li><li>Kostenlose Debitkarte</li><li>Intuitive Mobile-App</li><li>Cashback bei bestimmten Einkäufen</li><li>Persönliche Finanzberatung</li></ul><h3>Finanzbildung</h3><p>Zugang zu unserer Finanzbildungsplattform mit Kursen, Videos und Tools zum Budgetieren, Sparen und Investieren.</p>',
                    'en' => '<h2>Your first bank account</h2><p>The Acrevis youth account is designed to support young people in learning financial management. Completely free until age 25.</p><h3>Exclusive benefits</h3><ul><li>No account fees</li><li>Free debit card</li><li>Intuitive mobile app</li><li>Cashback on certain purchases</li><li>Personalized financial advice</li></ul><h3>Financial education</h3><p>Access our financial education platform with courses, videos and tools to learn budgeting, saving and investing.</p>',
                    'es' => '<h2>Su primera cuenta bancaria</h2><p>La cuenta joven Acrevis está diseñada para acompañar a los jóvenes en su aprendizaje de gestión financiera. Completamente gratuita hasta los 25 años.</p><h3>Ventajas exclusivas</h3><ul><li>Sin comisiones de mantenimiento</li><li>Tarjeta de débito gratuita</li><li>Aplicación móvil intuitiva</li><li>Cashback en ciertas compras</li><li>Asesoramiento financiero personalizado</li></ul><h3>Educación financiera</h3><p>Acceda a nuestra plataforma de educación financiera con cursos, videos y herramientas para aprender a presupuestar, ahorrar e invertir.</p>'
                ],
                'features' => [
                    'fr' => ['100% gratuit', 'Carte gratuite', 'Mobile Banking', 'Cashback', 'Formation financière'],
                    'de' => ['100% kostenlos', 'Gratis Karte', 'Mobile Banking', 'Cashback', 'Finanzschulung'],
                    'en' => ['100% free', 'Free card', 'Mobile Banking', 'Cashback', 'Financial training'],
                    'es' => ['100% gratis', 'Tarjeta gratis', 'Banca móvil', 'Cashback', 'Formación financiera']
                ],
                'benefits' => [
                    'fr' => ['Idéal pour débuter', 'Aucun engagement', 'Support dédié', 'Outils pédagogiques'],
                    'de' => ['Ideal zum Starten', 'Keine Verpflichtung', 'Dedizierter Support', 'Lernwerkzeuge'],
                    'en' => ['Ideal to start', 'No commitment', 'Dedicated support', 'Educational tools'],
                    'es' => ['Ideal para empezar', 'Sin compromiso', 'Soporte dedicado', 'Herramientas educativas']
                ],
            ],

            [
                'slug' => 'compte-salaire',
                'category' => 'Comptes & Cartes',
                'segment' => 'privat',
                'icon' => 'heroicon-o-briefcase',
                'order' => 4,
                'title' => [
                    'fr' => 'Compte Salaire',
                    'de' => 'Lohnkonto',
                    'en' => 'Salary Account',
                    'es' => 'Cuenta Salarial'
                ],
                'description' => [
                    'fr' => 'Compte optimisé pour recevoir votre salaire avec avantages exclusifs et frais réduits.',
                    'de' => 'Optimiertes Konto für Ihren Lohneingang mit exklusiven Vorteilen und reduzierten Gebühren.',
                    'en' => 'Account optimized for receiving your salary with exclusive benefits and reduced fees.',
                    'es' => 'Cuenta optimizada para recibir su salario con ventajas exclusivas y comisiones reducidas.'
                ],
                'content' => [
                    'fr' => '<h2>Le compte pour votre salaire</h2><p>Domiciliez votre salaire chez Acrevis et profitez d\'avantages exclusifs. Notre compte salaire est spécialement conçu pour optimiser la gestion de vos revenus mensuels.</p><h3>Conditions avantageuses</h3><ul><li>Gratuité totale avec domiciliation du salaire (minimum CHF 2\'000/mois)</li><li>Carte de crédit gratuite la première année</li><li>Réductions sur crédits et hypothèques</li><li>Overdraft préférentiel jusqu\'à CHF 5\'000</li></ul><h3>Services inclus</h3><p>E-banking premium, virements SEPA gratuits, assurance carte incluse, service client prioritaire.</p>',
                    'de' => '<h2>Das Konto für Ihr Gehalt</h2><p>Lassen Sie Ihr Gehalt bei Acrevis eingehen und profitieren Sie von exklusiven Vorteilen. Unser Lohnkonto ist speziell für die Optimierung Ihrer monatlichen Einkommensverwaltung konzipiert.</p><h3>Vorteilhafte Konditionen</h3><ul><li>Völlig kostenlos bei Lohneingang (mindestens CHF 2\'000/Monat)</li><li>Kreditkarte im ersten Jahr gratis</li><li>Rabatte auf Kredite und Hypotheken</li><li>Bevorzugter Überziehungskredit bis CHF 5\'000</li></ul><h3>Inkludierte Services</h3><p>Premium E-Banking, kostenlose SEPA-Überweisungen, Kartenversicherung inklusive, priorisierter Kundenservice.</p>',
                    'en' => '<h2>The account for your salary</h2><p>Domicile your salary with Acrevis and enjoy exclusive benefits. Our salary account is specially designed to optimize your monthly income management.</p><h3>Advantageous conditions</h3><ul><li>Completely free with salary domiciliation (minimum CHF 2,000/month)</li><li>Free credit card first year</li><li>Discounts on loans and mortgages</li><li>Preferential overdraft up to CHF 5,000</li></ul><h3>Included services</h3><p>Premium e-banking, free SEPA transfers, card insurance included, priority customer service.</p>',
                    'es' => '<h2>La cuenta para su salario</h2><p>Domicilie su salario en Acrevis y disfrute de ventajas exclusivas. Nuestra cuenta salarial está diseñada especialmente para optimizar la gestión de sus ingresos mensuales.</p><h3>Condiciones ventajosas</h3><ul><li>Totalmente gratuita con domiciliación de salario (mínimo CHF 2.000/mes)</li><li>Tarjeta de crédito gratis el primer año</li><li>Descuentos en créditos e hipotecas</li><li>Sobregiro preferencial hasta CHF 5.000</li></ul><h3>Servicios incluidos</h3><p>Banca electrónica premium, transferencias SEPA gratuitas, seguro de tarjeta incluido, servicio al cliente prioritario.</p>'
                ],
                'features' => [
                    'fr' => ['Gratuit avec salaire', 'Carte crédit offerte', 'Overdraft préférentiel', 'E-banking premium'],
                    'de' => ['Kostenlos mit Gehalt', 'Kreditkarte geschenkt', 'Bevorzugter Überziehungskredit', 'Premium E-Banking'],
                    'en' => ['Free with salary', 'Free credit card', 'Preferential overdraft', 'Premium e-banking'],
                    'es' => ['Gratis con salario', 'Tarjeta crédito gratis', 'Sobregiro preferencial', 'Banca electrónica premium']
                ],
                'benefits' => [
                    'fr' => ['Économies importantes', 'Services premium', 'Avantages cumulés', 'Flexibilité maximale'],
                    'de' => ['Erhebliche Einsparungen', 'Premium-Services', 'Kumulierte Vorteile', 'Maximale Flexibilität'],
                    'en' => ['Significant savings', 'Premium services', 'Cumulative benefits', 'Maximum flexibility'],
                    'es' => ['Ahorros importantes', 'Servicios premium', 'Ventajas acumuladas', 'Máxima flexibilidad']
                ],
            ],

            [
                'slug' => 'cartes-credit',
                'category' => 'Comptes & Cartes',
                'segment' => 'privat',
                'icon' => 'heroicon-o-credit-card',
                'order' => 5,
                'title' => [
                    'fr' => 'Cartes de Crédit',
                    'de' => 'Kreditkarten',
                    'en' => 'Credit Cards',
                    'es' => 'Tarjetas de Crédito'
                ],
                'description' => [
                    'fr' => 'Visa et Mastercard avec cashback, assurances voyages et programme de récompenses.',
                    'de' => 'Visa und Mastercard mit Cashback, Reiseversicherungen und Prämienprogramm.',
                    'en' => 'Visa and Mastercard with cashback, travel insurance and rewards program.',
                    'es' => 'Visa y Mastercard con cashback, seguros de viaje y programa de recompensas.'
                ],
                'content' => [
                    'fr' => '<h2>La carte qui vous accompagne</h2><p>Choisissez parmi notre gamme de cartes de crédit adaptées à votre style de vie. Profitez d\'avantages exclusifs et d\'une sécurité maximale pour tous vos paiements.</p><h3>Nos cartes</h3><ul><li><strong>Classic</strong>: CHF 50/an - Cashback 0.5%, assurances de base</li><li><strong>Gold</strong>: CHF 150/an - Cashback 1%, assurances voyages complètes, accès salons aéroport</li><li><strong>Platinum</strong>: CHF 350/an - Cashback 1.5%, conciergerie 24/7, assurances premium</li></ul><h3>Avantages communs</h3><p>Paiement sans contact, Apple Pay / Google Pay, protection des achats, assurance perte/vol, programme de fidélité.</p>',
                    'de' => '<h2>Die Karte, die Sie begleitet</h2><p>Wählen Sie aus unserem Sortiment an Kreditkarten, die zu Ihrem Lebensstil passen. Profitieren Sie von exklusiven Vorteilen und maximaler Sicherheit für alle Ihre Zahlungen.</p><h3>Unsere Karten</h3><ul><li><strong>Classic</strong>: CHF 50/Jahr - Cashback 0.5%, Basis-Versicherungen</li><li><strong>Gold</strong>: CHF 150/Jahr - Cashback 1%, umfassende Reiseversicherungen, Zugang zu Flughafen-Lounges</li><li><strong>Platinum</strong>: CHF 350/Jahr - Cashback 1.5%, Concierge 24/7, Premium-Versicherungen</li></ul><h3>Gemeinsame Vorteile</h3><p>Kontaktloses Bezahlen, Apple Pay / Google Pay, Käuferschutz, Verlust/Diebstahl-Versicherung, Treueprogramm.</p>',
                    'en' => '<h2>The card that accompanies you</h2><p>Choose from our range of credit cards adapted to your lifestyle. Enjoy exclusive benefits and maximum security for all your payments.</p><h3>Our cards</h3><ul><li><strong>Classic</strong>: CHF 50/year - 0.5% cashback, basic insurance</li><li><strong>Gold</strong>: CHF 150/year - 1% cashback, comprehensive travel insurance, airport lounge access</li><li><strong>Platinum</strong>: CHF 350/year - 1.5% cashback, 24/7 concierge, premium insurance</li></ul><h3>Common benefits</h3><p>Contactless payment, Apple Pay / Google Pay, purchase protection, loss/theft insurance, loyalty program.</p>',
                    'es' => '<h2>La tarjeta que le acompaña</h2><p>Elija entre nuestra gama de tarjetas de crédito adaptadas a su estilo de vida. Disfrute de ventajas exclusivas y máxima seguridad para todos sus pagos.</p><h3>Nuestras tarjetas</h3><ul><li><strong>Classic</strong>: CHF 50/año - Cashback 0.5%, seguros básicos</li><li><strong>Gold</strong>: CHF 150/año - Cashback 1%, seguros de viaje completos, acceso a salas VIP de aeropuerto</li><li><strong>Platinum</strong>: CHF 350/año - Cashback 1.5%, conserje 24/7, seguros premium</li></ul><h3>Ventajas comunes</h3><p>Pago sin contacto, Apple Pay / Google Pay, protección de compras, seguro pérdida/robo, programa de fidelidad.</p>'
                ],
                'features' => [
                    'fr' => ['3 niveaux', 'Cashback jusqu\'à 1.5%', 'Assurances incluses', 'Apple/Google Pay'],
                    'de' => ['3 Stufen', 'Cashback bis 1.5%', 'Versicherungen inklusive', 'Apple/Google Pay'],
                    'en' => ['3 levels', 'Up to 1.5% cashback', 'Insurance included', 'Apple/Google Pay'],
                    'es' => ['3 niveles', 'Cashback hasta 1.5%', 'Seguros incluidos', 'Apple/Google Pay']
                ],
                'benefits' => [
                    'fr' => ['Récompenses généreuses', 'Protection complète', 'Acceptée mondialement', 'Service prioritaire'],
                    'de' => ['Großzügige Prämien', 'Vollständiger Schutz', 'Weltweit akzeptiert', 'Priority Service'],
                    'en' => ['Generous rewards', 'Complete protection', 'Accepted worldwide', 'Priority service'],
                    'es' => ['Recompensas generosas', 'Protección completa', 'Aceptada mundialmente', 'Servicio prioritario']
                ],
            ],

            [
                'slug' => 'cartes-debit',
                'category' => 'Comptes & Cartes',
                'segment' => 'privat',
                'icon' => 'heroicon-o-banknotes',
                'order' => 6,
                'title' => [
                    'fr' => 'Cartes de Débit',
                    'de' => 'Debitkarten',
                    'en' => 'Debit Cards',
                    'es' => 'Tarjetas de Débito'
                ],
                'description' => [
                    'fr' => 'Maestro et Visa Debit pour vos paiements quotidiens en Suisse et à l\'étranger.',
                    'de' => 'Maestro und Visa Debit für Ihre täglichen Zahlungen in der Schweiz und im Ausland.',
                    'en' => 'Maestro and Visa Debit for your daily payments in Switzerland and abroad.',
                    'es' => 'Maestro y Visa Debit para sus pagos diarios en Suiza y en el extranjero.'
                ],
                'content' => [
                    'fr' => '<h2>Votre carte pour le quotidien</h2><p>Les cartes de débit Acrevis vous permettent d\'accéder à votre argent partout dans le monde. Sécurisées et pratiques, elles sont incluses gratuitement avec votre compte.</p><h3>Nos cartes de débit</h3><ul><li><strong>Maestro</strong>: Standard en Suisse, gratuite, retraits gratuits aux distributeurs Acrevis</li><li><strong>Visa Debit</strong>: Acceptée mondialement, gratuite avec compte salaire, idéale pour les voyages</li></ul><h3>Sécurité renforcée</h3><p>Technologie 3D Secure, notifications en temps réel, blocage/déblocage instantané via app, assurance achats incluse.</p><h3>Frais</h3><p>Retraits Suisse: gratuit aux distributeurs Acrevis, CHF 2.- autres banques. Retraits étranger: CHF 5.- + 1.5% du montant. Paiements: gratuits en Suisse et zone euro.</p>',
                    'de' => '<h2>Ihre Karte für den Alltag</h2><p>Die Acrevis Debitkarten ermöglichen Ihnen den Zugriff auf Ihr Geld überall auf der Welt. Sicher und praktisch, sind sie kostenlos in Ihrem Konto enthalten.</p><h3>Unsere Debitkarten</h3><ul><li><strong>Maestro</strong>: Standard in der Schweiz, kostenlos, kostenlose Abhebungen an Acrevis-Automaten</li><li><strong>Visa Debit</strong>: Weltweit akzeptiert, kostenlos mit Lohnkonto, ideal für Reisen</li></ul><h3>Erhöhte Sicherheit</h3><p>3D-Secure-Technologie, Echtzeit-Benachrichtigungen, sofortiges Sperren/Entsperren über App, Einkaufsversicherung inklusive.</p><h3>Gebühren</h3><p>Abhebungen Schweiz: kostenlos an Acrevis-Automaten, CHF 2.- andere Banken. Auslandsabhebungen: CHF 5.- + 1.5% des Betrags. Zahlungen: kostenlos in der Schweiz und Eurozone.</p>',
                    'en' => '<h2>Your everyday card</h2><p>Acrevis debit cards allow you to access your money anywhere in the world. Secure and practical, they are included free with your account.</p><h3>Our debit cards</h3><ul><li><strong>Maestro</strong>: Standard in Switzerland, free, free withdrawals at Acrevis ATMs</li><li><strong>Visa Debit</strong>: Accepted worldwide, free with salary account, ideal for travel</li></ul><h3>Enhanced security</h3><p>3D Secure technology, real-time notifications, instant block/unblock via app, purchase insurance included.</p><h3>Fees</h3><p>Swiss withdrawals: free at Acrevis ATMs, CHF 2.- other banks. Foreign withdrawals: CHF 5.- + 1.5% of amount. Payments: free in Switzerland and euro zone.</p>',
                    'es' => '<h2>Su tarjeta cotidiana</h2><p>Las tarjetas de débito Acrevis le permiten acceder a su dinero en cualquier lugar del mundo. Seguras y prácticas, están incluidas gratuitamente con su cuenta.</p><h3>Nuestras tarjetas de débito</h3><ul><li><strong>Maestro</strong>: Estándar en Suiza, gratuita, retiros gratuitos en cajeros Acrevis</li><li><strong>Visa Debit</strong>: Aceptada mundialmente, gratuita con cuenta salarial, ideal para viajes</li></ul><h3>Seguridad reforzada</h3><p>Tecnología 3D Secure, notificaciones en tiempo real, bloqueo/desbloqueo instantáneo vía app, seguro de compras incluido.</p><h3>Comisiones</h3><p>Retiros Suiza: gratis en cajeros Acrevis, CHF 2.- otros bancos. Retiros extranjero: CHF 5.- + 1.5% del monto. Pagos: gratis en Suiza y zona euro.</p>'
                ],
                'features' => [
                    'fr' => ['Gratuite', 'Paiement sans contact', 'Retraits mondiaux', 'App mobile'],
                    'de' => ['Kostenlos', 'Kontaktloses Bezahlen', 'Weltweite Abhebungen', 'Mobile App'],
                    'en' => ['Free', 'Contactless payment', 'Worldwide withdrawals', 'Mobile app'],
                    'es' => ['Gratis', 'Pago sin contacto', 'Retiros mundiales', 'App móvil']
                ],
                'benefits' => [
                    'fr' => ['Contrôle total', 'Sécurité maximale', 'Simplicité d\'usage', 'Support 24/7'],
                    'de' => ['Volle Kontrolle', 'Maximale Sicherheit', 'Einfache Bedienung', 'Support 24/7'],
                    'en' => ['Full control', 'Maximum security', 'Easy to use', '24/7 support'],
                    'es' => ['Control total', 'Máxima seguridad', 'Fácil de usar', 'Soporte 24/7']
                ],
            ],

            // CATÉGORIE 2: HYPOTHÈQUES & FINANCEMENTS
            [
                'slug' => 'hypotheque-fixe',
                'category' => 'Hypothèques & Financements',
                'segment' => 'privat',
                'icon' => 'heroicon-o-home',
                'order' => 10,
                'title' => [
                    'fr' => 'Hypothèque à Taux Fixe',
                    'de' => 'Festhypothek',
                    'en' => 'Fixed-Rate Mortgage',
                    'es' => 'Hipoteca a Tipo Fijo'
                ],
                'description' => [
                    'fr' => 'Sécurisez votre financement avec un taux fixe de 2 à 10 ans. Planifiez sereinement votre budget.',
                    'de' => 'Sichern Sie Ihre Finanzierung mit einem festen Zinssatz von 2 bis 10 Jahren. Planen Sie Ihr Budget sorgenfrei.',
                    'en' => 'Secure your financing with a fixed rate from 2 to 10 years. Plan your budget with peace of mind.',
                    'es' => 'Asegure su financiación con un tipo fijo de 2 a 10 años. Planifique su presupuesto con tranquilidad.'
                ],
                'content' => [
                    'fr' => '<h2>La sécurité d\'un taux fixe</h2><p>L\'hypothèque à taux fixe vous offre une planification financière optimale grâce à des mensualités constantes pendant toute la durée choisie.</p><h3>Nos taux actuels</h3><ul><li>2 ans: 1.45%</li><li>3 ans: 1.50%</li><li>5 ans: 1.65%</li><li>10 ans: 1.95%</li></ul><h3>Avantages</h3><p>Protection contre la hausse des taux, budgétisation simple, tranquillité d\'esprit. Montant minimum CHF 100\'000, taux indicatifs pour 80% de financement.</p>',
                    'de' => '<h2>Die Sicherheit eines festen Zinssatzes</h2><p>Die Festhypothek bietet Ihnen optimale Finanzplanung dank konstanten monatlichen Raten während der gesamten gewählten Laufzeit.</p><h3>Unsere aktuellen Zinssätze</h3><ul><li>2 Jahre: 1.45%</li><li>3 Jahre: 1.50%</li><li>5 Jahre: 1.65%</li><li>10 Jahre: 1.95%</li></ul><h3>Vorteile</h3><p>Schutz vor Zinserhöhungen, einfache Budgetierung, Seelenfrieden. Mindestbetrag CHF 100\'000, Richtzinsen für 80% Finanzierung.</p>',
                    'en' => '<h2>The security of a fixed rate</h2><p>The fixed-rate mortgage offers you optimal financial planning thanks to constant monthly payments throughout the chosen duration.</p><h3>Our current rates</h3><ul><li>2 years: 1.45%</li><li>3 years: 1.50%</li><li>5 years: 1.65%</li><li>10 years: 1.95%</li></ul><h3>Benefits</h3><p>Protection against rate increases, simple budgeting, peace of mind. Minimum amount CHF 100,000, indicative rates for 80% financing.</p>',
                    'es' => '<h2>La seguridad de un tipo fijo</h2><p>La hipoteca a tipo fijo le ofrece una planificación financiera óptima gracias a pagos mensuales constantes durante toda la duración elegida.</p><h3>Nuestros tipos actuales</h3><ul><li>2 años: 1.45%</li><li>3 años: 1.50%</li><li>5 años: 1.65%</li><li>10 años: 1.95%</li></ul><h3>Ventajas</h3><p>Protección contra aumentos de tipos, presupuesto simple, tranquilidad. Monto mínimo CHF 100.000, tipos indicativos para 80% de financiación.</p>'
                ],
                'features' => [
                    'fr' => ['Taux garanti', 'Durée 2-10 ans', 'Mensualités fixes', 'Remboursement anticipé possible'],
                    'de' => ['Garantierter Zinssatz', 'Laufzeit 2-10 Jahre', 'Feste Monatsraten', 'Vorzeitige Rückzahlung möglich'],
                    'en' => ['Guaranteed rate', '2-10 year term', 'Fixed monthly payments', 'Early repayment possible'],
                    'es' => ['Tipo garantizado', 'Plazo 2-10 años', 'Pagos mensuales fijos', 'Pago anticipado posible']
                ],
                'benefits' => [
                    'fr' => ['Budget prévisible', 'Protection contre hausse', 'Conseil personnalisé', 'Flexibilité de durée'],
                    'de' => ['Vorhersehbares Budget', 'Schutz vor Erhöhungen', 'Persönliche Beratung', 'Flexible Laufzeit'],
                    'en' => ['Predictable budget', 'Protection against increases', 'Personalized advice', 'Flexible duration'],
                    'es' => ['Presupuesto predecible', 'Protección contra aumentos', 'Asesoramiento personalizado', 'Duración flexible']
                ],
            ],

            [
                'slug' => 'hypotheque-variable',
                'category' => 'Hypothèques & Financements',
                'segment' => 'privat',
                'icon' => 'heroicon-o-chart-bar',
                'order' => 11,
                'title' => [
                    'fr' => 'Hypothèque à Taux Variable',
                    'de' => 'Variable Hypothek',
                    'en' => 'Variable Rate Mortgage',
                    'es' => 'Hipoteca a Tipo Variable'
                ],
                'description' => [
                    'fr' => 'Profitez d\'un taux attractif qui évolue avec le marché. Flexibilité maximale.',
                    'de' => 'Profitieren Sie von einem attraktiven Zinssatz, der sich mit dem Markt entwickelt. Maximale Flexibilität.',
                    'en' => 'Benefit from an attractive rate that evolves with the market. Maximum flexibility.',
                    'es' => 'Benefíciese de un tipo atractivo que evoluciona con el mercado. Máxima flexibilidad.'
                ],
                'content' => [
                    'fr' => '<h2>Flexibilité et opportunités</h2><p>L\'hypothèque à taux variable s\'adapte aux fluctuations du marché. Idéale si vous anticipez une baisse des taux ou souhaitez une grande flexibilité.</p><h3>Caractéristiques</h3><ul><li>Taux actuel: 1.25% (référence SARON + marge)</li><li>Révision trimestrielle du taux</li><li>Pas de durée minimale</li><li>Remboursement sans pénalité à tout moment</li><li>Conversion en taux fixe possible</li></ul><h3>Pour qui ?</h3><p>Idéal pour ceux qui veulent profiter de taux bas actuels avec possibilité de basculer vers du fixe plus tard. Requiert une certaine tolérance au risque.</p>',
                    'de' => '<h2>Flexibilität und Chancen</h2><p>Die variable Hypothek passt sich den Marktschwankungen an. Ideal, wenn Sie mit sinkenden Zinsen rechnen oder große Flexibilität wünschen.</p><h3>Merkmale</h3><ul><li>Aktueller Zinssatz: 1.25% (SARON-Referenz + Marge)</li><li>Vierteljährliche Zinsanpassung</li><li>Keine Mindestlaufzeit</li><li>Rückzahlung ohne Strafe jederzeit möglich</li><li>Umwandlung in Festzins möglich</li></ul><h3>Für wen?</h3><p>Ideal für diejenigen, die von aktuellen Niedrigzinsen profitieren möchten mit der Möglichkeit, später zu Festzins zu wechseln. Erfordert eine gewisse Risikotoleranz.</p>',
                    'en' => '<h2>Flexibility and opportunities</h2><p>The variable rate mortgage adapts to market fluctuations. Ideal if you anticipate rate decreases or want great flexibility.</p><h3>Features</h3><ul><li>Current rate: 1.25% (SARON reference + margin)</li><li>Quarterly rate revision</li><li>No minimum term</li><li>Repayment without penalty at any time</li><li>Conversion to fixed rate possible</li></ul><h3>For whom?</h3><p>Ideal for those who want to benefit from current low rates with the possibility of switching to fixed later. Requires some risk tolerance.</p>',
                    'es' => '<h2>Flexibilidad y oportunidades</h2><p>La hipoteca a tipo variable se adapta a las fluctuaciones del mercado. Ideal si anticipa una bajada de tipos o desea gran flexibilidad.</p><h3>Características</h3><ul><li>Tipo actual: 1.25% (referencia SARON + margen)</li><li>Revisión trimestral del tipo</li><li>Sin plazo mínimo</li><li>Reembolso sin penalización en cualquier momento</li><li>Conversión a tipo fijo posible</li></ul><h3>¿Para quién?</h3><p>Ideal para quienes quieren aprovechar los tipos bajos actuales con posibilidad de cambiar a fijo más tarde. Requiere cierta tolerancia al riesgo.</p>'
                ],
                'features' => [
                    'fr' => ['Taux actuel 1.25%', 'Aucune durée fixe', 'Remboursement libre', 'Conversion possible'],
                    'de' => ['Aktueller Zinssatz 1.25%', 'Keine feste Laufzeit', 'Freie Rückzahlung', 'Umwandlung möglich'],
                    'en' => ['Current rate 1.25%', 'No fixed term', 'Free repayment', 'Conversion possible'],
                    'es' => ['Tipo actual 1.25%', 'Sin plazo fijo', 'Reembolso libre', 'Conversión posible']
                ],
                'benefits' => [
                    'fr' => ['Taux attractif', 'Flexibilité totale', 'Sans engagement', 'Opportunités de marché'],
                    'de' => ['Attraktiver Zinssatz', 'Volle Flexibilität', 'Keine Bindung', 'Marktchancen'],
                    'en' => ['Attractive rate', 'Total flexibility', 'No commitment', 'Market opportunities'],
                    'es' => ['Tipo atractivo', 'Flexibilidad total', 'Sin compromiso', 'Oportunidades de mercado']
                ],
            ],

            [
                'slug' => 'hypotheque-construction',
                'category' => 'Hypothèques & Financements',
                'segment' => 'privat',
                'icon' => 'heroicon-o-wrench-screwdriver',
                'order' => 12,
                'title' => [
                    'fr' => 'Crédit de Construction',
                    'de' => 'Baukredit',
                    'en' => 'Construction Loan',
                    'es' => 'Crédito de Construcción'
                ],
                'description' => [
                    'fr' => 'Financez la construction de votre maison. Versements progressifs adaptés à l\'avancement des travaux.',
                    'de' => 'Finanzieren Sie den Bau Ihres Hauses. Progressive Auszahlungen angepasst an den Baufortschritt.',
                    'en' => 'Finance your home construction. Progressive payments adapted to construction progress.',
                    'es' => 'Financie la construcción de su casa. Pagos progresivos adaptados al avance de las obras.'
                ],
                'content' => [
                    'fr' => '<h2>Construisez votre rêve</h2><p>Le crédit de construction Acrevis vous accompagne dans la réalisation de votre projet immobilier. Nous versons les fonds au fur et à mesure de l\'avancement des travaux.</p><h3>Comment ça marche</h3><ul><li>Financement jusqu\'à 80% du coût total</li><li>Versements par tranches selon avancement</li><li>Intérêts calculés uniquement sur montant versé</li><li>Passage automatique en hypothèque à la fin des travaux</li></ul><h3>Avantages</h3><p>Vous ne payez des intérêts que sur les montants déjà versés. Notre équipe d\'experts surveille l\'avancement et valide chaque tranche de paiement.</p>',
                    'de' => '<h2>Bauen Sie Ihren Traum</h2><p>Der Acrevis Baukredit begleitet Sie bei der Realisierung Ihres Immobilienprojekts. Wir zahlen die Mittel schrittweise entsprechend dem Baufortschritt aus.</p><h3>Wie funktioniert es</h3><ul><li>Finanzierung bis 80% der Gesamtkosten</li><li>Ratenzahlungen nach Fortschritt</li><li>Zinsen nur auf ausgezahlten Betrag</li><li>Automatischer Übergang zur Hypothek nach Bauende</li></ul><h3>Vorteile</h3><p>Sie zahlen nur Zinsen auf bereits ausgezahlte Beträge. Unser Expertenteam überwacht den Fortschritt und validiert jede Zahlungstranche.</p>',
                    'en' => '<h2>Build your dream</h2><p>The Acrevis construction loan accompanies you in realizing your real estate project. We disburse funds progressively according to construction progress.</p><h3>How it works</h3><ul><li>Financing up to 80% of total cost</li><li>Tranched payments according to progress</li><li>Interest calculated only on disbursed amount</li><li>Automatic conversion to mortgage at project completion</li></ul><h3>Benefits</h3><p>You only pay interest on amounts already disbursed. Our expert team monitors progress and validates each payment tranche.</p>',
                    'es' => '<h2>Construya su sueño</h2><p>El crédito de construcción Acrevis le acompaña en la realización de su proyecto inmobiliario. Desembolsamos fondos progresivamente según el avance de la construcción.</p><h3>Cómo funciona</h3><ul><li>Financiación hasta 80% del costo total</li><li>Pagos por tramos según avance</li><li>Interés calculado solo sobre monto desembolsado</li><li>Conversión automática a hipoteca al finalizar obras</li></ul><h3>Ventajas</h3><p>Solo paga intereses sobre montos ya desembolsados. Nuestro equipo experto supervisa el avance y valida cada tramo de pago.</p>'
                ],
                'features' => [
                    'fr' => ['Jusqu\'à 80%', 'Versements progressifs', 'Intérêts sur versé uniquement', 'Suivi expert'],
                    'de' => ['Bis 80%', 'Progressive Auszahlungen', 'Zinsen nur auf Ausgezahltes', 'Expertenüberwachung'],
                    'en' => ['Up to 80%', 'Progressive disbursements', 'Interest on disbursed only', 'Expert monitoring'],
                    'es' => ['Hasta 80%', 'Desembolsos progresivos', 'Interés solo sobre desembolsado', 'Supervisión experta']
                ],
                'benefits' => [
                    'fr' => ['Optimisation des coûts', 'Sécurité du projet', 'Expertise construction', 'Transition fluide'],
                    'de' => ['Kostenoptimierung', 'Projektsicherheit', 'Bau-Expertise', 'Fließender Übergang'],
                    'en' => ['Cost optimization', 'Project security', 'Construction expertise', 'Smooth transition'],
                    'es' => ['Optimización de costos', 'Seguridad del proyecto', 'Experiencia en construcción', 'Transición fluida']
                ],
            ],

            [
                'slug' => 'hypotheque-residence-secondaire',
                'category' => 'Hypothèques & Financements',
                'segment' => 'privat',
                'icon' => 'heroicon-o-home-modern',
                'order' => 13,
                'title' => [
                    'fr' => 'Hypothèque Résidence Secondaire',
                    'de' => 'Ferienwohnung Hypothek',
                    'en' => 'Second Home Mortgage',
                    'es' => 'Hipoteca Residencia Secundaria'
                ],
                'description' => [
                    'fr' => 'Financez votre appartement de vacances ou votre chalet de montagne. Conditions adaptées.',
                    'de' => 'Finanzieren Sie Ihre Ferienwohnung oder Ihr Bergchalet. Angepasste Konditionen.',
                    'en' => 'Finance your vacation apartment or mountain chalet. Adapted conditions.',
                    'es' => 'Financie su apartamento de vacaciones o chalet de montaña. Condiciones adaptadas.'
                ],
                'content' => [
                    'fr' => '<h2>Votre résidence de rêve</h2><p>Réalisez votre projet de résidence secondaire avec notre financement adapté. Que ce soit pour un chalet en montagne, un appartement au bord du lac ou une maison de campagne.</p><h3>Conditions</h3><ul><li>Financement jusqu\'à 60% de la valeur</li><li>Taux légèrement supérieurs à résidence principale</li><li>Possibilité de location saisonnière</li><li>Expertise immobilière gratuite</li></ul><h3>Fiscalité</h3><p>Nous vous conseillons sur les aspects fiscaux de votre résidence secondaire et les possibilités de déduction des intérêts hypothécaires.</p>',
                    'de' => '<h2>Ihre Traumresidenz</h2><p>Verwirklichen Sie Ihr Zweitwohnsitzprojekt mit unserer angepassten Finanzierung. Ob Bergchalet, Seewohnung oder Landhaus.</p><h3>Konditionen</h3><ul><li>Finanzierung bis 60% des Werts</li><li>Zinsen leicht über Hauptwohnsitz</li><li>Möglichkeit saisonaler Vermietung</li><li>Kostenlose Immobilienbewertung</li></ul><h3>Steueraspekte</h3><p>Wir beraten Sie zu steuerlichen Aspekten Ihres Zweitwohnsitzes und Möglichkeiten zum Abzug von Hypothekarzinsen.</p>',
                    'en' => '<h2>Your dream residence</h2><p>Realize your second home project with our adapted financing. Whether for a mountain chalet, lakeside apartment or country house.</p><h3>Conditions</h3><ul><li>Financing up to 60% of value</li><li>Rates slightly above primary residence</li><li>Seasonal rental possibility</li><li>Free property valuation</li></ul><h3>Tax aspects</h3><p>We advise you on tax aspects of your second home and possibilities for mortgage interest deduction.</p>',
                    'es' => '<h2>Su residencia de ensueño</h2><p>Realice su proyecto de residencia secundaria con nuestra financiación adaptada. Ya sea chalet de montaña, apartamento junto al lago o casa de campo.</p><h3>Condiciones</h3><ul><li>Financiación hasta 60% del valor</li><li>Tipos ligeramente superiores a residencia principal</li><li>Posibilidad de alquiler estacional</li><li>Valoración inmobiliaria gratuita</li></ul><h3>Aspectos fiscales</h3><p>Le asesoramos sobre aspectos fiscales de su residencia secundaria y posibilidades de deducción de intereses hipotecarios.</p>'
                ],
                'features' => [
                    'fr' => ['Jusqu\'à 60%', 'Location possible', 'Conseil fiscal', 'Expertise gratuite'],
                    'de' => ['Bis 60%', 'Vermietung möglich', 'Steuerberatung', 'Gratis Expertise'],
                    'en' => ['Up to 60%', 'Rental possible', 'Tax advice', 'Free valuation'],
                    'es' => ['Hasta 60%', 'Alquiler posible', 'Asesoría fiscal', 'Valoración gratis']
                ],
                'benefits' => [
                    'fr' => ['Réalisation de rêves', 'Investissement durable', 'Revenus locatifs', 'Patrimoine familial'],
                    'de' => ['Traumverwirklichung', 'Nachhaltige Investition', 'Mieteinnahmen', 'Familienvermögen'],
                    'en' => ['Dream realization', 'Sustainable investment', 'Rental income', 'Family assets'],
                    'es' => ['Realización de sueños', 'Inversión sostenible', 'Ingresos por alquiler', 'Patrimonio familiar']
                ],
            ],

            [
                'slug' => 'credit-prive',
                'category' => 'Hypothèques & Financements',
                'segment' => 'privat',
                'icon' => 'heroicon-o-banknotes',
                'order' => 14,
                'title' => [
                    'fr' => 'Crédit Privé',
                    'de' => 'Privatkredit',
                    'en' => 'Personal Loan',
                    'es' => 'Crédito Personal'
                ],
                'description' => [
                    'fr' => 'Crédit personnel rapide de CHF 5\'000 à 100\'000. Réponse en 24h, utilisable librement.',
                    'de' => 'Schneller Privatkredit von CHF 5\'000 bis 100\'000. Antwort in 24 Std., frei verwendbar.',
                    'en' => 'Fast personal loan from CHF 5,000 to 100,000. Answer within 24h, freely usable.',
                    'es' => 'Crédito personal rápido de CHF 5.000 a 100.000. Respuesta en 24h, uso libre.'
                ],
                'content' => [
                    'fr' => '<h2>Votre projet, notre financement</h2><p>Le crédit privé Acrevis vous permet de financer tous vos projets personnels : rénovation, mariage, études, voyage, véhicule, etc. Procédure simple et décision rapide.</p><h3>Conditions</h3><ul><li>Montant: CHF 5\'000 à 100\'000</li><li>Durée: 12 à 84 mois</li><li>Taux: à partir de 4.9% (selon profil)</li><li>Remboursement anticipé sans frais</li><li>Pas de garantie nécessaire</li></ul><h3>Procédure</h3><p>Demande en ligne en 5 minutes. Décision de principe sous 24h. Versement sous 48h après acceptation complète.</p>',
                    'de' => '<h2>Ihr Projekt, unsere Finanzierung</h2><p>Der Acrevis Privatkredit ermöglicht es Ihnen, alle Ihre persönlichen Projekte zu finanzieren: Renovation, Hochzeit, Studium, Reise, Fahrzeug usw. Einfaches Verfahren und schnelle Entscheidung.</p><h3>Konditionen</h3><ul><li>Betrag: CHF 5\'000 bis 100\'000</li><li>Laufzeit: 12 bis 84 Monate</li><li>Zinssatz: ab 4.9% (je nach Profil)</li><li>Vorzeitige Rückzahlung ohne Gebühren</li><li>Keine Sicherheit erforderlich</li></ul><h3>Verfahren</h3><p>Online-Antrag in 5 Minuten. Grundsatzentscheid innerhalb 24 Std. Auszahlung innerhalb 48 Std. nach vollständiger Annahme.</p>',
                    'en' => '<h2>Your project, our financing</h2><p>The Acrevis personal loan allows you to finance all your personal projects: renovation, wedding, studies, travel, vehicle, etc. Simple procedure and quick decision.</p><h3>Conditions</h3><ul><li>Amount: CHF 5,000 to 100,000</li><li>Duration: 12 to 84 months</li><li>Rate: from 4.9% (depending on profile)</li><li>Early repayment without fees</li><li>No collateral required</li></ul><h3>Procedure</h3><p>Online application in 5 minutes. Decision in principle within 24h. Payment within 48h after complete acceptance.</p>',
                    'es' => '<h2>Su proyecto, nuestra financiación</h2><p>El crédito personal Acrevis le permite financiar todos sus proyectos personales: renovación, boda, estudios, viaje, vehículo, etc. Procedimiento simple y decisión rápida.</p><h3>Condiciones</h3><ul><li>Monto: CHF 5.000 a 100.000</li><li>Duración: 12 a 84 meses</li><li>Tipo: desde 4.9% (según perfil)</li><li>Reembolso anticipado sin comisiones</li><li>Sin garantía necesaria</li></ul><h3>Procedimiento</h3><p>Solicitud online en 5 minutos. Decisión de principio en 24h. Desembolso en 48h tras aceptación completa.</p>'
                ],
                'features' => [
                    'fr' => ['CHF 5K-100K', 'Réponse 24h', 'Sans garantie', 'Utilisation libre'],
                    'de' => ['CHF 5K-100K', 'Antwort 24 Std.', 'Ohne Sicherheit', 'Freie Verwendung'],
                    'en' => ['CHF 5K-100K', '24h response', 'No collateral', 'Free use'],
                    'es' => ['CHF 5K-100K', 'Respuesta 24h', 'Sin garantía', 'Uso libre']
                ],
                'benefits' => [
                    'fr' => ['Processus rapide', 'Taux compétitifs', 'Flexibilité totale', 'Simplicité'],
                    'de' => ['Schneller Prozess', 'Wettbewerbsfähige Zinsen', 'Volle Flexibilität', 'Einfachheit'],
                    'en' => ['Fast process', 'Competitive rates', 'Total flexibility', 'Simplicity'],
                    'es' => ['Proceso rápido', 'Tipos competitivos', 'Flexibilidad total', 'Simplicidad']
                ],
            ],

            [
                'slug' => 'credit-lombard',
                'category' => 'Hypothèques & Financements',
                'segment' => 'privat',
                'icon' => 'heroicon-o-scale',
                'order' => 15,
                'title' => [
                    'fr' => 'Crédit Lombard',
                    'de' => 'Lombardkredit',
                    'en' => 'Lombard Loan',
                    'es' => 'Crédito Lombardo'
                ],
                'description' => [
                    'fr' => 'Crédit garanti par vos titres et placements. Taux avantageux, portefeuille reste investi.',
                    'de' => 'Kredit gesichert durch Ihre Wertpapiere. Vorteilhafte Zinsen, Portfolio bleibt investiert.',
                    'en' => 'Loan secured by your securities. Advantageous rates, portfolio remains invested.',
                    'es' => 'Crédito garantizado por sus valores. Tipos ventajosos, cartera permanece invertida.'
                ],
                'content' => [
                    'fr' => '<h2>La liquidité sans vendre</h2><p>Le crédit lombard vous permet d\'obtenir rapidement des liquidités en utilisant vos titres comme garantie, sans avoir à les vendre. Votre portefeuille continue de générer des rendements.</p><h3>Fonctionnement</h3><ul><li>Prêt jusqu\'à 70% de la valeur de vos titres</li><li>Taux à partir de 2.5%</li><li>Pas de durée fixe</li><li>Remboursement flexible</li><li>Vos titres restent en dépôt et continuent de produire</li></ul><h3>Avantages</h3><p>Conservez votre stratégie d\'investissement, profitez de taux bas, accédez rapidement aux fonds, optimisez votre fiscalité.</p>',
                    'de' => '<h2>Liquidität ohne Verkauf</h2><p>Der Lombardkredit ermöglicht es Ihnen, schnell Liquidität zu erhalten, indem Sie Ihre Wertpapiere als Sicherheit verwenden, ohne sie verkaufen zu müssen. Ihr Portfolio generiert weiterhin Renditen.</p><h3>Funktionsweise</h3><ul><li>Kredit bis 70% des Werts Ihrer Wertpapiere</li><li>Zinssatz ab 2.5%</li><li>Keine feste Laufzeit</li><li>Flexible Rückzahlung</li><li>Ihre Wertpapiere bleiben deponiert und produzieren weiter</li></ul><h3>Vorteile</h3><p>Behalten Sie Ihre Anlagestrategie bei, profitieren Sie von niedrigen Zinsen, erhalten Sie schnell Zugang zu Mitteln, optimieren Sie Ihre Steuern.</p>',
                    'en' => '<h2>Liquidity without selling</h2><p>The lombard loan allows you to quickly obtain liquidity using your securities as collateral, without having to sell them. Your portfolio continues to generate returns.</p><h3>How it works</h3><ul><li>Loan up to 70% of your securities value</li><li>Rate from 2.5%</li><li>No fixed term</li><li>Flexible repayment</li><li>Your securities remain deposited and continue producing</li></ul><h3>Benefits</h3><p>Maintain your investment strategy, benefit from low rates, access funds quickly, optimize your taxes.</p>',
                    'es' => '<h2>Liquidez sin vender</h2><p>El crédito lombardo le permite obtener liquidez rápidamente utilizando sus valores como garantía, sin tener que venderlos. Su cartera continúa generando rendimientos.</p><h3>Funcionamiento</h3><ul><li>Préstamo hasta 70% del valor de sus valores</li><li>Tipo desde 2.5%</li><li>Sin plazo fijo</li><li>Reembolso flexible</li><li>Sus valores permanecen depositados y continúan produciendo</li></ul><h3>Ventajas</h3><p>Conserve su estrategia de inversión, benefíciese de tipos bajos, acceda rápidamente a fondos, optimice sus impuestos.</p>'
                ],
                'features' => [
                    'fr' => ['Jusqu\'à 70%', 'Taux dès 2.5%', 'Titres restent investis', 'Accès rapide'],
                    'de' => ['Bis 70%', 'Zinssatz ab 2.5%', 'Wertpapiere bleiben investiert', 'Schneller Zugang'],
                    'en' => ['Up to 70%', 'Rate from 2.5%', 'Securities stay invested', 'Quick access'],
                    'es' => ['Hasta 70%', 'Tipo desde 2.5%', 'Valores permanecen invertidos', 'Acceso rápido']
                ],
                'benefits' => [
                    'fr' => ['Pas de vente forcée', 'Taux préférentiels', 'Optimisation fiscale', 'Flexibilité maximale'],
                    'de' => ['Kein Zwangsverkauf', 'Vorzugszinsen', 'Steueroptimierung', 'Maximale Flexibilität'],
                    'en' => ['No forced sale', 'Preferential rates', 'Tax optimization', 'Maximum flexibility'],
                    'es' => ['Sin venta forzada', 'Tipos preferenciales', 'Optimización fiscal', 'Máxima flexibilidad']
                ],
            ],

            [
                'slug' => 'leasing-auto',
                'category' => 'Hypothèques & Financements',
                'segment' => 'privat',
                'icon' => 'heroicon-o-truck',
                'order' => 16,
                'title' => [
                    'fr' => 'Leasing Automobile',
                    'de' => 'Auto-Leasing',
                    'en' => 'Car Leasing',
                    'es' => 'Leasing de Automóviles'
                ],
                'description' => [
                    'fr' => 'Financez votre véhicule avec flexibilité. Mensualités fixes, entretien inclus en option.',
                    'de' => 'Finanzieren Sie Ihr Fahrzeug flexibel. Feste Monatsraten, Wartung optional inklusive.',
                    'en' => 'Finance your vehicle flexibly. Fixed monthly payments, maintenance optionally included.',
                    'es' => 'Financie su vehículo con flexibilidad. Cuotas fijas, mantenimiento incluido opcional.'
                ],
                'content' => [
                    'fr' => '<h2>Conduisez votre rêve</h2><p>Le leasing automobile Acrevis vous permet de rouler dans le véhicule de vos rêves avec des mensualités adaptées à votre budget. Neuf ou occasion, tous types de véhicules.</p><h3>Nos formules</h3><ul><li><strong>Leasing Opérationnel</strong>: Entretien et assurance inclus, idéal pour usage professionnel</li><li><strong>Leasing Financier</strong>: Mensualités réduites, véhicule devient vôtre en fin de contrat</li><li><strong>Leasing Flexible</strong>: Modulez vos mensualités selon vos besoins</li></ul><h3>Conditions</h3><p>Durée 24-60 mois, apport à partir de 10%, kilométrage adapté à vos besoins, rachat ou restitution en fin de contrat.</p>',
                    'de' => '<h2>Fahren Sie Ihren Traum</h2><p>Das Acrevis Auto-Leasing ermöglicht es Ihnen, das Fahrzeug Ihrer Träume mit an Ihr Budget angepassten Monatsraten zu fahren. Neu oder gebraucht, alle Fahrzeugtypen.</p><h3>Unsere Formeln</h3><ul><li><strong>Operating-Leasing</strong>: Wartung und Versicherung inklusive, ideal für gewerbliche Nutzung</li><li><strong>Finanz-Leasing</strong>: Reduzierte Monatsraten, Fahrzeug wird am Ende Ihres</li><li><strong>Flexibles Leasing</strong>: Modulieren Sie Ihre Monatsraten nach Ihren Bedürfnissen</li></ul><h3>Konditionen</h3><p>Laufzeit 24-60 Monate, Anzahlung ab 10%, Kilometerleistung angepasst an Ihre Bedürfnisse, Kauf oder Rückgabe am Vertragsende.</p>',
                    'en' => '<h2>Drive your dream</h2><p>Acrevis car leasing allows you to drive your dream vehicle with monthly payments adapted to your budget. New or used, all vehicle types.</p><h3>Our formulas</h3><ul><li><strong>Operating Lease</strong>: Maintenance and insurance included, ideal for professional use</li><li><strong>Financial Lease</strong>: Reduced monthly payments, vehicle becomes yours at contract end</li><li><strong>Flexible Lease</strong>: Modulate your monthly payments according to your needs</li></ul><h3>Conditions</h3><p>Duration 24-60 months, down payment from 10%, mileage adapted to your needs, purchase or return at contract end.</p>',
                    'es' => '<h2>Conduzca su sueño</h2><p>El leasing de automóviles Acrevis le permite conducir el vehículo de sus sueños con cuotas mensuales adaptadas a su presupuesto. Nuevo o usado, todos los tipos de vehículos.</p><h3>Nuestras fórmulas</h3><ul><li><strong>Leasing Operativo</strong>: Mantenimiento y seguro incluidos, ideal para uso profesional</li><li><strong>Leasing Financiero</strong>: Cuotas reducidas, vehículo se convierte en suyo al final del contrato</li><li><strong>Leasing Flexible</strong>: Module sus cuotas según sus necesidades</li></ul><h3>Condiciones</h3><p>Duración 24-60 meses, entrada desde 10%, kilometraje adaptado a sus necesidades, compra o devolución al final del contrato.</p>'
                ],
                'features' => [
                    'fr' => ['Toutes marques', 'Entretien possible', 'Mensualités fixes', 'Option d\'achat'],
                    'de' => ['Alle Marken', 'Wartung möglich', 'Feste Monatsraten', 'Kaufoption'],
                    'en' => ['All brands', 'Maintenance option', 'Fixed monthly payments', 'Purchase option'],
                    'es' => ['Todas las marcas', 'Mantenimiento posible', 'Cuotas fijas', 'Opción de compra']
                ],
                'benefits' => [
                    'fr' => ['Budget maîtrisé', 'Pas d\'immobilisation', 'Déductions fiscales', 'Service complet'],
                    'de' => ['Kontrolliertes Budget', 'Keine Kapitalbindung', 'Steuerabzüge', 'Komplettservice'],
                    'en' => ['Controlled budget', 'No capital tie-up', 'Tax deductions', 'Complete service'],
                    'es' => ['Presupuesto controlado', 'Sin inmovilización', 'Deducciones fiscales', 'Servicio completo']
                ],
            ],

            [
                'slug' => 'restructuration-dettes',
                'category' => 'Hypothèques & Financements',
                'segment' => 'privat',
                'icon' => 'heroicon-o-arrow-path',
                'order' => 17,
                'title' => [
                    'fr' => 'Restructuration de Dettes',
                    'de' => 'Schuldenkonsolidierung',
                    'en' => 'Debt Consolidation',
                    'es' => 'Reestructuración de Deudas'
                ],
                'description' => [
                    'fr' => 'Regroupez vos crédits en un seul. Réduisez vos mensualités et simplifiez votre gestion.',
                    'de' => 'Fassen Sie Ihre Kredite zusammen. Reduzieren Sie Ihre Monatsraten und vereinfachen Sie Ihre Verwaltung.',
                    'en' => 'Consolidate your loans into one. Reduce your monthly payments and simplify management.',
                    'es' => 'Agrupe sus créditos en uno solo. Reduzca sus cuotas y simplifique su gestión.'
                ],
                'content' => [
                    'fr' => '<h2>Reprenez le contrôle</h2><p>La restructuration de dettes vous permet de regrouper tous vos crédits en cours en un seul prêt avec une mensualité unique, souvent réduite. Simplifiez votre vie financière.</p><h3>Comment ça marche</h3><ul><li>Analyse complète de votre situation</li><li>Rachat de tous vos crédits existants</li><li>Une seule mensualité réduite</li><li>Durée adaptée à votre capacité</li><li>Taux souvent plus avantageux</li></ul><h3>Avantages</h3><p>Mensualités réduites jusqu\'à 60%, une seule échéance à gérer, taux global optimisé, amélioration de votre trésorerie.</p>',
                    'de' => '<h2>Übernehmen Sie die Kontrolle</h2><p>Die Schuldenkonsolidierung ermöglicht es Ihnen, alle Ihre laufenden Kredite in einem einzigen Darlehen mit einer einzigen, oft reduzierten Monatsrate zusammenzufassen. Vereinfachen Sie Ihr finanzielles Leben.</p><h3>Wie funktioniert es</h3><ul><li>Vollständige Analyse Ihrer Situation</li><li>Ablösung aller Ihrer bestehenden Kredite</li><li>Eine einzige reduzierte Monatsrate</li><li>Laufzeit angepasst an Ihre Kapazität</li><li>Oft vorteilhafterer Zinssatz</li></ul><h3>Vorteile</h3><p>Monatsraten um bis zu 60% reduziert, nur ein Fälligkeitstermin zu verwalten, optimierter Gesamtzins, Verbesserung Ihrer Liquidität.</p>',
                    'en' => '<h2>Take back control</h2><p>Debt consolidation allows you to combine all your current loans into a single loan with one monthly payment, often reduced. Simplify your financial life.</p><h3>How it works</h3><ul><li>Complete analysis of your situation</li><li>Buyout of all your existing loans</li><li>Single reduced monthly payment</li><li>Duration adapted to your capacity</li><li>Often more advantageous rate</li></ul><h3>Benefits</h3><p>Monthly payments reduced up to 60%, single due date to manage, optimized overall rate, improved cash flow.</p>',
                    'es' => '<h2>Retome el control</h2><p>La reestructuración de deudas le permite agrupar todos sus créditos actuales en un solo préstamo con una cuota mensual única, a menudo reducida. Simplifique su vida financiera.</p><h3>Cómo funciona</h3><ul><li>Análisis completo de su situación</li><li>Compra de todos sus créditos existentes</li><li>Una sola cuota reducida</li><li>Duración adaptada a su capacidad</li><li>Tipo a menudo más ventajoso</li></ul><h3>Ventajas</h3><p>Cuotas reducidas hasta 60%, una sola fecha de vencimiento a gestionar, tipo global optimizado, mejora de su tesorería.</p>'
                ],
                'features' => [
                    'fr' => ['Une seule mensualité', 'Réduction jusqu\'à 60%', 'Analyse gratuite', 'Solution sur mesure'],
                    'de' => ['Eine Monatsrate', 'Reduzierung bis 60%', 'Kostenlose Analyse', 'Maßgeschneiderte Lösung'],
                    'en' => ['Single monthly payment', 'Up to 60% reduction', 'Free analysis', 'Tailored solution'],
                    'es' => ['Una sola cuota', 'Reducción hasta 60%', 'Análisis gratis', 'Solución a medida']
                ],
                'benefits' => [
                    'fr' => ['Simplification totale', 'Budget allégé', 'Sérénité retrouvée', 'Conseil personnalisé'],
                    'de' => ['Totale Vereinfachung', 'Entlastetes Budget', 'Wiedergefundene Gelassenheit', 'Persönliche Beratung'],
                    'en' => ['Total simplification', 'Lighter budget', 'Peace of mind restored', 'Personalized advice'],
                    'es' => ['Simplificación total', 'Presupuesto aliviado', 'Serenidad recuperada', 'Asesoramiento personalizado']
                ],
            ],

            // CATÉGORIE 3: PLACEMENTS & ÉPARGNE
            [
                'slug' => 'compte-placement',
                'category' => 'Placements & Épargne',
                'segment' => 'privat',
                'icon' => 'heroicon-o-chart-pie',
                'order' => 20,
                'title' => [
                    'fr' => 'Compte de Placement',
                    'de' => 'Anlagekonto',
                    'en' => 'Investment Account',
                    'es' => 'Cuenta de Inversión'
                ],
                'description' => [
                    'fr' => 'Investissez dans les marchés financiers. Gestion personnalisée, accès aux principales bourses mondiales.',
                    'de' => 'Investieren Sie in die Finanzmärkte. Personalisierte Verwaltung, Zugang zu den wichtigsten Weltbörsen.',
                    'en' => 'Invest in financial markets. Personalized management, access to major global exchanges.',
                    'es' => 'Invierta en los mercados financieros. Gestión personalizada, acceso a las principales bolsas mundiales.'
                ],
                'content' => [
                    'fr' => '<h2>Faites fructifier votre capital</h2><p>Le compte de placement Acrevis vous donne accès aux marchés financiers internationaux avec un accompagnement professionnel.</p><h3>Univers d\'investissement</h3><ul><li>Actions suisses et internationales</li><li>Obligations et produits de taux</li><li>Fonds de placement et ETFs</li><li>Produits structurés</li><li>Devises</li></ul><h3>Services inclus</h3><p>Conseil en placement, accès e-trading, rapports trimestriels détaillés, optimisation fiscale, accès aux IPO et émissions</p>',
                    'de' => '<h2>Lassen Sie Ihr Kapital wachsen</h2><p>Das Acrevis Anlagekonto gibt Ihnen Zugang zu internationalen Finanzmärkten mit professioneller Begleitung.</p><h3>Anlageuniversum</h3><ul><li>Schweizer und internationale Aktien</li><li>Anleihen und Zinsprodukte</li><li>Anlagefonds und ETFs</li><li>Strukturierte Produkte</li><li>Devisen</li></ul><h3>Inkludierte Services</h3><p>Anlageberatung, E-Trading-Zugang, detaillierte Quartalsberichte, Steueroptimierung, Zugang zu IPOs und Emissionen</p>',
                    'en' => '<h2>Grow your capital</h2><p>The Acrevis investment account gives you access to international financial markets with professional support.</p><h3>Investment universe</h3><ul><li>Swiss and international equities</li><li>Bonds and fixed income products</li><li>Investment funds and ETFs</li><li>Structured products</li><li>Currencies</li></ul><h3>Included services</h3><p>Investment advice, e-trading access, detailed quarterly reports, tax optimization, access to IPOs and issues</p>',
                    'es' => '<h2>Haga crecer su capital</h2><p>La cuenta de inversión Acrevis le da acceso a los mercados financieros internacionales con soporte profesional.</p><h3>Universo de inversión</h3><ul><li>Acciones suizas e internacionales</li><li>Bonos y productos de renta fija</li><li>Fondos de inversión y ETFs</li><li>Productos estructurados</li><li>Divisas</li></ul><h3>Servicios incluidos</h3><p>Asesoramiento de inversión, acceso al e-trading, informes trimestrales detallados, optimización fiscal, acceso a OPVs y emisiones</p>'
                ],
                'features' => [
                    'fr' => ['E-trading 24/7', 'Conseil personnalisé', 'Tous marchés', 'Rapports détaillés'],
                    'de' => ['E-Trading 24/7', 'Persönliche Beratung', 'Alle Märkte', 'Detaillierte Berichte'],
                    'en' => ['E-trading 24/7', 'Personalized advice', 'All markets', 'Detailed reports'],
                    'es' => ['E-trading 24/7', 'Asesoramiento personalizado', 'Todos los mercados', 'Informes detallados']
                ],
                'benefits' => [
                    'fr' => ['Diversification', 'Rendements attractifs', 'Expertise professionnelle', 'Fiscalité optimisée'],
                    'de' => ['Diversifikation', 'Attraktive Renditen', 'Professionelles Know-how', 'Optimierte Besteuerung'],
                    'en' => ['Diversification', 'Attractive returns', 'Professional expertise', 'Optimized taxation'],
                    'es' => ['Diversificación', 'Rendimientos atractivos', 'Experiencia profesional', 'Fiscalidad optimizada']
                ],
            ],

            [
                'slug' => 'fonds-placement',
                'category' => 'Placements & Épargne',
                'segment' => 'privat',
                'icon' => 'heroicon-o-building-library',
                'order' => 21,
                'title' => [
                    'fr' => 'Fonds de Placement',
                    'de' => 'Anlagefonds',
                    'en' => 'Investment Funds',
                    'es' => 'Fondos de Inversión'
                ],
                'description' => [
                    'fr' => 'Large sélection de fonds: actions, obligations, immobilier, durables. Gestion professionnelle.',
                    'de' => 'Große Auswahl an Fonds: Aktien, Anleihen, Immobilien, nachhaltig. Professionelle Verwaltung.',
                    'en' => 'Wide selection of funds: equities, bonds, real estate, sustainable. Professional management.',
                    'es' => 'Amplia selección de fondos: acciones, bonos, inmobiliario, sostenibles. Gestión profesional.'
                ],
                'content' => [
                    'fr' => '<h2>Investir simplement et efficacement</h2><p>Les fonds de placement vous permettent d\'investir dans un portefeuille diversifié géré par des professionnels, accessible dès CHF 1\'000.</p><h3>Notre gamme</h3><ul><li><strong>Fonds Actions</strong>: Suisse, Europe, Monde, Émergents</li><li><strong>Fonds Obligations</strong>: CHF, Multi-devises, High Yield</li><li><strong>Fonds Mixtes</strong>: Profils de risque adaptés</li><li><strong>Fonds Immobiliers</strong>: Suisse et international</li><li><strong>Fonds ESG</strong>: Investissement durable</li></ul><h3>Avantages</h3><p>Diversification instantanée, gestion professionnelle, liquidité élevée, frais transparents, minimum accessible</p>',
                    'de' => '<h2>Einfach und effizient investieren</h2><p>Anlagefonds ermöglichen es Ihnen, in ein diversifiziertes Portfolio zu investieren, das von Fachleuten verwaltet wird, ab CHF 1\'000 zugänglich.</p><h3>Unser Sortiment</h3><ul><li><strong>Aktienfonds</strong>: Schweiz, Europa, Welt, Schwellenländer</li><li><strong>Obligationenfonds</strong>: CHF, Multi-Währungen, High Yield</li><li><strong>Mischfonds</strong>: Angepasste Risikoprofile</li><li><strong>Immobilienfonds</strong>: Schweiz und international</li><li><strong>ESG-Fonds</strong>: Nachhaltiges Investieren</li></ul><h3>Vorteile</h3><p>Sofortige Diversifikation, professionelle Verwaltung, hohe Liquidität, transparente Gebühren, zugängliches Minimum</p>',
                    'en' => '<h2>Invest simply and efficiently</h2><p>Investment funds allow you to invest in a diversified portfolio managed by professionals, accessible from CHF 1,000.</p><h3>Our range</h3><ul><li><strong>Equity Funds</strong>: Switzerland, Europe, World, Emerging</li><li><strong>Bond Funds</strong>: CHF, Multi-currency, High Yield</li><li><strong>Mixed Funds</strong>: Adapted risk profiles</li><li><strong>Real Estate Funds</strong>: Switzerland and international</li><li><strong>ESG Funds</strong>: Sustainable investing</li></ul><h3>Benefits</h3><p>Instant diversification, professional management, high liquidity, transparent fees, accessible minimum</p>',
                    'es' => '<h2>Invierta de forma simple y eficiente</h2><p>Los fondos de inversión le permiten invertir en una cartera diversificada gestionada por profesionales, accesible desde CHF 1.000.</p><h3>Nuestra gama</h3><ul><li><strong>Fondos de Acciones</strong>: Suiza, Europa, Mundo, Emergentes</li><li><strong>Fondos de Bonos</strong>: CHF, Multi-divisas, High Yield</li><li><strong>Fondos Mixtos</strong>: Perfiles de riesgo adaptados</li><li><strong>Fondos Inmobiliarios</strong>: Suiza e internacional</li><li><strong>Fondos ESG</strong>: Inversión sostenible</li></ul><h3>Ventajas</h3><p>Diversificación instantánea, gestión profesional, alta liquidez, comisiones transparentes, mínimo accesible</p>'
                ],
                'features' => [
                    'fr' => ['Dès CHF 1\'000', 'Gestion pro', '100+ fonds', 'ESG disponible'],
                    'de' => ['Ab CHF 1\'000', 'Profi-Verwaltung', '100+ Fonds', 'ESG verfügbar'],
                    'en' => ['From CHF 1,000', 'Pro management', '100+ funds', 'ESG available'],
                    'es' => ['Desde CHF 1.000', 'Gestión pro', '100+ fondos', 'ESG disponible']
                ],
                'benefits' => [
                    'fr' => ['Simplicité', 'Diversification', 'Accessibilité', 'Performance'],
                    'de' => ['Einfachheit', 'Diversifikation', 'Zugänglichkeit', 'Performance'],
                    'en' => ['Simplicity', 'Diversification', 'Accessibility', 'Performance'],
                    'es' => ['Simplicidad', 'Diversificación', 'Accesibilidad', 'Rendimiento']
                ],
            ],

            [
                'slug' => 'gestion-fortune',
                'category' => 'Placements & Épargne',
                'segment' => 'privat',
                'icon' => 'heroicon-o-sparkles',
                'order' => 22,
                'title' => [
                    'fr' => 'Gestion de Fortune',
                    'de' => 'Vermögensverwaltung',
                    'en' => 'Wealth Management',
                    'es' => 'Gestión de Patrimonios'
                ],
                'description' => [
                    'fr' => 'Gestion sur mesure de votre patrimoine. Mandat personnalisé, conseiller dédié. Dès CHF 500\'000.',
                    'de' => 'Maßgeschneiderte Verwaltung Ihres Vermögens. Persönliches Mandat, dedizierter Berater. Ab CHF 500\'000.',
                    'en' => 'Customized management of your assets. Personalized mandate, dedicated advisor. From CHF 500,000.',
                    'es' => 'Gestión personalizada de su patrimonio. Mandato personalizado, asesor dedicado. Desde CHF 500.000.'
                ],
                'content' => [
                    'fr' => '<h2>Une gestion sur mesure</h2><p>La gestion de fortune Acrevis vous offre un service complet et personnalisé pour optimiser votre patrimoine selon vos objectifs et votre profil de risque.</p><h3>Notre approche</h3><ul><li>Analyse approfondie de votre situation</li><li>Définition de votre stratégie patrimoniale</li><li>Construction d\'un portefeuille sur mesure</li><li>Gestion active et monitoring quotidien</li><li>Reporting détaillé et transparent</li></ul><h3>Services Premium</h3><p>Conseiller privé dédié, planning fiscal, conseil en succession, accès aux opportunités exclusives, conciergerie bancaire</p>',
                    'de' => '<h2>Maßgeschneiderte Verwaltung</h2><p>Die Acrevis Vermögensverwaltung bietet Ihnen einen umfassenden und personalisierten Service zur Optimierung Ihres Vermögens entsprechend Ihren Zielen und Ihrem Risikoprofil.</p><h3>Unser Ansatz</h3><ul><li>Tiefgehende Analyse Ihrer Situation</li><li>Definition Ihrer Vermögensstrategie</li><li>Aufbau eines maßgeschneiderten Portfolios</li><li>Aktive Verwaltung und tägliches Monitoring</li><li>Detailliertes und transparentes Reporting</li></ul><h3>Premium-Services</h3><p>Dedizierter Privatberater, Steuerplanung, Nachfolgeberatung, Zugang zu exklusiven Gelegenheiten, Bank-Concierge</p>',
                    'en' => '<h2>Customized management</h2><p>Acrevis wealth management offers you comprehensive and personalized service to optimize your assets according to your objectives and risk profile.</p><h3>Our approach</h3><ul><li>In-depth analysis of your situation</li><li>Definition of your wealth strategy</li><li>Construction of a customized portfolio</li><li>Active management and daily monitoring</li><li>Detailed and transparent reporting</li></ul><h3>Premium services</h3><p>Dedicated private advisor, tax planning, succession advice, access to exclusive opportunities, banking concierge</p>',
                    'es' => '<h2>Gestión personalizada</h2><p>La gestión de patrimonios Acrevis le ofrece un servicio completo y personalizado para optimizar su patrimonio según sus objetivos y perfil de riesgo.</p><h3>Nuestro enfoque</h3><ul><li>Análisis profundo de su situación</li><li>Definición de su estrategia patrimonial</li><li>Construcción de una cartera a medida</li><li>Gestión activa y seguimiento diario</li><li>Reporting detallado y transparente</li></ul><h3>Servicios Premium</h3><p>Asesor privado dedicado, planificación fiscal, asesoría en sucesión, acceso a oportunidades exclusivas, conserjería bancaria</p>'
                ],
                'features' => [
                    'fr' => ['Dès CHF 500K', 'Conseiller dédié', 'Sur mesure', 'Reporting détaillé'],
                    'de' => ['Ab CHF 500K', 'Dedizierter Berater', 'Maßgeschneidert', 'Detailliertes Reporting'],
                    'en' => ['From CHF 500K', 'Dedicated advisor', 'Customized', 'Detailed reporting'],
                    'es' => ['Desde CHF 500K', 'Asesor dedicado', 'A medida', 'Reporting detallado']
                ],
                'benefits' => [
                    'fr' => ['Expertise pointue', 'Service premium', 'Performance optimisée', 'Sérénité totale'],
                    'de' => ['Hohe Expertise', 'Premium-Service', 'Optimierte Performance', 'Volle Gelassenheit'],
                    'en' => ['High expertise', 'Premium service', 'Optimized performance', 'Total peace of mind'],
                    'es' => ['Alta experiencia', 'Servicio premium', 'Rendimiento optimizado', 'Tranquilidad total']
                ],
            ],

            [
                'slug' => 'plan-epargne-3a',
                'category' => 'Placements & Épargne',
                'segment' => 'privat',
                'icon' => 'heroicon-o-shield-check',
                'order' => 23,
                'title' => [
                    'fr' => 'Pilier 3a - Épargne Prévoyance',
                    'de' => 'Säule 3a - Vorsorge Sparen',
                    'en' => 'Pillar 3a - Retirement Savings',
                    'es' => 'Pilar 3a - Ahorro de Previsión'
                ],
                'description' => [
                    'fr' => 'Épargnez pour votre retraite et économisez des impôts. Déductions fiscales maximales.',
                    'de' => 'Sparen Sie für Ihren Ruhestand und sparen Sie Steuern. Maximale Steuerabzüge.',
                    'en' => 'Save for your retirement and save on taxes. Maximum tax deductions.',
                    'es' => 'Ahorre para su jubilación y economice impuestos. Deducciones fiscales máximas.'
                ],
                'content' => [
                    'fr' => '<h2>Le pilier de votre prévoyance</h2><p>Le pilier 3a vous permet de constituer votre capital retraite tout en bénéficiant d\'avantages fiscaux importants. Jusqu\'à CHF 7\'056 déductibles par an (salariés).</p><h3>Nos solutions 3a</h3><ul><li><strong>Compte 3a</strong>: Sécurité maximale, intérêt garanti 0.75%</li><li><strong>Fonds 3a Conservateur</strong>: 25% actions, rendement potentiel moyen</li><li><strong>Fonds 3a Équilibré</strong>: 45% actions, bon compromis risque/rendement</li><li><strong>Fonds 3a Dynamique</strong>: 75% actions, rendement potentiel élevé</li></ul><h3>Avantages fiscaux</h3><p>Économie d\'impôts annuelle de CHF 1\'500 à 2\'800 selon canton et revenu. Capital exonéré pendant la durée. Taux préférentiel au retrait.</p>',
                    'de' => '<h2>Die Säule Ihrer Vorsorge</h2><p>Die Säule 3a ermöglicht es Ihnen, Ihr Alterskapital aufzubauen und gleichzeitig von erheblichen Steuervorteilen zu profitieren. Bis CHF 7\'056 abzugsfähig pro Jahr (Angestellte).</p><h3>Unsere 3a-Lösungen</h3><ul><li><strong>Konto 3a</strong>: Maximale Sicherheit, garantierter Zins 0.75%</li><li><strong>Fonds 3a Konservativ</strong>: 25% Aktien, mittleres Renditepotenzial</li><li><strong>Fonds 3a Ausgewogen</strong>: 45% Aktien, guter Risiko-Rendite-Kompromiss</li><li><strong>Fonds 3a Dynamisch</strong>: 75% Aktien, hohes Renditepotenzial</li></ul><h3>Steuervorteile</h3><p>Jährliche Steuerersparnis von CHF 1\'500 bis 2\'800 je nach Kanton und Einkommen. Kapital während der Laufzeit steuerfrei. Vorzugssatz bei Bezug.</p>',
                    'en' => '<h2>The pillar of your retirement</h2><p>Pillar 3a allows you to build your retirement capital while benefiting from significant tax advantages. Up to CHF 7,056 deductible per year (employees).</p><h3>Our 3a solutions</h3><ul><li><strong>Account 3a</strong>: Maximum security, guaranteed interest 0.75%</li><li><strong>Fund 3a Conservative</strong>: 25% equities, medium return potential</li><li><strong>Fund 3a Balanced</strong>: 45% equities, good risk/return compromise</li><li><strong>Fund 3a Dynamic</strong>: 75% equities, high return potential</li></ul><h3>Tax benefits</h3><p>Annual tax savings of CHF 1,500 to 2,800 depending on canton and income. Capital tax-free during term. Preferential rate on withdrawal.</p>',
                    'es' => '<h2>El pilar de su previsión</h2><p>El pilar 3a le permite constituir su capital de jubilación mientras se beneficia de importantes ventajas fiscales. Hasta CHF 7.056 deducibles por año (asalariados).</p><h3>Nuestras soluciones 3a</h3><ul><li><strong>Cuenta 3a</strong>: Máxima seguridad, interés garantizado 0.75%</li><li><strong>Fondo 3a Conservador</strong>: 25% acciones, potencial de rendimiento medio</li><li><strong>Fondo 3a Equilibrado</strong>: 45% acciones, buen compromiso riesgo/rendimiento</li><li><strong>Fondo 3a Dinámico</strong>: 75% acciones, alto potencial de rendimiento</li></ul><h3>Ventajas fiscales</h3><p>Ahorro fiscal anual de CHF 1.500 a 2.800 según cantón e ingresos. Capital exento durante la duración. Tipo preferencial en el retiro.</p>'
                ],
                'features' => [
                    'fr' => ['Déduction fiscale', '4 profils de risque', 'Dès CHF 100/mois', 'Versements flexibles'],
                    'de' => ['Steuerabzug', '4 Risikoprofile', 'Ab CHF 100/Monat', 'Flexible Einzahlungen'],
                    'en' => ['Tax deduction', '4 risk profiles', 'From CHF 100/month', 'Flexible payments'],
                    'es' => ['Deducción fiscal', '4 perfiles de riesgo', 'Desde CHF 100/mes', 'Pagos flexibles']
                ],
                'benefits' => [
                    'fr' => ['Économie d\'impôts', 'Retraite sereine', 'Rendement attractif', 'Capital garanti'],
                    'de' => ['Steuerersparnis', 'Sorgenfreier Ruhestand', 'Attraktive Rendite', 'Garantiertes Kapital'],
                    'en' => ['Tax savings', 'Secure retirement', 'Attractive returns', 'Guaranteed capital'],
                    'es' => ['Ahorro fiscal', 'Jubilación serena', 'Rendimiento atractivo', 'Capital garantizado']
                ],
            ],

            // Reste de Placements & Épargne (5 services)
            [
                'slug' => 'obligations',
                'category' => 'Placements & Épargne',
                'segment' => 'privat',
                'icon' => 'heroicon-o-document-text',
                'order' => 24,
                'title' => ['fr' => 'Obligations', 'de' => 'Obligationen', 'en' => 'Bonds', 'es' => 'Bonos'],
                'description' => ['fr' => 'Investissez dans des obligations d\'État et d\'entreprises. Revenus réguliers et sécurité.', 'de' => 'Investieren Sie in Staats- und Unternehmensanleihen. Regelmäßige Erträge und Sicherheit.', 'en' => 'Invest in government and corporate bonds. Regular income and security.', 'es' => 'Invierta en bonos gubernamentales y corporativos. Ingresos regulares y seguridad.'],
                'content' => ['fr' => '<h2>Revenus stables et prévisibles</h2><p>Les obligations offrent des revenus réguliers sous forme de coupons. Portefeuille obligataire personnalisé selon votre profil.</p><h3>Notre sélection</h3><ul><li>Obligations d\'État suisses (AAA)</li><li>Obligations cantonales</li><li>Obligations d\'entreprises investment grade</li><li>Obligations à haut rendement</li></ul>', 'de' => '<h2>Stabile und vorhersehbare Erträge</h2><p>Anleihen bieten regelmäßige Erträge in Form von Kupons. Personalisiertes Anleihenportfolio nach Ihrem Profil.</p><h3>Unsere Auswahl</h3><ul><li>Schweizer Staatsanleihen (AAA)</li><li>Kantonale Anleihen</li><li>Investment-Grade-Unternehmensanleihen</li><li>Hochzinsanleihen</li></ul>', 'en' => '<h2>Stable and predictable returns</h2><p>Bonds offer regular income in the form of coupons. Personalized bond portfolio according to your profile.</p><h3>Our selection</h3><ul><li>Swiss government bonds (AAA)</li><li>Cantonal bonds</li><li>Investment grade corporate bonds</li><li>High yield bonds</li></ul>', 'es' => '<h2>Rendimientos estables y previsibles</h2><p>Los bonos ofrecen ingresos regulares en forma de cupones. Cartera de bonos personalizada según su perfil.</p><h3>Nuestra selección</h3><ul><li>Bonos del gobierno suizo (AAA)</li><li>Bonos cantonales</li><li>Bonos corporativos investment grade</li><li>Bonos de alto rendimiento</li></ul>'],
                'features' => ['fr' => ['Revenus réguliers', 'Sélection AAA', 'Diversification', 'Gestion experte'], 'de' => ['Regelmäßige Erträge', 'AAA-Auswahl', 'Diversifikation', 'Expertenmanagement'], 'en' => ['Regular income', 'AAA selection', 'Diversification', 'Expert management'], 'es' => ['Ingresos regulares', 'Selección AAA', 'Diversificación', 'Gestión experta']],
                'benefits' => ['fr' => ['Sécurité', 'Prévisibilité', 'Fiscalité avantageuse', 'Liquidité'], 'de' => ['Sicherheit', 'Vorhersehbarkeit', 'Vorteilhafte Besteuerung', 'Liquidität'], 'en' => ['Security', 'Predictability', 'Tax benefits', 'Liquidity'], 'es' => ['Seguridad', 'Previsibilidad', 'Ventajas fiscales', 'Liquidez']],
            ],
            [
                'slug' => 'trading-ligne',
                'category' => 'Placements & Épargne',
                'segment' => 'privat',
                'icon' => 'heroicon-o-computer-desktop',
                'order' => 25,
                'title' => ['fr' => 'Trading en Ligne', 'de' => 'Online-Trading', 'en' => 'Online Trading', 'es' => 'Trading Online'],
                'description' => ['fr' => 'Tradez en toute autonomie. Plateforme professionnelle, cotations temps réel, ordres avancés.', 'de' => 'Handeln Sie völlig autonom. Professionelle Plattform, Echtzeit-Kurse, erweiterte Orders.', 'en' => 'Trade independently. Professional platform, real-time quotes, advanced orders.', 'es' => 'Opere de forma autónoma. Plataforma profesional, cotizaciones en tiempo real, órdenes avanzadas.'],
                'content' => ['fr' => '<h2>Tradez comme un pro</h2><p>Notre plateforme de trading en ligne vous donne accès aux marchés mondiaux avec des outils professionnels.</p><h3>Fonctionnalités</h3><ul><li>Cotations en temps réel</li><li>Graphiques avancés et analyses techniques</li><li>Ordres limit, stop-loss, trailing stop</li><li>Alertes personnalisables</li><li>Application mobile</li></ul><h3>Tarifs</h3><p>CHF 9.- par transaction (actions suisses), CHF 19.- actions étrangères</p>', 'de' => '<h2>Handeln Sie wie ein Profi</h2><p>Unsere Online-Trading-Plattform gibt Ihnen Zugang zu globalen Märkten mit professionellen Tools.</p><h3>Funktionen</h3><ul><li>Echtzeit-Kurse</li><li>Erweiterte Charts und technische Analysen</li><li>Limit-, Stop-Loss-, Trailing-Stop-Orders</li><li>Anpassbare Alarme</li><li>Mobile App</li></ul><h3>Gebühren</h3><p>CHF 9.- pro Transaktion (Schweizer Aktien), CHF 19.- ausländische Aktien</p>', 'en' => '<h2>Trade like a pro</h2><p>Our online trading platform gives you access to global markets with professional tools.</p><h3>Features</h3><ul><li>Real-time quotes</li><li>Advanced charts and technical analysis</li><li>Limit, stop-loss, trailing stop orders</li><li>Customizable alerts</li><li>Mobile app</li></ul><h3>Fees</h3><p>CHF 9.- per transaction (Swiss stocks), CHF 19.- foreign stocks</p>', 'es' => '<h2>Opere como un profesional</h2><p>Nuestra plataforma de trading online le da acceso a mercados globales con herramientas profesionales.</p><h3>Funcionalidades</h3><ul><li>Cotizaciones en tiempo real</li><li>Gráficos avanzados y análisis técnico</li><li>Órdenes limit, stop-loss, trailing stop</li><li>Alertas personalizables</li><li>Aplicación móvil</li></ul><h3>Tarifas</h3><p>CHF 9.- por transacción (acciones suizas), CHF 19.- acciones extranjeras</p>'],
                'features' => ['fr' => ['Plateforme pro', 'Temps réel', 'Mobile', 'Tarifs compétitifs'], 'de' => ['Profi-Plattform', 'Echtzeit', 'Mobil', 'Wettbewerbsfähige Gebühren'], 'en' => ['Pro platform', 'Real-time', 'Mobile', 'Competitive fees'], 'es' => ['Plataforma pro', 'Tiempo real', 'Móvil', 'Tarifas competitivas']],
                'benefits' => ['fr' => ['Autonomie totale', 'Outils avancés', 'Rapidité', 'Transparence'], 'de' => ['Volle Autonomie', 'Erweiterte Tools', 'Geschwindigkeit', 'Transparenz'], 'en' => ['Full autonomy', 'Advanced tools', 'Speed', 'Transparency'], 'es' => ['Autonomía total', 'Herramientas avanzadas', 'Rapidez', 'Transparencia']],
            ],
            [
                'slug' => 'metaux-precieux',
                'category' => 'Placements & Épargne',
                'segment' => 'privat',
                'icon' => 'heroicon-o-trophy',
                'order' => 26,
                'title' => ['fr' => 'Métaux Précieux', 'de' => 'Edelmetalle', 'en' => 'Precious Metals', 'es' => 'Metales Preciosos'],
                'description' => ['fr' => 'Or, argent, platine, palladium. Stockage sécurisé en Suisse. Protection contre l\'inflation.', 'de' => 'Gold, Silber, Platin, Palladium. Sichere Lagerung in der Schweiz. Inflationsschutz.', 'en' => 'Gold, silver, platinum, palladium. Secure storage in Switzerland. Inflation protection.', 'es' => 'Oro, plata, platino, paladio. Almacenamiento seguro en Suiza. Protección contra inflación.'],
                'content' => ['fr' => '<h2>Valeur refuge par excellence</h2><p>Investissez dans les métaux précieux pour diversifier votre patrimoine et vous protéger contre l\'inflation.</p><h3>Notre offre</h3><ul><li>Or: lingots 1g à 1kg, pièces</li><li>Argent: lingots et pièces</li><li>Platine et palladium</li><li>Stockage sécurisé en coffre</li><li>Certificats or physique</li></ul><p>Achat/vente au cours du jour, frais de garde 0.5% par an</p>', 'de' => '<h2>Sichere Anlage par excellence</h2><p>Investieren Sie in Edelmetalle, um Ihr Vermögen zu diversifizieren und sich vor Inflation zu schützen.</p><h3>Unser Angebot</h3><ul><li>Gold: Barren 1g bis 1kg, Münzen</li><li>Silber: Barren und Münzen</li><li>Platin und Palladium</li><li>Sichere Lagerung im Tresor</li><li>Goldzertifikate physisch</li></ul><p>Kauf/Verkauf zum Tageskurs, Lagergebühren 0.5% pro Jahr</p>', 'en' => '<h2>Safe haven par excellence</h2><p>Invest in precious metals to diversify your assets and protect against inflation.</p><h3>Our offering</h3><ul><li>Gold: bars 1g to 1kg, coins</li><li>Silver: bars and coins</li><li>Platinum and palladium</li><li>Secure vault storage</li><li>Physical gold certificates</li></ul><p>Buy/sell at daily price, custody fees 0.5% per year</p>', 'es' => '<h2>Valor refugio por excelencia</h2><p>Invierta en metales preciosos para diversificar su patrimonio y protegerse contra la inflación.</p><h3>Nuestra oferta</h3><ul><li>Oro: lingotes 1g a 1kg, monedas</li><li>Plata: lingotes y monedas</li><li>Platino y paladio</li><li>Almacenamiento seguro en caja fuerte</li><li>Certificados oro físico</li></ul><p>Compra/venta al precio del día, comisiones custodia 0.5% por año</p>'],
                'features' => ['fr' => ['Or physique', 'Stockage CH', 'Achat/vente facile', 'Diversification'], 'de' => ['Physisches Gold', 'Lagerung CH', 'Einfacher Kauf/Verkauf', 'Diversifikation'], 'en' => ['Physical gold', 'CH storage', 'Easy buy/sell', 'Diversification'], 'es' => ['Oro físico', 'Almacenamiento CH', 'Compra/venta fácil', 'Diversificación']],
                'benefits' => ['fr' => ['Valeur refuge', 'Anti-inflation', 'Liquide', 'Sécurité'], 'de' => ['Sichere Anlage', 'Anti-Inflation', 'Liquide', 'Sicherheit'], 'en' => ['Safe haven', 'Anti-inflation', 'Liquid', 'Security'], 'es' => ['Valor refugio', 'Anti-inflación', 'Líquido', 'Seguridad']],
            ],
            [
                'slug' => 'cryptomonnaies',
                'category' => 'Placements & Épargne',
                'segment' => 'privat',
                'icon' => 'heroicon-o-currency-dollar',
                'order' => 27,
                'title' => ['fr' => 'Cryptomonnaies', 'de' => 'Kryptowährungen', 'en' => 'Cryptocurrencies', 'es' => 'Criptomonedas'],
                'description' => ['fr' => 'Bitcoin, Ethereum et principales cryptos. Trading sécurisé, custody suisse réglementée.', 'de' => 'Bitcoin, Ethereum und wichtige Kryptos. Sicheres Trading, regulierte Schweizer Verwahrung.', 'en' => 'Bitcoin, Ethereum and major cryptos. Secure trading, regulated Swiss custody.', 'es' => 'Bitcoin, Ethereum y principales criptos. Trading seguro, custodia suiza regulada.'],
                'content' => ['fr' => '<h2>Entrez dans l\'économie digitale</h2><p>Investissez dans les cryptomonnaies avec la sécurité et la conformité d\'une banque suisse.</p><h3>Cryptos disponibles</h3><ul><li>Bitcoin (BTC)</li><li>Ethereum (ETH)</li><li>Cardano, Polkadot, Solana</li><li>Stablecoins (USDC, USDT)</li></ul><h3>Services</h3><p>Trading 24/7, custody sécurisée cold storage, conversion CHF direct, fiscalité optimisée</p>', 'de' => '<h2>Betreten Sie die digitale Wirtschaft</h2><p>Investieren Sie in Kryptowährungen mit der Sicherheit und Compliance einer Schweizer Bank.</p><h3>Verfügbare Kryptos</h3><ul><li>Bitcoin (BTC)</li><li>Ethereum (ETH)</li><li>Cardano, Polkadot, Solana</li><li>Stablecoins (USDC, USDT)</li></ul><h3>Services</h3><p>Trading 24/7, sichere Cold-Storage-Verwahrung, direkte CHF-Konvertierung, optimierte Besteuerung</p>', 'en' => '<h2>Enter the digital economy</h2><p>Invest in cryptocurrencies with the security and compliance of a Swiss bank.</p><h3>Available cryptos</h3><ul><li>Bitcoin (BTC)</li><li>Ethereum (ETH)</li><li>Cardano, Polkadot, Solana</li><li>Stablecoins (USDC, USDT)</li></ul><h3>Services</h3><p>24/7 trading, secure cold storage custody, direct CHF conversion, optimized taxation</p>', 'es' => '<h2>Entre en la economía digital</h2><p>Invierta en criptomonedas con la seguridad y cumplimiento de un banco suizo.</p><h3>Criptos disponibles</h3><ul><li>Bitcoin (BTC)</li><li>Ethereum (ETH)</li><li>Cardano, Polkadot, Solana</li><li>Stablecoins (USDC, USDT)</li></ul><h3>Servicios</h3><p>Trading 24/7, custodia segura cold storage, conversión CHF directa, fiscalidad optimizada</p>'],
                'features' => ['fr' => ['10+ cryptos', 'Trading 24/7', 'Custody CH', 'Sécurité bancaire'], 'de' => ['10+ Kryptos', 'Trading 24/7', 'Verwahrung CH', 'Banksicherheit'], 'en' => ['10+ cryptos', '24/7 trading', 'CH custody', 'Bank security'], 'es' => ['10+ criptos', 'Trading 24/7', 'Custodia CH', 'Seguridad bancaria']],
                'benefits' => ['fr' => ['Innovation', 'Potentiel élevé', 'Diversification', 'Conformité'], 'de' => ['Innovation', 'Hohes Potenzial', 'Diversifikation', 'Compliance'], 'en' => ['Innovation', 'High potential', 'Diversification', 'Compliance'], 'es' => ['Innovación', 'Alto potencial', 'Diversificación', 'Cumplimiento']],
            ],
            [
                'slug' => 'plan-epargne-enfants',
                'category' => 'Placements & Épargne',
                'segment' => 'privat',
                'icon' => 'heroicon-o-gift',
                'order' => 28,
                'title' => ['fr' => 'Plan d\'Épargne Enfants', 'de' => 'Kindersparplan', 'en' => 'Children Savings Plan', 'es' => 'Plan de Ahorro Infantil'],
                'description' => ['fr' => 'Constituez un capital pour vos enfants. Versements libres, rendement attractif, cadeau idéal.', 'de' => 'Bauen Sie Kapital für Ihre Kinder auf. Freie Einzahlungen, attraktive Rendite, ideales Geschenk.', 'en' => 'Build capital for your children. Free payments, attractive returns, ideal gift.', 'es' => 'Constituya un capital para sus hijos. Pagos libres, rendimiento atractivo, regalo ideal.'],
                'content' => ['fr' => '<h2>Préparez l\'avenir de vos enfants</h2><p>Le plan d\'épargne enfants permet de constituer progressivement un capital pour financer les études, le permis, le premier logement...</p><h3>Avantages</h3><ul><li>Versements dès CHF 25/mois</li><li>Fonds sécurisés ou dynamiques au choix</li><li>Libération à la majorité ou plus tard</li><li>Famille et parrains peuvent contribuer</li></ul><p>Taux bonifié de 1.5% sur compte, ou fonds jusqu\'à 5% de rendement moyen</p>', 'de' => '<h2>Bereiten Sie die Zukunft Ihrer Kinder vor</h2><p>Der Kindersparplan ermöglicht es, schrittweise Kapital zur Finanzierung von Studium, Führerschein, erster Wohnung aufzubauen...</p><h3>Vorteile</h3><ul><li>Einzahlungen ab CHF 25/Monat</li><li>Wahl zwischen gesicherten oder dynamischen Fonds</li><li>Freigabe bei Volljährigkeit oder später</li><li>Familie und Paten können beitragen</li></ul><p>Bonuszins von 1.5% auf Konto, oder Fonds bis 5% Durchschnittsrendite</p>', 'en' => '<h2>Prepare your children\'s future</h2><p>The children savings plan allows you to progressively build capital to finance studies, driving license, first home...</p><h3>Benefits</h3><ul><li>Payments from CHF 25/month</li><li>Choice of secure or dynamic funds</li><li>Release at majority or later</li><li>Family and godparents can contribute</li></ul><p>Bonus rate of 1.5% on account, or funds up to 5% average return</p>', 'es' => '<h2>Prepare el futuro de sus hijos</h2><p>El plan de ahorro infantil permite constituir progresivamente un capital para financiar estudios, carné de conducir, primera vivienda...</p><h3>Ventajas</h3><ul><li>Pagos desde CHF 25/mes</li><li>Elección de fondos seguros o dinámicos</li><li>Liberación en mayoría de edad o después</li><li>Familia y padrinos pueden contribuir</li></ul><p>Tipo bonificado de 1.5% en cuenta, o fondos hasta 5% de rendimiento medio</p>'],
                'features' => ['fr' => ['Dès CHF 25/mois', 'Taux bonifié', 'Flexibilité', 'Multi-contributeurs'], 'de' => ['Ab CHF 25/Monat', 'Bonuszins', 'Flexibilität', 'Multi-Einzahler'], 'en' => ['From CHF 25/month', 'Bonus rate', 'Flexibility', 'Multi-contributors'], 'es' => ['Desde CHF 25/mes', 'Tipo bonificado', 'Flexibilidad', 'Multi-contribuyentes']],
                'benefits' => ['fr' => ['Avenir assuré', 'Cadeau durable', 'Rendement attractif', 'Simplicité'], 'de' => ['Gesicherte Zukunft', 'Nachhaltiges Geschenk', 'Attraktive Rendite', 'Einfachheit'], 'en' => ['Secure future', 'Lasting gift', 'Attractive returns', 'Simplicity'], 'es' => ['Futuro asegurado', 'Regalo duradero', 'Rendimiento atractivo', 'Simplicidad']],
            ],

            // CATÉGORIE 4: PRÉVOYANCE (6 services)
            [
                'slug' => 'assurance-vie',
                'category' => 'Prévoyance',
                'segment' => 'privat',
                'icon' => 'heroicon-o-heart',
                'order' => 30,
                'title' => ['fr' => 'Assurance-Vie', 'de' => 'Lebensversicherung', 'en' => 'Life Insurance', 'es' => 'Seguro de Vida'],
                'description' => ['fr' => 'Protégez votre famille. Capital ou rente en cas de décès. Avantages fiscaux importants.', 'de' => 'Schützen Sie Ihre Familie. Kapital oder Rente im Todesfall. Erhebliche Steuervorteile.', 'en' => 'Protect your family. Capital or pension in case of death. Significant tax benefits.', 'es' => 'Proteja a su familia. Capital o renta en caso de fallecimiento. Importantes ventajas fiscales.'],
                'content' => ['fr' => '<h2>Sécurité pour vos proches</h2><p>L\'assurance-vie garantit un capital ou une rente à vos bénéficiaires en cas de décès. Protection essentielle pour votre famille.</p><h3>Nos solutions</h3><ul><li>Assurance décès pure: protection maximale, primes minimales</li><li>Assurance mixte: épargne + protection</li><li>Assurance liée à des fonds: rendement + couverture</li></ul><h3>Avantages</h3><p>Capital versé exempt d\'impôt aux bénéficiaires, primes déductibles fiscalement, montant et durée personnalisables</p>', 'de' => '<h2>Sicherheit für Ihre Angehörigen</h2><p>Die Lebensversicherung garantiert Ihren Begünstigten ein Kapital oder eine Rente im Todesfall. Wesentlicher Schutz für Ihre Familie.</p><h3>Unsere Lösungen</h3><ul><li>Reine Todesfallversicherung: maximaler Schutz, minimale Prämien</li><li>Gemischte Versicherung: Sparen + Schutz</li><li>Fondsgebundene Versicherung: Rendite + Deckung</li></ul><h3>Vorteile</h3><p>Ausgezahltes Kapital steuerfrei für Begünstigte, Prämien steuerlich abzugsfähig, Betrag und Dauer anpassbar</p>', 'en' => '<h2>Security for your loved ones</h2><p>Life insurance guarantees capital or a pension to your beneficiaries in case of death. Essential protection for your family.</p><h3>Our solutions</h3><ul><li>Pure death insurance: maximum protection, minimum premiums</li><li>Mixed insurance: savings + protection</li><li>Unit-linked insurance: return + coverage</li></ul><h3>Benefits</h3><p>Capital paid tax-free to beneficiaries, tax-deductible premiums, customizable amount and duration</p>', 'es' => '<h2>Seguridad para sus seres queridos</h2><p>El seguro de vida garantiza un capital o una renta a sus beneficiarios en caso de fallecimiento. Protección esencial para su familia.</p><h3>Nuestras soluciones</h3><ul><li>Seguro de fallecimiento puro: protección máxima, primas mínimas</li><li>Seguro mixto: ahorro + protección</li><li>Seguro vinculado a fondos: rendimiento + cobertura</li></ul><h3>Ventajas</h3><p>Capital pagado exento de impuestos a beneficiarios, primas deducibles fiscalmente, monto y duración personalizables</p>'],
                'features' => ['fr' => ['Protection famille', 'Capital garanti', 'Déduction fiscale', 'Personnalisable'], 'de' => ['Familienschutz', 'Garantiertes Kapital', 'Steuerabzug', 'Anpassbar'], 'en' => ['Family protection', 'Guaranteed capital', 'Tax deduction', 'Customizable'], 'es' => ['Protección familiar', 'Capital garantizado', 'Deducción fiscal', 'Personalizable']],
                'benefits' => ['fr' => ['Sérénité', 'Protection optimale', 'Avantages fiscaux', 'Flexibilité'], 'de' => ['Gelassenheit', 'Optimaler Schutz', 'Steuervorteile', 'Flexibilität'], 'en' => ['Peace of mind', 'Optimal protection', 'Tax benefits', 'Flexibility'], 'es' => ['Serenidad', 'Protección óptima', 'Ventajas fiscales', 'Flexibilidad']],
            ],
            [
                'slug' => 'prevoyance-libre-3b',
                'category' => 'Prévoyance',
                'segment' => 'privat',
                'icon' => 'heroicon-o-lock-open',
                'order' => 31,
                'title' => ['fr' => 'Pilier 3b - Prévoyance Libre', 'de' => 'Säule 3b - Freie Vorsorge', 'en' => 'Pillar 3b - Free Pension', 'es' => 'Pilar 3b - Previsión Libre'],
                'description' => ['fr' => 'Complément sans contrainte au pilier 3a. Versements libres, retrait flexible, succession optimisée.', 'de' => 'Ungebundene Ergänzung zur Säule 3a. Freie Einzahlungen, flexibler Bezug, optimierte Nachfolge.', 'en' => 'Unconstrained complement to pillar 3a. Free payments, flexible withdrawal, optimized succession.', 'es' => 'Complemento sin restricciones al pilar 3a. Pagos libres, retiro flexible, sucesión optimizada.'],
                'content' => ['fr' => '<h2>La liberté de prévoir</h2><p>Le pilier 3b offre une flexibilité totale pour votre prévoyance complémentaire, sans limite de versement ni contrainte de retrait.</p><h3>Avantages</h3><ul><li>Montants illimités</li><li>Retrait à tout moment</li><li>Bénéficiaire libre</li><li>Combinaison épargne + assurance</li><li>Déductions fiscales cantonales possibles</li></ul>', 'de' => '<h2>Die Freiheit vorzusorgen</h2><p>Die Säule 3b bietet volle Flexibilität für Ihre ergänzende Vorsorge, ohne Einzahlungslimit oder Bezugseinschränkung.</p><h3>Vorteile</h3><ul><li>Unbegrenzte Beträge</li><li>Bezug jederzeit</li><li>Freier Begünstigter</li><li>Kombination Sparen + Versicherung</li><li>Mögliche kantonale Steuerabzüge</li></ul>', 'en' => '<h2>The freedom to plan</h2><p>Pillar 3b offers total flexibility for your supplementary pension, without payment limit or withdrawal constraint.</p><h3>Benefits</h3><ul><li>Unlimited amounts</li><li>Withdrawal at any time</li><li>Free beneficiary</li><li>Savings + insurance combination</li><li>Possible cantonal tax deductions</li></ul>', 'es' => '<h2>La libertad de prever</h2><p>El pilar 3b ofrece flexibilidad total para su previsión complementaria, sin límite de pago ni restricción de retiro.</p><h3>Ventajas</h3><ul><li>Montos ilimitados</li><li>Retiro en cualquier momento</li><li>Beneficiario libre</li><li>Combinación ahorro + seguro</li><li>Posibles deducciones fiscales cantonales</li></ul>'],
                'features' => ['fr' => ['Sans limite', 'Retrait libre', 'Succession simple', 'Fiscalité avantageuse'], 'de' => ['Ohne Limit', 'Freier Bezug', 'Einfache Nachfolge', 'Vorteilhafte Besteuerung'], 'en' => ['No limit', 'Free withdrawal', 'Simple succession', 'Tax benefits'], 'es' => ['Sin límite', 'Retiro libre', 'Sucesión simple', 'Ventajas fiscales']],
                'benefits' => ['fr' => ['Flexibilité maximale', 'Protection famille', 'Complément idéal', 'Liberté totale'], 'de' => ['Maximale Flexibilität', 'Familienschutz', 'Ideale Ergänzung', 'Volle Freiheit'], 'en' => ['Maximum flexibility', 'Family protection', 'Ideal complement', 'Total freedom'], 'es' => ['Máxima flexibilidad', 'Protección familiar', 'Complemento ideal', 'Libertad total']],
            ],
            [
                'slug' => 'rachat-lpp',
                'category' => 'Prévoyance',
                'segment' => 'privat',
                'icon' => 'heroicon-o-arrow-up-circle',
                'order' => 32,
                'title' => ['fr' => 'Rachat LPP', 'de' => 'BVG-Einkauf', 'en' => 'Pension Fund Buy-in', 'es' => 'Compra LPP'],
                'description' => ['fr' => 'Optimisez votre 2ème pilier et vos impôts. Rachat de lacunes, déductions fiscales importantes.', 'de' => 'Optimieren Sie Ihre 2. Säule und Ihre Steuern. Einkauf von Lücken, erhebliche Steuerabzüge.', 'en' => 'Optimize your 2nd pillar and taxes. Gap buy-in, significant tax deductions.', 'es' => 'Optimice su 2º pilar e impuestos. Compra de lagunas, importantes deducciones fiscales.'],
                'content' => ['fr' => '<h2>Doublez votre avantage</h2><p>Le rachat LPP vous permet d\'améliorer votre prévoyance professionnelle tout en réduisant substantiellement vos impôts.</p><h3>Avantages</h3><ul><li>Déduction fiscale complète du rachat</li><li>Amélioration de votre rente retraite</li><li>Capital de vieillesse augmenté</li><li>Possibilité de rachat échelonné</li></ul><h3>Notre accompagnement</h3><p>Calcul du potentiel de rachat, optimisation fiscale pluriannuelle, financement du rachat possible</p>', 'de' => '<h2>Verdoppeln Sie Ihren Vorteil</h2><p>Der BVG-Einkauf ermöglicht es Ihnen, Ihre berufliche Vorsorge zu verbessern und gleichzeitig Ihre Steuern erheblich zu reduzieren.</p><h3>Vorteile</h3><ul><li>Vollständiger Steuerabzug des Einkaufs</li><li>Verbesserung Ihrer Altersrente</li><li>Erhöhtes Alterskapital</li><li>Möglichkeit des gestaffelten Einkaufs</li></ul><h3>Unsere Begleitung</h3><p>Berechnung des Einkaufspotenzials, mehrjährige Steueroptimierung, Finanzierung des Einkaufs möglich</p>', 'en' => '<h2>Double your advantage</h2><p>Pension fund buy-in allows you to improve your occupational pension while substantially reducing your taxes.</p><h3>Benefits</h3><ul><li>Full tax deduction of buy-in</li><li>Improvement of your retirement pension</li><li>Increased retirement capital</li><li>Possibility of staggered buy-in</li></ul><h3>Our support</h3><p>Calculation of buy-in potential, multi-year tax optimization, buy-in financing possible</p>', 'es' => '<h2>Duplique su ventaja</h2><p>La compra LPP le permite mejorar su previsión profesional reduciendo sustancialmente sus impuestos.</p><h3>Ventajas</h3><ul><li>Deducción fiscal completa de la compra</li><li>Mejora de su renta de jubilación</li><li>Capital de vejez aumentado</li><li>Posibilidad de compra escalonada</li></ul><h3>Nuestro acompañamiento</h3><p>Cálculo del potencial de compra, optimización fiscal plurianual, financiación de la compra posible</p>'],
                'features' => ['fr' => ['Déduction fiscale', 'Retraite améliorée', 'Financement possible', 'Conseil expert'], 'de' => ['Steuerabzug', 'Verbesserte Rente', 'Finanzierung möglich', 'Expertenberatung'], 'en' => ['Tax deduction', 'Improved pension', 'Financing possible', 'Expert advice'], 'es' => ['Deducción fiscal', 'Renta mejorada', 'Financiación posible', 'Asesoramiento experto']],
                'benefits' => ['fr' => ['Économie d\'impôts', 'Retraite confortable', 'Optimisation', 'Accompagnement'], 'de' => ['Steuerersparnis', 'Komfortable Rente', 'Optimierung', 'Begleitung'], 'en' => ['Tax savings', 'Comfortable retirement', 'Optimization', 'Support'], 'es' => ['Ahorro fiscal', 'Jubilación confortable', 'Optimización', 'Acompañamiento']],
            ],
            [
                'slug' => 'assurance-incapacite',
                'category' => 'Prévoyance',
                'segment' => 'privat',
                'icon' => 'heroicon-o-shield-exclamation',
                'order' => 33,
                'title' => ['fr' => 'Assurance Incapacité de Gain', 'de' => 'Erwerbsunfähigkeitsversicherung', 'en' => 'Disability Insurance', 'es' => 'Seguro de Incapacidad Laboral'],
                'description' => ['fr' => 'Protégez vos revenus en cas de maladie ou accident. Rente complémentaire garantie.', 'de' => 'Schützen Sie Ihr Einkommen bei Krankheit oder Unfall. Garantierte Zusatzrente.', 'en' => 'Protect your income in case of illness or accident. Guaranteed supplementary pension.', 'es' => 'Proteja sus ingresos en caso de enfermedad o accidente. Renta complementaria garantizada.'],
                'content' => ['fr' => '<h2>Sécurisez votre revenu</h2><p>En cas d\'incapacité de travail, votre revenu peut chuter drastiquement. Cette assurance vous garantit une rente complémentaire.</p><h3>Couverture</h3><ul><li>Rente jusqu\'à 80% du revenu</li><li>Versement dès 1 mois d\'incapacité</li><li>Couverture maladie et accident</li><li>Prestations jusqu\'à la retraite</li></ul><p>Adaptation au 2ème pilier, franchise modulable, augmentation automatique des rentes</p>', 'de' => '<h2>Sichern Sie Ihr Einkommen</h2><p>Bei Arbeitsunfähigkeit kann Ihr Einkommen drastisch sinken. Diese Versicherung garantiert Ihnen eine Zusatzrente.</p><h3>Deckung</h3><ul><li>Rente bis 80% des Einkommens</li><li>Auszahlung ab 1 Monat Unfähigkeit</li><li>Deckung Krankheit und Unfall</li><li>Leistungen bis zur Rente</li></ul><p>Anpassung an 2. Säule, modulierbarer Selbstbehalt, automatische Rentenerhöhung</p>', 'en' => '<h2>Secure your income</h2><p>In case of incapacity for work, your income can drop drastically. This insurance guarantees you a supplementary pension.</p><h3>Coverage</h3><ul><li>Pension up to 80% of income</li><li>Payment from 1 month of incapacity</li><li>Illness and accident coverage</li><li>Benefits until retirement</li></ul><p>Adaptation to 2nd pillar, modular deductible, automatic pension increase</p>', 'es' => '<h2>Asegure sus ingresos</h2><p>En caso de incapacidad laboral, sus ingresos pueden caer drásticamente. Este seguro le garantiza una renta complementaria.</p><h3>Cobertura</h3><ul><li>Renta hasta 80% de los ingresos</li><li>Pago desde 1 mes de incapacidad</li><li>Cobertura enfermedad y accidente</li><li>Prestaciones hasta jubilación</li></ul><p>Adaptación al 2º pilar, franquicia modulable, aumento automático de rentas</p>'],
                'features' => ['fr' => ['Jusqu\'à 80%', 'Maladie + accident', 'Versement rapide', 'Longue durée'], 'de' => ['Bis 80%', 'Krankheit + Unfall', 'Schnelle Auszahlung', 'Langfristig'], 'en' => ['Up to 80%', 'Illness + accident', 'Fast payment', 'Long-term'], 'es' => ['Hasta 80%', 'Enfermedad + accidente', 'Pago rápido', 'Largo plazo']],
                'benefits' => ['fr' => ['Protection totale', 'Sérénité', 'Maintien niveau de vie', 'Couverture complète'], 'de' => ['Voller Schutz', 'Gelassenheit', 'Erhalt des Lebensstandards', 'Vollständige Deckung'], 'en' => ['Total protection', 'Peace of mind', 'Maintain living standard', 'Complete coverage'], 'es' => ['Protección total', 'Serenidad', 'Mantener nivel de vida', 'Cobertura completa']],
            ],
            [
                'slug' => 'rente-viagere',
                'category' => 'Prévoyance',
                'segment' => 'privat',
                'icon' => 'heroicon-o-banknotes',
                'order' => 34,
                'title' => ['fr' => 'Rente Viagère', 'de' => 'Leibrente', 'en' => 'Life Annuity', 'es' => 'Renta Vitalicia'],
                'description' => ['fr' => 'Transformez votre capital en rente à vie. Revenu garanti jusqu\'au décès, sécurité maximale.', 'de' => 'Wandeln Sie Ihr Kapital in eine lebenslange Rente um. Garantiertes Einkommen bis zum Tod, maximale Sicherheit.', 'en' => 'Transform your capital into lifelong pension. Guaranteed income until death, maximum security.', 'es' => 'Transforme su capital en renta vitalicia. Ingreso garantizado hasta el fallecimiento, máxima seguridad.'],
                'content' => ['fr' => '<h2>Un revenu pour la vie</h2><p>La rente viagère vous garantit un revenu régulier et sûr jusqu\'à la fin de vos jours, quels que soient les aléas des marchés.</p><h3>Types de rentes</h3><ul><li>Rente simple: revenu maximum</li><li>Rente réversible: protection du conjoint</li><li>Rente avec restitution: garantie pour héritiers</li></ul><h3>Taux actuels</h3><p>65 ans: 5.8% (homme), 5.2% (femme). Capital minimum CHF 50\'000, rente indexée possible</p>', 'de' => '<h2>Ein Einkommen fürs Leben</h2><p>Die Leibrente garantiert Ihnen ein regelmäßiges und sicheres Einkommen bis zum Lebensende, unabhängig von Marktschwankungen.</p><h3>Rententypen</h3><ul><li>Einfache Rente: maximales Einkommen</li><li>Reversible Rente: Partnerschutz</li><li>Rente mit Rückgewähr: Garantie für Erben</li></ul><h3>Aktuelle Sätze</h3><p>65 Jahre: 5.8% (Mann), 5.2% (Frau). Mindestkapital CHF 50\'000, indexierte Rente möglich</p>', 'en' => '<h2>An income for life</h2><p>Life annuity guarantees you regular and secure income until the end of your days, regardless of market fluctuations.</p><h3>Annuity types</h3><ul><li>Simple annuity: maximum income</li><li>Reversible annuity: spouse protection</li><li>Annuity with restitution: guarantee for heirs</li></ul><h3>Current rates</h3><p>65 years: 5.8% (man), 5.2% (woman). Minimum capital CHF 50,000, indexed annuity possible</p>', 'es' => '<h2>Un ingreso de por vida</h2><p>La renta vitalicia le garantiza un ingreso regular y seguro hasta el final de sus días, independientemente de las fluctuaciones del mercado.</p><h3>Tipos de rentas</h3><ul><li>Renta simple: ingreso máximo</li><li>Renta reversible: protección cónyuge</li><li>Renta con restitución: garantía para herederos</li></ul><h3>Tipos actuales</h3><p>65 años: 5.8% (hombre), 5.2% (mujer). Capital mínimo CHF 50.000, renta indexada posible</p>'],
                'features' => ['fr' => ['Revenu à vie', 'Taux attractif', 'Réversible', 'Sécurité totale'], 'de' => ['Lebenslänglich', 'Attraktiver Satz', 'Reversibel', 'Volle Sicherheit'], 'en' => ['Lifelong income', 'Attractive rate', 'Reversible', 'Total security'], 'es' => ['Ingreso vitalicio', 'Tipo atractivo', 'Reversible', 'Seguridad total']],
                'benefits' => ['fr' => ['Sérénité', 'Planification', 'Protection', 'Simplicité'], 'de' => ['Gelassenheit', 'Planung', 'Schutz', 'Einfachheit'], 'en' => ['Peace of mind', 'Planning', 'Protection', 'Simplicity'], 'es' => ['Serenidad', 'Planificación', 'Protección', 'Simplicidad']],
            ],
            [
                'slug' => 'conseil-prevoyance',
                'category' => 'Prévoyance',
                'segment' => 'privat',
                'icon' => 'heroicon-o-academic-cap',
                'order' => 35,
                'title' => ['fr' => 'Conseil en Prévoyance', 'de' => 'Vorsorgeberatung', 'en' => 'Pension Advice', 'es' => 'Asesoramiento en Previsión'],
                'description' => ['fr' => 'Analyse complète de votre situation. Plan de prévoyance sur mesure. Optimisation fiscale.', 'de' => 'Vollständige Analyse Ihrer Situation. Maßgeschneiderter Vorsorgeplan. Steueroptimierung.', 'en' => 'Complete analysis of your situation. Customized pension plan. Tax optimization.', 'es' => 'Análisis completo de su situación. Plan de previsión a medida. Optimización fiscal.'],
                'content' => ['fr' => '<h2>Votre stratégie de prévoyance</h2><p>Nos experts analysent votre situation globale et élaborent une stratégie de prévoyance optimale sur les 3 piliers.</p><h3>Notre méthode</h3><ul><li>Bilan de prévoyance complet</li><li>Identification des lacunes</li><li>Projection retraite personnalisée</li><li>Solutions d\'optimisation fiscale</li><li>Plan d\'action sur mesure</li></ul><p>Premier rendez-vous gratuit, suivi régulier, adaptation aux changements de vie</p>', 'de' => '<h2>Ihre Vorsorgestrategie</h2><p>Unsere Experten analysieren Ihre Gesamtsituation und entwickeln eine optimale Vorsorgestrategie über die 3 Säulen.</p><h3>Unsere Methode</h3><ul><li>Vollständige Vorsorgbilanz</li><li>Identifikation von Lücken</li><li>Personalisierte Ruhestandsprojektion</li><li>Steueroptimierungslösungen</li><li>Maßgeschneiderter Aktionsplan</li></ul><p>Erster Termin kostenlos, regelmäßige Nachverfolgung, Anpassung an Lebensveränderungen</p>', 'en' => '<h2>Your pension strategy</h2><p>Our experts analyze your overall situation and develop an optimal pension strategy across the 3 pillars.</p><h3>Our method</h3><ul><li>Complete pension assessment</li><li>Gap identification</li><li>Personalized retirement projection</li><li>Tax optimization solutions</li><li>Customized action plan</li></ul><p>First appointment free, regular follow-up, adaptation to life changes</p>', 'es' => '<h2>Su estrategia de previsión</h2><p>Nuestros expertos analizan su situación global y elaboran una estrategia de previsión óptima sobre los 3 pilares.</p><h3>Nuestro método</h3><ul><li>Balance de previsión completo</li><li>Identificación de lagunas</li><li>Proyección de jubilación personalizada</li><li>Soluciones de optimización fiscal</li><li>Plan de acción a medida</li></ul><p>Primera cita gratuita, seguimiento regular, adaptación a cambios de vida</p>'],
                'features' => ['fr' => ['Analyse 360°', 'Conseil expert', 'Premier RDV gratuit', 'Suivi personnalisé'], 'de' => ['360°-Analyse', 'Expertenberatung', 'Erster Termin gratis', 'Persönliche Betreuung'], 'en' => ['360° analysis', 'Expert advice', 'First meeting free', 'Personalized follow-up'], 'es' => ['Análisis 360°', 'Asesoramiento experto', 'Primera cita gratis', 'Seguimiento personalizado']],
                'benefits' => ['fr' => ['Vision claire', 'Optimisation', 'Sérénité', 'Expertise'], 'de' => ['Klare Vision', 'Optimierung', 'Gelassenheit', 'Expertise'], 'en' => ['Clear vision', 'Optimization', 'Peace of mind', 'Expertise'], 'es' => ['Visión clara', 'Optimización', 'Serenidad', 'Experiencia']],
            ],

            // CATÉGORIE 5: SERVICES DIGITAUX (5 services)
            [
                'slug' => 'e-banking',
                'category' => 'Services Digitaux',
                'segment' => 'privat',
                'icon' => 'heroicon-o-device-phone-mobile',
                'order' => 40,
                'title' => ['fr' => 'E-Banking', 'de' => 'E-Banking', 'en' => 'E-Banking', 'es' => 'Banca Electrónica'],
                'description' => ['fr' => 'Banque en ligne 24/7. Paiements, virements, gestion de comptes depuis n\'importe où.', 'de' => 'Online-Banking 24/7. Zahlungen, Überweisungen, Kontoverwaltung von überall.', 'en' => 'Online banking 24/7. Payments, transfers, account management from anywhere.', 'es' => 'Banca online 24/7. Pagos, transferencias, gestión de cuentas desde cualquier lugar.'],
                'content' => ['fr' => '<h2>Votre banque dans la poche</h2><p>L\'e-banking Acrevis vous donne un accès complet à vos comptes 24h/24, 7j/7, depuis n\'importe quel appareil.</p><h3>Fonctionnalités</h3><ul><li>Consultation comptes et cartes</li><li>Virements Suisse et internationaux</li><li>Paiements de factures QR</li><li>Gestion des standing orders</li><li>Export PDF et comptable</li><li>Authentification forte biométrique</li></ul><h3>Applications</h3><p>Web responsive, iOS et Android, synchronisation temps réel, mode hors ligne disponible</p>', 'de' => '<h2>Ihre Bank in der Tasche</h2><p>Das Acrevis E-Banking gibt Ihnen 24/7 vollen Zugang zu Ihren Konten von jedem Gerät aus.</p><h3>Funktionen</h3><ul><li>Konten- und Karteneinsicht</li><li>Schweizer und internationale Überweisungen</li><li>QR-Rechnungszahlungen</li><li>Dauerauftragsverwaltung</li><li>PDF- und Buchhaltungsexport</li><li>Biometrische Starke Authentifizierung</li></ul><h3>Anwendungen</h3><p>Responsive Web, iOS und Android, Echtzeitynchronisation, Offline-Modus verfügbar</p>', 'en' => '<h2>Your bank in your pocket</h2><p>Acrevis e-banking gives you 24/7 full access to your accounts from any device.</p><h3>Features</h3><ul><li>Account and card viewing</li><li>Swiss and international transfers</li><li>QR bill payments</li><li>Standing order management</li><li>PDF and accounting export</li><li>Biometric strong authentication</li></ul><h3>Applications</h3><p>Responsive web, iOS and Android, real-time sync, offline mode available</p>', 'es' => '<h2>Su banco en el bolsillo</h2><p>La banca electrónica Acrevis le da acceso completo 24/7 a sus cuentas desde cualquier dispositivo.</p><h3>Funcionalidades</h3><ul><li>Consulta de cuentas y tarjetas</li><li>Transferencias suizas e internacionales</li><li>Pagos de facturas QR</li><li>Gestión de órdenes permanentes</li><li>Exportación PDF y contable</li><li>Autenticación fuerte biométrica</li></ul><h3>Aplicaciones</h3><p>Web responsive, iOS y Android, sincronización tiempo real, modo sin conexión disponible</p>'],
                'features' => ['fr' => ['24/7', 'Multi-appareils', 'Sécurisé', 'Intuitif'], 'de' => ['24/7', 'Multi-Geräte', 'Sicher', 'Intuitiv'], 'en' => ['24/7', 'Multi-device', 'Secure', 'Intuitive'], 'es' => ['24/7', 'Multi-dispositivo', 'Seguro', 'Intuitivo']],
                'benefits' => ['fr' => ['Liberté totale', 'Gain de temps', 'Contrôle complet', 'Toujours disponible'], 'de' => ['Volle Freiheit', 'Zeitersparnis', 'Volle Kontrolle', 'Immer verfügbar'], 'en' => ['Total freedom', 'Time saving', 'Full control', 'Always available'], 'es' => ['Libertad total', 'Ahorro de tiempo', 'Control completo', 'Siempre disponible']],
            ],
            [
                'slug' => 'mobile-banking',
                'category' => 'Services Digitaux',
                'segment' => 'privat',
                'icon' => 'heroicon-o-device-phone-mobile',
                'order' => 41,
                'title' => ['fr' => 'Mobile Banking', 'de' => 'Mobile Banking', 'en' => 'Mobile Banking', 'es' => 'Banca Móvil'],
                'description' => ['fr' => 'Application mobile complète. Paiement sans contact, scan QR, notifications instantanées.', 'de' => 'Vollständige Mobile App. Kontaktloses Bezahlen, QR-Scan, Sofortbenachrichtigungen.', 'en' => 'Complete mobile app. Contactless payment, QR scan, instant notifications.', 'es' => 'Aplicación móvil completa. Pago sin contacto, escaneo QR, notificaciones instantáneas.'],
                'content' => ['fr' => '<h2>La banque au bout des doigts</h2><p>L\'application mobile Acrevis transforme votre smartphone en succursale bancaire portable.</p><h3>Fonctionnalités exclusives</h3><ul><li>Paiement QR-Bill par scan</li><li>Virement par photo contact</li><li>Blocage carte instantané</li><li>Notifications push personnalisables</li><li>Touch ID / Face ID</li><li>Géolocalisation ATM</li></ul><h3>Innovation</h3><p>Assistant virtuel IA, budget tracker intégré, agrégation multi-banques</p>', 'de' => '<h2>Die Bank in der Handfläche</h2><p>Die mobile Acrevis App verwandelt Ihr Smartphone in eine tragbare Bankfiliale.</p><h3>Exklusive Funktionen</h3><ul><li>QR-Bill-Zahlung per Scan</li><li>Überweisung per Kontaktfoto</li><li>Sofortige Kartensperre</li><li>Anpassbare Push-Benachrichtigungen</li><li>Touch ID / Face ID</li><li>ATM-Geolokalisierung</li></ul><h3>Innovation</h3><p>KI-Virtueller Assistent, integrierter Budget-Tracker, Multi-Banken-Aggregation</p>', 'en' => '<h2>Banking at your fingertips</h2><p>The Acrevis mobile app transforms your smartphone into a portable bank branch.</p><h3>Exclusive features</h3><ul><li>QR-Bill payment by scan</li><li>Transfer by contact photo</li><li>Instant card block</li><li>Customizable push notifications</li><li>Touch ID / Face ID</li><li>ATM geolocation</li></ul><h3>Innovation</h3><p>AI virtual assistant, integrated budget tracker, multi-bank aggregation</p>', 'es' => '<h2>Banca al alcance de la mano</h2><p>La aplicación móvil Acrevis transforma su smartphone en una sucursal bancaria portátil.</p><h3>Funcionalidades exclusivas</h3><ul><li>Pago QR-Bill por escaneo</li><li>Transferencia por foto de contacto</li><li>Bloqueo de tarjeta instantáneo</li><li>Notificaciones push personalizables</li><li>Touch ID / Face ID</li><li>Geolocalización ATM</li></ul><h3>Innovación</h3><p>Asistente virtual IA, rastreador de presupuesto integrado, agregación multi-bancos</p>'],
                'features' => ['fr' => ['Scan QR', 'Biométrie', 'Notifications', 'IA intégrée'], 'de' => ['QR-Scan', 'Biometrie', 'Benachrichtigungen', 'Integrierte KI'], 'en' => ['QR scan', 'Biometry', 'Notifications', 'Integrated AI'], 'es' => ['Escaneo QR', 'Biometría', 'Notificaciones', 'IA integrada']],
                'benefits' => ['fr' => ['Ultra rapide', 'Sécurité maximale', 'Innovant', 'Simple'], 'de' => ['Ultra schnell', 'Maximale Sicherheit', 'Innovativ', 'Einfach'], 'en' => ['Ultra fast', 'Maximum security', 'Innovative', 'Simple'], 'es' => ['Ultra rápido', 'Máxima seguridad', 'Innovador', 'Simple']],
            ],
            [
                'slug' => 'carte-virtuelle',
                'category' => 'Services Digitaux',
                'segment' => 'privat',
                'icon' => 'heroicon-o-credit-card',
                'order' => 42,
                'title' => ['fr' => 'Cartes Virtuelles', 'de' => 'Virtuelle Karten', 'en' => 'Virtual Cards', 'es' => 'Tarjetas Virtuales'],
                'description' => ['fr' => 'Créez des cartes virtuelles instantanément. Sécurisez vos achats en ligne, contrôle total.', 'de' => 'Erstellen Sie virtuelle Karten sofort. Sichern Sie Ihre Online-Einkäufe, volle Kontrolle.', 'en' => 'Create virtual cards instantly. Secure your online purchases, full control.', 'es' => 'Cree tarjetas virtuales instantáneamente. Asegure sus compras online, control total.'],
                'content' => ['fr' => '<h2>Shopping en ligne sécurisé</h2><p>Créez des cartes virtuelles jetables ou permanentes pour sécuriser tous vos achats en ligne.</p><h3>Fonctionnalités</h3><ul><li>Création instantanée depuis l\'app</li><li>Limite de montant personnalisable</li><li>Validité temporaire (1 heure à 12 mois)</li><li>Usage unique ou récurrent</li><li>Blocage instantané</li></ul><h3>Sécurité</h3><p>Numéro différent de votre carte physique, 3D Secure, alertes en temps réel, aucun risque de clonage</p>', 'de' => '<h2>Sicheres Online-Shopping</h2><p>Erstellen Sie Einweg- oder permanente virtuelle Karten zur Sicherung aller Ihrer Online-Einkäufe.</p><h3>Funktionen</h3><ul><li>Soforterstellung aus der App</li><li>Anpassbares Betragslimit</li><li>Zeitliche Gültigkeit (1 Stunde bis 12 Monate)</li><li>Einmal- oder wiederkehrende Nutzung</li><li>Sofortige Sperrung</li></ul><h3>Sicherheit</h3><p>Nummer unterschiedlich von Ihrer physischen Karte, 3D Secure, Echtzeitwarnungen, kein Klonrisiko</p>', 'en' => '<h2>Secure online shopping</h2><p>Create disposable or permanent virtual cards to secure all your online purchases.</p><h3>Features</h3><ul><li>Instant creation from app</li><li>Customizable amount limit</li><li>Temporary validity (1 hour to 12 months)</li><li>Single or recurring use</li><li>Instant blocking</li></ul><h3>Security</h3><p>Number different from your physical card, 3D Secure, real-time alerts, no cloning risk</p>', 'es' => '<h2>Compras online seguras</h2><p>Cree tarjetas virtuales desechables o permanentes para asegurar todas sus compras online.</p><h3>Funcionalidades</h3><ul><li>Creación instantánea desde la app</li><li>Límite de monto personalizable</li><li>Validez temporal (1 hora a 12 meses)</li><li>Uso único o recurrente</li><li>Bloqueo instantáneo</li></ul><h3>Seguridad</h3><p>Número diferente de su tarjeta física, 3D Secure, alertas en tiempo real, sin riesgo de clonación</p>'],
                'features' => ['fr' => ['Création instantanée', 'Jetable ou permanente', 'Limites custom', 'Zéro fraude'], 'de' => ['Soforterstellung', 'Einweg oder permanent', 'Custom-Limits', 'Null Betrug'], 'en' => ['Instant creation', 'Disposable or permanent', 'Custom limits', 'Zero fraud'], 'es' => ['Creación instantánea', 'Desechable o permanente', 'Límites personalizados', 'Cero fraude']],
                'benefits' => ['fr' => ['Sécurité maximale', 'Protection totale', 'Contrôle absolu', 'Tranquillité'], 'de' => ['Maximale Sicherheit', 'Voller Schutz', 'Absolute Kontrolle', 'Seelenfrieden'], 'en' => ['Maximum security', 'Total protection', 'Absolute control', 'Peace of mind'], 'es' => ['Máxima seguridad', 'Protección total', 'Control absoluto', 'Tranquilidad']],
            ],
            [
                'slug' => 'apple-google-pay',
                'category' => 'Services Digitaux',
                'segment' => 'privat',
                'icon' => 'heroicon-o-device-phone-mobile',
                'order' => 43,
                'title' => ['fr' => 'Apple Pay & Google Pay', 'de' => 'Apple Pay & Google Pay', 'en' => 'Apple Pay & Google Pay', 'es' => 'Apple Pay y Google Pay'],
                'description' => ['fr' => 'Paiement mobile sans contact. Activez vos cartes en un clic. Rapide, sûr, pratique.', 'de' => 'Kontaktlose Mobilzahlung. Aktivieren Sie Ihre Karten mit einem Klick. Schnell, sicher, praktisch.', 'en' => 'Contactless mobile payment. Activate your cards with one click. Fast, safe, convenient.', 'es' => 'Pago móvil sin contacto. Active sus tarjetas con un clic. Rápido, seguro, práctico.'],
                'content' => ['fr' => '<h2>Payez sans sortir votre carte</h2><p>Ajoutez toutes vos cartes Acrevis à Apple Pay et Google Pay pour des paiements ultra-rapides et sécurisés.</p><h3>Avantages</h3><ul><li>Paiement en 1 seconde</li><li>Authentification biométrique</li><li>Fonctionne même sans réseau</li><li>Accepté mondialement</li><li>Historique dans l\'app</li></ul><h3>Sécurité</h3><p>Numéro de carte tokenisé, aucune donnée stockée sur le téléphone, validation biométrique obligatoire</p>', 'de' => '<h2>Bezahlen ohne Karte</h2><p>Fügen Sie alle Ihre Acrevis-Karten zu Apple Pay und Google Pay für ultraschnelle und sichere Zahlungen hinzu.</p><h3>Vorteile</h3><ul><li>Zahlung in 1 Sekunde</li><li>Biometrische Authentifizierung</li><li>Funktioniert auch ohne Netzwerk</li><li>Weltweit akzeptiert</li><li>Verlauf in der App</li></ul><h3>Sicherheit</h3><p>Tokenisierte Kartennummer, keine Daten auf dem Telefon gespeichert, biometrische Validierung erforderlich</p>', 'en' => '<h2>Pay without your card</h2><p>Add all your Acrevis cards to Apple Pay and Google Pay for ultra-fast and secure payments.</p><h3>Benefits</h3><ul><li>Payment in 1 second</li><li>Biometric authentication</li><li>Works even without network</li><li>Accepted worldwide</li><li>History in app</li></ul><h3>Security</h3><p>Tokenized card number, no data stored on phone, biometric validation required</p>', 'es' => '<h2>Pague sin su tarjeta</h2><p>Agregue todas sus tarjetas Acrevis a Apple Pay y Google Pay para pagos ultra rápidos y seguros.</p><h3>Ventajas</h3><ul><li>Pago en 1 segundo</li><li>Autenticación biométrica</li><li>Funciona incluso sin red</li><li>Aceptado mundialmente</li><li>Historial en la app</li></ul><h3>Seguridad</h3><p>Número de tarjeta tokenizado, sin datos almacenados en el teléfono, validación biométrica obligatoria</p>'],
                'features' => ['fr' => ['Ultra rapide', 'Sans contact', 'Biométrique', 'Mondial'], 'de' => ['Ultra schnell', 'Kontaktlos', 'Biometrisch', 'Weltweit'], 'en' => ['Ultra fast', 'Contactless', 'Biometric', 'Worldwide'], 'es' => ['Ultra rápido', 'Sin contacto', 'Biométrico', 'Mundial']],
                'benefits' => ['fr' => ['Simplicité', 'Rapidité', 'Sécurité', 'Universel'], 'de' => ['Einfachheit', 'Geschwindigkeit', 'Sicherheit', 'Universal'], 'en' => ['Simplicity', 'Speed', 'Security', 'Universal'], 'es' => ['Simplicidad', 'Rapidez', 'Seguridad', 'Universal']],
            ],
            [
                'slug' => 'alertes-notifications',
                'category' => 'Services Digitaux',
                'segment' => 'privat',
                'icon' => 'heroicon-o-bell-alert',
                'order' => 44,
                'title' => ['fr' => 'Alertes & Notifications', 'de' => 'Warnungen & Benachrichtigungen', 'en' => 'Alerts & Notifications', 'es' => 'Alertas y Notificaciones'],
                'description' => ['fr' => 'Soyez informé en temps réel. Paramétrez vos alertes personnalisées. Contrôle total.', 'de' => 'Werden Sie in Echtzeit informiert. Konfigurieren Sie Ihre personalisierten Warnungen. Volle Kontrolle.', 'en' => 'Be informed in real time. Configure your personalized alerts. Full control.', 'es' => 'Esté informado en tiempo real. Configure sus alertas personalizadas. Control total.'],
                'content' => ['fr' => '<h2>Ne ratez rien</h2><p>Configurez des alertes personnalisées pour rester informé de toute l\'activité de vos comptes en temps réel.</p><h3>Types d\'alertes</h3><ul><li>Transactions: seuil montant, type opération</li><li>Solde: minimum/maximum</li><li>Paiements carte: pays, type commerçant</li><li>Virements: réception, exécution</li><li>Échéances: crédits, assurances</li></ul><h3>Canaux</h3><p>Push mobile, SMS, email, notification web. Horaires personnalisables, fréquence ajustable</p>', 'de' => '<h2>Verpassen Sie nichts</h2><p>Konfigurieren Sie personalisierte Warnungen, um über alle Aktivitäten Ihrer Konten in Echtzeit informiert zu bleiben.</p><h3>Warnungstypen</h3><ul><li>Transaktionen: Betragsschwelle, Operationstyp</li><li>Saldo: Minimum/Maximum</li><li>Kartenzahlungen: Land, Händlertyp</li><li>Überweisungen: Empfang, Ausführung</li><li>Fälligkeiten: Kredite, Versicherungen</li></ul><h3>Kanäle</h3><p>Mobile Push, SMS, E-Mail, Web-Benachrichtigung. Anpassbare Zeiten, einstellbare Häufigkeit</p>', 'en' => '<h2>Miss nothing</h2><p>Configure personalized alerts to stay informed of all your account activity in real time.</p><h3>Alert types</h3><ul><li>Transactions: amount threshold, operation type</li><li>Balance: minimum/maximum</li><li>Card payments: country, merchant type</li><li>Transfers: receipt, execution</li><li>Due dates: loans, insurance</li></ul><h3>Channels</h3><p>Mobile push, SMS, email, web notification. Customizable hours, adjustable frequency</p>', 'es' => '<h2>No se pierda nada</h2><p>Configure alertas personalizadas para mantenerse informado de toda la actividad de sus cuentas en tiempo real.</p><h3>Tipos de alertas</h3><ul><li>Transacciones: umbral de monto, tipo de operación</li><li>Saldo: mínimo/máximo</li><li>Pagos con tarjeta: país, tipo de comerciante</li><li>Transferencias: recepción, ejecución</li><li>Vencimientos: créditos, seguros</li></ul><h3>Canales</h3><p>Push móvil, SMS, email, notificación web. Horarios personalizables, frecuencia ajustable</p>'],
                'features' => ['fr' => ['Temps réel', 'Multi-canaux', 'Personnalisable', 'Intelligent'], 'de' => ['Echtzeit', 'Multi-Kanal', 'Anpassbar', 'Intelligent'], 'en' => ['Real-time', 'Multi-channel', 'Customizable', 'Intelligent'], 'es' => ['Tiempo real', 'Multi-canal', 'Personalizable', 'Inteligente']],
                'benefits' => ['fr' => ['Sérénité', 'Contrôle', 'Réactivité', 'Protection'], 'de' => ['Gelassenheit', 'Kontrolle', 'Reaktionsfähigkeit', 'Schutz'], 'en' => ['Peace of mind', 'Control', 'Reactivity', 'Protection'], 'es' => ['Serenidad', 'Control', 'Reactividad', 'Protección']],
            ],

            // CATÉGORIE 6: AUTRES SERVICES (8 services)
            [
                'slug' => 'coffre-fort',
                'category' => 'Autres Services',
                'segment' => 'privat',
                'icon' => 'heroicon-o-lock-closed',
                'order' => 50,
                'title' => ['fr' => 'Coffres-Forts', 'de' => 'Schliessfächer', 'en' => 'Safe Deposit Boxes', 'es' => 'Cajas Fuertes'],
                'description' => ['fr' => 'Protégez vos biens précieux. Sécurité maximale en Suisse. Différentes tailles disponibles.', 'de' => 'Schützen Sie Ihre Wertsachen. Maximale Sicherheit in der Schweiz. Verschiedene Größen verfügbar.', 'en' => 'Protect your valuables. Maximum security in Switzerland. Different sizes available.', 'es' => 'Proteja sus bienes valiosos. Máxima seguridad en Suiza. Diferentes tamaños disponibles.'],
                'content' => ['fr' => '<h2>Sécurité absolue</h2><p>Nos coffres-forts situés en Suisse offrent une protection optimale pour vos documents et objets de valeur.</p><h3>Tailles disponibles</h3><ul><li>S: CHF 150/an (documents)</li><li>M: CHF 250/an (documents + bijoux)</li><li>L: CHF 450/an (objets volumineux)</li><li>XL: CHF 800/an (collections)</li></ul><h3>Sécurité</h3><p>Bunker sécurisé, double authentification, vidéosurveillance 24/7, assurance incluse jusqu\'à CHF 100\'000</p>', 'de' => '<h2>Absolute Sicherheit</h2><p>Unsere in der Schweiz gelegenen Schliessfächer bieten optimalen Schutz für Ihre Dokumente und Wertgegenstände.</p><h3>Verfügbare Größen</h3><ul><li>S: CHF 150/Jahr (Dokumente)</li><li>M: CHF 250/Jahr (Dokumente + Schmuck)</li><li>L: CHF 450/Jahr (Sperrige Gegenstände)</li><li>XL: CHF 800/Jahr (Sammlungen)</li></ul><h3>Sicherheit</h3><p>Gesicherter Bunker, Zwei-Faktor-Authentifizierung, Videoüberwachung 24/7, Versicherung bis CHF 100\'000 inklusive</p>', 'en' => '<h2>Absolute security</h2><p>Our safe deposit boxes located in Switzerland offer optimal protection for your documents and valuables.</p><h3>Available sizes</h3><ul><li>S: CHF 150/year (documents)</li><li>M: CHF 250/year (documents + jewelry)</li><li>L: CHF 450/year (bulky items)</li><li>XL: CHF 800/year (collections)</li></ul><h3>Security</h3><p>Secured bunker, two-factor authentication, 24/7 video surveillance, insurance included up to CHF 100,000</p>', 'es' => '<h2>Seguridad absoluta</h2><p>Nuestras cajas fuertes ubicadas en Suiza ofrecen protección óptima para sus documentos y objetos de valor.</p><h3>Tamaños disponibles</h3><ul><li>S: CHF 150/año (documentos)</li><li>M: CHF 250/año (documentos + joyas)</li><li>L: CHF 450/año (objetos voluminosos)</li><li>XL: CHF 800/año (colecciones)</li></ul><h3>Seguridad</h3><p>Búnker asegurado, autenticación de dos factores, videovigilancia 24/7, seguro incluido hasta CHF 100.000</p>'],
                'features' => ['fr' => ['4 tailles', 'Accès 24/7', 'Assurance incluse', 'Bunker sécurisé'], 'de' => ['4 Größen', 'Zugang 24/7', 'Versicherung inklusive', 'Gesicherter Bunker'], 'en' => ['4 sizes', '24/7 access', 'Insurance included', 'Secured bunker'], 'es' => ['4 tamaños', 'Acceso 24/7', 'Seguro incluido', 'Búnker asegurado']],
                'benefits' => ['fr' => ['Protection maximale', 'Discrétion totale', 'Tranquillité', 'Suisse'], 'de' => ['Maximaler Schutz', 'Volle Diskretion', 'Seelenfrieden', 'Schweiz'], 'en' => ['Maximum protection', 'Total discretion', 'Peace of mind', 'Switzerland'], 'es' => ['Protección máxima', 'Discreción total', 'Tranquilidad', 'Suiza']],
            ],
            [
                'slug' => 'change-devises',
                'category' => 'Autres Services',
                'segment' => 'privat',
                'icon' => 'heroicon-o-currency-euro',
                'order' => 51,
                'title' => ['fr' => 'Change de Devises', 'de' => 'Devisenwechsel', 'en' => 'Currency Exchange', 'es' => 'Cambio de Divisas'],
                'description' => ['fr' => '50+ devises disponibles. Taux compétitifs, commande en ligne, retrait en agence.', 'de' => '50+ Währungen verfügbar. Wettbewerbsfähige Kurse, Online-Bestellung, Abholung in Filiale.', 'en' => '50+ currencies available. Competitive rates, online order, branch pickup.', 'es' => '50+ divisas disponibles. Tipos competitivos, pedido online, retirada en sucursal.'],
                'content' => ['fr' => '<h2>Tous vos besoins en devises</h2><p>Commandez vos devises en ligne et retirez-les en agence, ou profitez de notre service de livraison sécurisée à domicile.</p><h3>Devises principales</h3><ul><li>EUR, USD, GBP: commission 0.5%</li><li>JPY, CAD, AUD: commission 0.8%</li><li>Devises exotiques: commission 1.5%</li></ul><h3>Services</h3><p>Commande en ligne 24h avant, garantie taux, livraison possible, rachat devises étrangères</p>', 'de' => '<h2>Alle Ihre Devisenbedürfnisse</h2><p>Bestellen Sie Ihre Devisen online und holen Sie sie in der Filiale ab, oder nutzen Sie unseren sicheren Heimlieferservice.</p><h3>Hauptwährungen</h3><ul><li>EUR, USD, GBP: Kommission 0.5%</li><li>JPY, CAD, AUD: Kommission 0.8%</li><li>Exotische Währungen: Kommission 1.5%</li></ul><h3>Services</h3><p>Online-Bestellung 24 Std. vorher, Kursgarantie, Lieferung möglich, Rückkauf ausländischer Währungen</p>', 'en' => '<h2>All your currency needs</h2><p>Order your currencies online and pick them up at the branch, or take advantage of our secure home delivery service.</p><h3>Main currencies</h3><ul><li>EUR, USD, GBP: 0.5% commission</li><li>JPY, CAD, AUD: 0.8% commission</li><li>Exotic currencies: 1.5% commission</li></ul><h3>Services</h3><p>Online order 24h before, rate guarantee, delivery possible, foreign currency buyback</p>', 'es' => '<h2>Todas sus necesidades de divisas</h2><p>Pida sus divisas online y retírelas en sucursal, o aproveche nuestro servicio de entrega segura a domicilio.</p><h3>Divisas principales</h3><ul><li>EUR, USD, GBP: comisión 0.5%</li><li>JPY, CAD, AUD: comisión 0.8%</li><li>Divisas exóticas: comisión 1.5%</li></ul><h3>Servicios</h3><p>Pedido online 24h antes, garantía de tipo, entrega posible, recompra de divisas extranjeras</p>'],
                'features' => ['fr' => ['50+ devises', 'Taux compétitifs', 'Commande en ligne', 'Livraison possible'], 'de' => ['50+ Währungen', 'Wettbewerbsfähige Kurse', 'Online-Bestellung', 'Lieferung möglich'], 'en' => ['50+ currencies', 'Competitive rates', 'Online order', 'Delivery possible'], 'es' => ['50+ divisas', 'Tipos competitivos', 'Pedido online', 'Entrega posible']],
                'benefits' => ['fr' => ['Simplicité', 'Rapidité', 'Sécurité', 'Transparence'], 'de' => ['Einfachheit', 'Geschwindigkeit', 'Sicherheit', 'Transparenz'], 'en' => ['Simplicity', 'Speed', 'Security', 'Transparency'], 'es' => ['Simplicidad', 'Rapidez', 'Seguridad', 'Transparencia']],
            ],
            [
                'slug' => 'cartes-prepayees',
                'category' => 'Autres Services',
                'segment' => 'privat',
                'icon' => 'heroicon-o-gift',
                'order' => 52,
                'title' => ['fr' => 'Cartes Prépayées', 'de' => 'Prepaid-Karten', 'en' => 'Prepaid Cards', 'es' => 'Tarjetas Prepagadas'],
                'description' => ['fr' => 'Cartes rechargeables sans compte bancaire. Idéal pour cadeaux, ados, voyages, budget.', 'de' => 'Aufladbare Karten ohne Bankkonto. Ideal für Geschenke, Jugendliche, Reisen, Budget.', 'en' => 'Rechargeable cards without bank account. Ideal for gifts, teens, travel, budget.', 'es' => 'Tarjetas recargables sin cuenta bancaria. Ideal para regalos, adolescentes, viajes, presupuesto.'],
                'content' => ['fr' => '<h2>La liberté sans compte</h2><p>Les cartes prépayées Acrevis offrent tous les avantages d\'une carte bancaire sans besoin d\'ouvrir un compte.</p><h3>Utilisations</h3><ul><li>Cadeau original et pratique</li><li>Ados: contrôle parental</li><li>Voyages: budget maîtrisé</li><li>Achats en ligne sécurisés</li></ul><h3>Fonctionnement</h3><p>Chargement de CHF 50 à 5\'000, rechargeable, acceptée partout, app de gestion, blocage instantané</p>', 'de' => '<h2>Freiheit ohne Konto</h2><p>Die Acrevis Prepaid-Karten bieten alle Vorteile einer Bankkarte ohne die Notwendigkeit, ein Konto zu eröffnen.</p><h3>Verwendungen</h3><ul><li>Originelles und praktisches Geschenk</li><li>Jugendliche: Elternkontrolle</li><li>Reisen: kontrolliertes Budget</li><li>Sichere Online-Einkäufe</li></ul><h3>Funktionsweise</h3><p>Aufladung von CHF 50 bis 5\'000, aufladbar, überall akzeptiert, Verwaltungs-App, sofortige Sperrung</p>', 'en' => '<h2>Freedom without account</h2><p>Acrevis prepaid cards offer all the advantages of a bank card without the need to open an account.</p><h3>Uses</h3><ul><li>Original and practical gift</li><li>Teens: parental control</li><li>Travel: controlled budget</li><li>Secure online purchases</li></ul><h3>How it works</h3><p>Loading from CHF 50 to 5,000, rechargeable, accepted everywhere, management app, instant blocking</p>', 'es' => '<h2>Libertad sin cuenta</h2><p>Las tarjetas prepagadas Acrevis ofrecen todas las ventajas de una tarjeta bancaria sin necesidad de abrir una cuenta.</p><h3>Usos</h3><ul><li>Regalo original y práctico</li><li>Adolescentes: control parental</li><li>Viajes: presupuesto controlado</li><li>Compras online seguras</li></ul><h3>Funcionamiento</h3><p>Carga de CHF 50 a 5.000, recargable, aceptada en todas partes, app de gestión, bloqueo instantáneo</p>'],
                'features' => ['fr' => ['Sans compte', 'Rechargeable', 'App dédiée', 'Mondiale'], 'de' => ['Ohne Konto', 'Aufladbar', 'Dedizierte App', 'Weltweit'], 'en' => ['No account', 'Rechargeable', 'Dedicated app', 'Worldwide'], 'es' => ['Sin cuenta', 'Recargable', 'App dedicada', 'Mundial']],
                'benefits' => ['fr' => ['Contrôle budget', 'Cadeau parfait', 'Zéro risque', 'Simplicité'], 'de' => ['Budgetkontrolle', 'Perfektes Geschenk', 'Null Risiko', 'Einfachheit'], 'en' => ['Budget control', 'Perfect gift', 'Zero risk', 'Simplicity'], 'es' => ['Control presupuesto', 'Regalo perfecto', 'Cero riesgo', 'Simplicidad']],
            ],
            [
                'slug' => 'conseil-patrimonial',
                'category' => 'Autres Services',
                'segment' => 'privat',
                'icon' => 'heroicon-o-light-bulb',
                'order' => 53,
                'title' => ['fr' => 'Conseil Patrimonial', 'de' => 'Vermögensberatung', 'en' => 'Wealth Advisory', 'es' => 'Asesoramiento Patrimonial'],
                'description' => ['fr' => 'Vision 360° de votre patrimoine. Stratégie personnalisée, optimisation fiscale, succession.', 'de' => '360°-Sicht auf Ihr Vermögen. Personalisierte Strategie, Steueroptimierung, Nachfolge.', 'en' => '360° view of your assets. Personalized strategy, tax optimization, succession.', 'es' => 'Visión 360° de su patrimonio. Estrategia personalizada, optimización fiscal, sucesión.'],
                'content' => ['fr' => '<h2>Votre patrimoine optimisé</h2><p>Nos conseillers patrimoniaux analysent votre situation globale et élaborent une stratégie sur mesure.</p><h3>Domaines couverts</h3><ul><li>Structuration patrimoniale</li><li>Optimisation fiscale suisse/internationale</li><li>Planification succession</li><li>Protection juridique</li><li>Prévoyance complète</li></ul><h3>Processus</h3><p>Bilan patrimonial, simulation fiscale, recommandations, mise en œuvre, suivi annuel</p>', 'de' => '<h2>Ihr optimiertes Vermögen</h2><p>Unsere Vermögensberater analysieren Ihre Gesamtsituation und entwickeln eine maßgeschneiderte Strategie.</p><h3>Abgedeckte Bereiche</h3><ul><li>Vermögensstrukturierung</li><li>Schweizer/internationale Steueroptimierung</li><li>Nachfolgeplanung</li><li>Rechtsschutz</li><li>Umfassende Vorsorge</li></ul><h3>Prozess</h3><p>Vermögensbilanz, Steuersimulation, Empfehlungen, Umsetzung, jährliche Nachverfolgung</p>', 'en' => '<h2>Your optimized wealth</h2><p>Our wealth advisors analyze your overall situation and develop a customized strategy.</p><h3>Covered areas</h3><ul><li>Wealth structuring</li><li>Swiss/international tax optimization</li><li>Succession planning</li><li>Legal protection</li><li>Comprehensive pension</li></ul><h3>Process</h3><p>Asset assessment, tax simulation, recommendations, implementation, annual follow-up</p>', 'es' => '<h2>Su patrimonio optimizado</h2><p>Nuestros asesores patrimoniales analizan su situación global y elaboran una estrategia a medida.</p><h3>Áreas cubiertas</h3><ul><li>Estructuración patrimonial</li><li>Optimización fiscal suiza/internacional</li><li>Planificación sucesión</li><li>Protección jurídica</li><li>Previsión completa</li></ul><h3>Proceso</h3><p>Balance patrimonial, simulación fiscal, recomendaciones, implementación, seguimiento anual</p>'],
                'features' => ['fr' => ['Analyse 360°', 'Fiscalité internationale', 'Succession', 'Suivi annuel'], 'de' => ['360°-Analyse', 'Internationale Besteuerung', 'Nachfolge', 'Jährliche Nachverfolgung'], 'en' => ['360° analysis', 'International tax', 'Succession', 'Annual follow-up'], 'es' => ['Análisis 360°', 'Fiscalidad internacional', 'Sucesión', 'Seguimiento anual']],
                'benefits' => ['fr' => ['Vision globale', 'Optimisation', 'Sérénité', 'Expertise pointue'], 'de' => ['Globale Sicht', 'Optimierung', 'Gelassenheit', 'Hohe Expertise'], 'en' => ['Global vision', 'Optimization', 'Peace of mind', 'High expertise'], 'es' => ['Visión global', 'Optimización', 'Serenidad', 'Alta experiencia']],
            ],
            [
                'slug' => 'succession-heritage',
                'category' => 'Autres Services',
                'segment' => 'privat',
                'icon' => 'heroicon-o-document-text',
                'order' => 54,
                'title' => ['fr' => 'Planification Successorale', 'de' => 'Nachlassplanung', 'en' => 'Estate Planning', 'es' => 'Planificación Sucesoria'],
                'description' => ['fr' => 'Organisez la transmission de votre patrimoine. Testament, pacte successoral, optimisation.', 'de' => 'Organisieren Sie die Übertragung Ihres Vermögens. Testament, Erbvertrag, Optimierung.', 'en' => 'Organize the transfer of your assets. Will, inheritance pact, optimization.', 'es' => 'Organice la transmisión de su patrimonio. Testamento, pacto sucesorio, optimización.'],
                'content' => ['fr' => '<h2>Protégez vos proches</h2><p>Une planification successorale bien pensée assure que votre patrimoine soit transmis selon vos volontés.</p><h3>Nos services</h3><ul><li>Rédaction testament</li><li>Pacte successoral</li><li>Mandat pour cause d\'inaptitude</li><li>Optimisation fiscale succession</li><li>Trust et fondations</li></ul><h3>Accompagnement</h3><p>Analyse situation familiale, simulation partages, conseils juridiques, mise en œuvre, conservation documents</p>', 'de' => '<h2>Schützen Sie Ihre Angehörigen</h2><p>Eine gut durchdachte Nachlassplanung stellt sicher, dass Ihr Vermögen nach Ihren Wünschen übertragen wird.</p><h3>Unsere Dienstleistungen</h3><ul><li>Testamentserstellung</li><li>Erbvertrag</li><li>Vorsorgeauftrag</li><li>Steueroptimierung Nachlass</li><li>Trusts und Stiftungen</li></ul><h3>Begleitung</h3><p>Analyse Familiensituation, Teilungssimulation, Rechtsberatung, Umsetzung, Dokumentenaufbewahrung</p>', 'en' => '<h2>Protect your loved ones</h2><p>Well-thought estate planning ensures your wealth is transferred according to your wishes.</p><h3>Our services</h3><ul><li>Will drafting</li><li>Inheritance pact</li><li>Power of attorney for incapacity</li><li>Estate tax optimization</li><li>Trusts and foundations</li></ul><h3>Support</h3><p>Family situation analysis, sharing simulation, legal advice, implementation, document conservation</p>', 'es' => '<h2>Proteja a sus seres queridos</h2><p>Una planificación sucesoria bien pensada asegura que su patrimonio se transmita según sus deseos.</p><h3>Nuestros servicios</h3><ul><li>Redacción testamento</li><li>Pacto sucesorio</li><li>Mandato por incapacidad</li><li>Optimización fiscal sucesión</li><li>Trusts y fundaciones</li></ul><h3>Acompañamiento</h3><p>Análisis situación familiar, simulación reparto, asesoramiento jurídico, implementación, conservación documentos</p>'],
                'features' => ['fr' => ['Testament', 'Optimisation fiscale', 'Conseil juridique', 'Discrétion'], 'de' => ['Testament', 'Steueroptimierung', 'Rechtsberatung', 'Diskretion'], 'en' => ['Will', 'Tax optimization', 'Legal advice', 'Discretion'], 'es' => ['Testamento', 'Optimización fiscal', 'Asesoramiento jurídico', 'Discreción']],
                'benefits' => ['fr' => ['Protection famille', 'Volontés respectées', 'Fiscalité optimale', 'Sérénité'], 'de' => ['Familienschutz', 'Respektierte Wünsche', 'Optimale Besteuerung', 'Seelenfrieden'], 'en' => ['Family protection', 'Respected wishes', 'Optimal taxation', 'Peace of mind'], 'es' => ['Protección familiar', 'Deseos respetados', 'Fiscalidad óptima', 'Serenidad']],
            ],
            [
                'slug' => 'domiciliation-courrier',
                'category' => 'Autres Services',
                'segment' => 'privat',
                'icon' => 'heroicon-o-envelope',
                'order' => 55,
                'title' => ['fr' => 'Domiciliation & Courrier', 'de' => 'Domizilierung & Post', 'en' => 'Domiciliation & Mail', 'es' => 'Domiciliación y Correo'],
                'description' => ['fr' => 'Adresse prestigieuse suisse. Réception courrier, scan, envoi. Idéal expatriés et nomades.', 'de' => 'Prestigeträchtige Schweizer Adresse. Postempfang, Scannen, Versand. Ideal für Expats und Nomaden.', 'en' => 'Prestigious Swiss address. Mail reception, scanning, forwarding. Ideal for expats and nomads.', 'es' => 'Dirección prestigiosa suiza. Recepción correo, escaneo, envío. Ideal para expatriados y nómadas.'],
                'content' => ['fr' => '<h2>Votre adresse en Suisse</h2><p>Le service de domiciliation vous permet d\'avoir une adresse prestigieuse en Suisse, même si vous vivez à l\'étranger.</p><h3>Services inclus</h3><ul><li>Adresse professionnelle en Suisse</li><li>Réception de tout courrier</li><li>Notification par email/SMS</li><li>Scan des documents importants</li><li>Réexpédition mondiale</li><li>Archivage sécurisé</li></ul><h3>Tarifs</h3><p>CHF 30/mois (formule basique), CHF 60/mois (formule pro avec scan illimité)</p>', 'de' => '<h2>Ihre Adresse in der Schweiz</h2><p>Der Domizilierungsservice ermöglicht es Ihnen, eine prestigeträchtige Adresse in der Schweiz zu haben, auch wenn Sie im Ausland leben.</p><h3>Inkludierte Services</h3><ul><li>Professionelle Adresse in der Schweiz</li><li>Empfang aller Post</li><li>Benachrichtigung per E-Mail/SMS</li><li>Scannen wichtiger Dokumente</li><li>Weltweite Nachsendung</li><li>Sichere Archivierung</li></ul><h3>Gebühren</h3><p>CHF 30/Monat (Basispaket), CHF 60/Monat (Profi-Paket mit unbegrenztem Scannen)</p>', 'en' => '<h2>Your address in Switzerland</h2><p>The domiciliation service allows you to have a prestigious address in Switzerland, even if you live abroad.</p><h3>Included services</h3><ul><li>Professional address in Switzerland</li><li>Reception of all mail</li><li>Notification by email/SMS</li><li>Scanning of important documents</li><li>Worldwide forwarding</li><li>Secure archiving</li></ul><h3>Fees</h3><p>CHF 30/month (basic plan), CHF 60/month (pro plan with unlimited scanning)</p>', 'es' => '<h2>Su dirección en Suiza</h2><p>El servicio de domiciliación le permite tener una dirección prestigiosa en Suiza, incluso si vive en el extranjero.</p><h3>Servicios incluidos</h3><ul><li>Dirección profesional en Suiza</li><li>Recepción de todo correo</li><li>Notificación por email/SMS</li><li>Escaneo de documentos importantes</li><li>Reenvío mundial</li><li>Archivado seguro</li></ul><h3>Tarifas</h3><p>CHF 30/mes (plan básico), CHF 60/mes (plan pro con escaneo ilimitado)</p>'],
                'features' => ['fr' => ['Adresse CH', 'Scan courrier', 'Réexpédition', 'Archivage'], 'de' => ['Adresse CH', 'Post-Scan', 'Nachsendung', 'Archivierung'], 'en' => ['CH address', 'Mail scan', 'Forwarding', 'Archiving'], 'es' => ['Dirección CH', 'Escaneo correo', 'Reenvío', 'Archivado']],
                'benefits' => ['fr' => ['Prestige', 'Flexibilité', 'Accessibilité', 'Professionnalisme'], 'de' => ['Prestige', 'Flexibilität', 'Zugänglichkeit', 'Professionalität'], 'en' => ['Prestige', 'Flexibility', 'Accessibility', 'Professionalism'], 'es' => ['Prestigio', 'Flexibilidad', 'Accesibilidad', 'Profesionalismo']],
            ],
            [
                'slug' => 'assurances-partenaires',
                'category' => 'Autres Services',
                'segment' => 'privat',
                'icon' => 'heroicon-o-shield-check',
                'order' => 56,
                'title' => ['fr' => 'Assurances Partenaires', 'de' => 'Partnerversicherungen', 'en' => 'Partner Insurance', 'es' => 'Seguros Asociados'],
                'description' => ['fr' => 'Toutes vos assurances en un lieu. Partenariats exclusifs, tarifs préférentiels, simplicité.', 'de' => 'Alle Ihre Versicherungen an einem Ort. Exklusive Partnerschaften, Vorzugspreise, Einfachheit.', 'en' => 'All your insurance in one place. Exclusive partnerships, preferential rates, simplicity.', 'es' => 'Todos sus seguros en un lugar. Colaboraciones exclusivas, tarifas preferenciales, simplicidad.'],
                'content' => ['fr' => '<h2>Toutes vos assurances</h2><p>Grâce à nos partenaires assureurs, profitez de tarifs préférentiels et d\'une gestion simplifiée de toutes vos assurances.</p><h3>Assurances disponibles</h3><ul><li>Assurance auto: -15% tarif</li><li>Assurance habitation: -10%</li><li>Assurance ménage: -12%</li><li>Assurance RC: -10%</li><li>Assurance voyage: -20%</li><li>Assurance santé complémentaire</li></ul><h3>Avantages</h3><p>Tarifs négociés, gestion centralisée, paiement regroupé, conseil personnalisé</p>', 'de' => '<h2>Alle Ihre Versicherungen</h2><p>Dank unserer Versicherungspartner profitieren Sie von Vorzugspreisen und vereinfachter Verwaltung all Ihrer Versicherungen.</p><h3>Verfügbare Versicherungen</h3><ul><li>Autoversicherung: -15% Tarif</li><li>Wohngebäudeversicherung: -10%</li><li>Hausratversicherung: -12%</li><li>Haftpflichtversicherung: -10%</li><li>Reiseversicherung: -20%</li><li>Zusatzkrankenversicherung</li></ul><h3>Vorteile</h3><p>Ausgehandelte Tarife, zentralisierte Verwaltung, gebündelte Zahlung, persönliche Beratung</p>', 'en' => '<h2>All your insurance</h2><p>Thanks to our insurance partners, benefit from preferential rates and simplified management of all your insurance.</p><h3>Available insurance</h3><ul><li>Auto insurance: -15% rate</li><li>Home insurance: -10%</li><li>Household insurance: -12%</li><li>Liability insurance: -10%</li><li>Travel insurance: -20%</li><li>Supplementary health insurance</li></ul><h3>Benefits</h3><p>Negotiated rates, centralized management, grouped payment, personalized advice</p>', 'es' => '<h2>Todos sus seguros</h2><p>Gracias a nuestros socios aseguradores, benefíciese de tarifas preferenciales y gestión simplificada de todos sus seguros.</p><h3>Seguros disponibles</h3><ul><li>Seguro auto: -15% tarifa</li><li>Seguro vivienda: -10%</li><li>Seguro hogar: -12%</li><li>Seguro RC: -10%</li><li>Seguro viaje: -20%</li><li>Seguro salud complementario</li></ul><h3>Ventajas</h3><p>Tarifas negociadas, gestión centralizada, pago agrupado, asesoramiento personalizado</p>'],
                'features' => ['fr' => ['Tarifs -20%', 'Gestion unique', 'Tous types', 'Conseil'], 'de' => ['Tarife -20%', 'Einheitliche Verwaltung', 'Alle Typen', 'Beratung'], 'en' => ['-20% rates', 'Single management', 'All types', 'Advice'], 'es' => ['Tarifas -20%', 'Gestión única', 'Todos tipos', 'Asesoramiento']],
                'benefits' => ['fr' => ['Économies', 'Simplicité', 'Tout-en-un', 'Expertise'], 'de' => ['Einsparungen', 'Einfachheit', 'Alles-in-einem', 'Expertise'], 'en' => ['Savings', 'Simplicity', 'All-in-one', 'Expertise'], 'es' => ['Ahorros', 'Simplicidad', 'Todo en uno', 'Experiencia']],
            ],
            [
                'slug' => 'concierge-bancaire',
                'category' => 'Autres Services',
                'segment' => 'privat',
                'icon' => 'heroicon-o-user-circle',
                'order' => 57,
                'title' => ['fr' => 'Conciergerie Bancaire', 'de' => 'Banking-Concierge', 'en' => 'Banking Concierge', 'es' => 'Conserjería Bancaria'],
                'description' => ['fr' => 'Service premium exclusif. Assistant personnel, privilèges, services sur mesure. Dès CHF 500K.', 'de' => 'Exklusiver Premium-Service. Persönlicher Assistent, Privilegien, maßgeschneiderte Services. Ab CHF 500K.', 'en' => 'Exclusive premium service. Personal assistant, privileges, customized services. From CHF 500K.', 'es' => 'Servicio premium exclusivo. Asistente personal, privilegios, servicios a medida. Desde CHF 500K.'],
                'content' => ['fr' => '<h2>L\'excellence à votre service</h2><p>La conciergerie bancaire Acrevis offre un service d\'exception aux clients patrimoniaux. Un conseiller dédié 24/7 pour tous vos besoins.</p><h3>Services</h3><ul><li>Conseiller privé dédié 24/7</li><li>Billetterie événements exclusifs</li><li>Réservations restaurants étoilés</li><li>Organisation voyages sur mesure</li><li>Accès salons aéroports premium</li><li>Services juridiques prioritaires</li></ul><h3>Accès</h3><p>Réservé aux clients avec patrimoine géré minimum CHF 500\'000</p>', 'de' => '<h2>Exzellenz zu Ihren Diensten</h2><p>Der Acrevis Banking-Concierge bietet vermögenden Kunden einen außergewöhnlichen Service. Ein dedizierter Berater 24/7 für alle Ihre Bedürfnisse.</p><h3>Services</h3><ul><li>Dedizierter Privatberater 24/7</li><li>Ticketing für exklusive Events</li><li>Reservierungen in Sternerestaurants</li><li>Organisation maßgeschneiderter Reisen</li><li>Zugang zu Premium-Flughafenlounges</li><li>Prioritäre Rechtsdienstleistungen</li></ul><h3>Zugang</h3><p>Reserviert für Kunden mit verwaltetem Vermögen mindestens CHF 500\'000</p>', 'en' => '<h2>Excellence at your service</h2><p>The Acrevis banking concierge offers exceptional service to wealth clients. A dedicated advisor 24/7 for all your needs.</p><h3>Services</h3><ul><li>Dedicated private advisor 24/7</li><li>Ticketing for exclusive events</li><li>Reservations at starred restaurants</li><li>Organization of tailor-made trips</li><li>Access to premium airport lounges</li><li>Priority legal services</li></ul><h3>Access</h3><p>Reserved for clients with managed assets minimum CHF 500,000</p>', 'es' => '<h2>Excelencia a su servicio</h2><p>La conserjería bancaria Acrevis ofrece un servicio excepcional a clientes patrimoniales. Un asesor dedicado 24/7 para todas sus necesidades.</p><h3>Servicios</h3><ul><li>Asesor privado dedicado 24/7</li><li>Boletos para eventos exclusivos</li><li>Reservas en restaurantes con estrellas</li><li>Organización de viajes a medida</li><li>Acceso a salas VIP de aeropuerto premium</li><li>Servicios jurídicos prioritarios</li></ul><h3>Acceso</h3><p>Reservado para clientes con patrimonio gestionado mínimo CHF 500.000</p>'],
                'features' => ['fr' => ['Conseiller 24/7', 'Événements VIP', 'Voyage sur mesure', 'Services exclusifs'], 'de' => ['Berater 24/7', 'VIP-Events', 'Maßgeschneiderte Reisen', 'Exklusive Services'], 'en' => ['Advisor 24/7', 'VIP events', 'Tailor-made travel', 'Exclusive services'], 'es' => ['Asesor 24/7', 'Eventos VIP', 'Viaje a medida', 'Servicios exclusivos']],
                'benefits' => ['fr' => ['Prestige', 'Gain de temps', 'Privilèges', 'Excellence'], 'de' => ['Prestige', 'Zeitersparnis', 'Privilegien', 'Exzellenz'], 'en' => ['Prestige', 'Time saving', 'Privileges', 'Excellence'], 'es' => ['Prestigio', 'Ahorro de tiempo', 'Privilegios', 'Excelencia']],
            ],

            // CATÉGORIE 7: ENTREPRISES (10 services pour segment business)
            [
                'slug' => 'compte-entreprise',
                'category' => 'Entreprises',
                'segment' => 'business',
                'icon' => 'heroicon-o-building-office',
                'order' => 60,
                'title' => ['fr' => 'Compte Entreprise', 'de' => 'Firmenkonto', 'en' => 'Business Account', 'es' => 'Cuenta Empresarial'],
                'description' => ['fr' => 'Compte professionnel adapté à votre activité. E-banking entreprise, cartes multiples, gestion trésorerie.', 'de' => 'Geschäftskonto angepasst an Ihre Tätigkeit. Firmen-E-Banking, mehrere Karten, Liquiditätsverwaltung.', 'en' => 'Professional account adapted to your activity. Business e-banking, multiple cards, cash management.', 'es' => 'Cuenta profesional adaptada a su actividad. E-banking empresarial, tarjetas múltiples, gestión tesorería.'],
                'content' => ['fr' => '<h2>Votre banque business</h2><p>Le compte entreprise Acrevis offre tous les outils nécessaires à la gestion financière de votre société.</p><h3>Services</h3><ul><li>Multi-devises (CHF, EUR, USD)</li><li>E-banking entreprise</li><li>Cartes employés illimitées</li><li>Gestion des autorisations</li><li>Export comptable direct</li><li>Intégration ERP</li></ul><h3>Tarifs</h3><p>CHF 20/mois, virements SEPA gratuits, carte CHF 0.- première année</p>', 'de' => '<h2>Ihre Business-Bank</h2><p>Das Acrevis Firmenkonto bietet alle notwendigen Tools für die Finanzverwaltung Ihres Unternehmens.</p><h3>Services</h3><ul><li>Multi-Währungen (CHF, EUR, USD)</li><li>Firmen-E-Banking</li><li>Unbegrenzte Mitarbeiterkarten</li><li>Berechtigungsverwaltung</li><li>Direkter Buchhaltungsexport</li><li>ERP-Integration</li></ul><h3>Gebühren</h3><p>CHF 20/Monat, kostenlose SEPA-Überweisungen, Karte CHF 0.- erstes Jahr</p>', 'en' => '<h2>Your business bank</h2><p>The Acrevis business account offers all the necessary tools for your company\'s financial management.</p><h3>Services</h3><ul><li>Multi-currency (CHF, EUR, USD)</li><li>Business e-banking</li><li>Unlimited employee cards</li><li>Authorization management</li><li>Direct accounting export</li><li>ERP integration</li></ul><h3>Fees</h3><p>CHF 20/month, free SEPA transfers, card CHF 0.- first year</p>', 'es' => '<h2>Su banco empresarial</h2><p>La cuenta empresarial Acrevis ofrece todas las herramientas necesarias para la gestión financiera de su empresa.</p><h3>Servicios</h3><ul><li>Multi-divisas (CHF, EUR, USD)</li><li>E-banking empresarial</li><li>Tarjetas empleados ilimitadas</li><li>Gestión de autorizaciones</li><li>Exportación contable directa</li><li>Integración ERP</li></ul><h3>Tarifas</h3><p>CHF 20/mes, transferencias SEPA gratuitas, tarjeta CHF 0.- primer año</p>'],
                'features' => ['fr' => ['Multi-devises', 'Cartes illimitées', 'Export comptable', 'API ouverte'], 'de' => ['Multi-Währungen', 'Unbegrenzte Karten', 'Buchhaltungsexport', 'Offene API'], 'en' => ['Multi-currency', 'Unlimited cards', 'Accounting export', 'Open API'], 'es' => ['Multi-divisas', 'Tarjetas ilimitadas', 'Exportación contable', 'API abierta']],
                'benefits' => ['fr' => ['Efficacité', 'Contrôle total', 'Automatisation', 'Flexibilité'], 'de' => ['Effizienz', 'Volle Kontrolle', 'Automatisierung', 'Flexibilität'], 'en' => ['Efficiency', 'Total control', 'Automation', 'Flexibility'], 'es' => ['Eficiencia', 'Control total', 'Automatización', 'Flexibilidad']],
            ],
            [
                'slug' => 'credit-exploitation',
                'category' => 'Entreprises',
                'segment' => 'business',
                'icon' => 'heroicon-o-arrow-trending-up',
                'order' => 61,
                'title' => ['fr' => 'Crédit d\'Exploitation', 'de' => 'Betriebskredit', 'en' => 'Working Capital Loan', 'es' => 'Crédito de Explotación'],
                'description' => ['fr' => 'Financez votre BFR. Ligne de crédit flexible, taux compétitifs, décision rapide.', 'de' => 'Finanzieren Sie Ihren Betriebsmittelbedarf. Flexible Kreditlinie, wettbewerbsfähige Zinsen, schnelle Entscheidung.', 'en' => 'Finance your working capital. Flexible credit line, competitive rates, fast decision.', 'es' => 'Financie su capital circulante. Línea de crédito flexible, tipos competitivos, decisión rápida.'],
                'content' => ['fr' => '<h2>Soutenez votre activité</h2><p>Le crédit d\'exploitation permet de financer votre besoin en fonds de roulement et saisir les opportunités.</p><h3>Solutions</h3><ul><li>Ligne de crédit jusqu\'à CHF 500K</li><li>Taux dès 3.5%</li><li>Utilisation libre et flexible</li><li>Remboursement adapté à votre CA</li><li>Décision sous 48h</li></ul><p>Garanties adaptées, pas de fonds propres requis, conseil dédié</p>', 'de' => '<h2>Unterstützen Sie Ihre Tätigkeit</h2><p>Der Betriebskredit ermöglicht die Finanzierung Ihres Betriebsmittelbedarfs und das Ergreifen von Gelegenheiten.</p><h3>Lösungen</h3><ul><li>Kreditlinie bis CHF 500K</li><li>Zinssatz ab 3.5%</li><li>Freie und flexible Nutzung</li><li>Rückzahlung angepasst an Ihren Umsatz</li><li>Entscheidung innerhalb 48 Std.</li></ul><p>Angepasste Sicherheiten, kein Eigenkapital erforderlich, dedizierte Beratung</p>', 'en' => '<h2>Support your activity</h2><p>Working capital loan allows financing your cash flow needs and seizing opportunities.</p><h3>Solutions</h3><ul><li>Credit line up to CHF 500K</li><li>Rate from 3.5%</li><li>Free and flexible use</li><li>Repayment adapted to your turnover</li><li>Decision within 48h</li></ul><p>Adapted guarantees, no equity required, dedicated advice</p>', 'es' => '<h2>Apoye su actividad</h2><p>El crédito de explotación permite financiar su necesidad de capital circulante y aprovechar oportunidades.</p><h3>Soluciones</h3><ul><li>Línea de crédito hasta CHF 500K</li><li>Tipo desde 3.5%</li><li>Uso libre y flexible</li><li>Reembolso adaptado a su facturación</li><li>Decisión en 48h</li></ul><p>Garantías adaptadas, sin capital propio requerido, asesoramiento dedicado</p>'],
                'features' => ['fr' => ['Jusqu\'à CHF 500K', 'Décision 48h', 'Flexible', 'Taux dès 3.5%'], 'de' => ['Bis CHF 500K', 'Entscheidung 48 Std.', 'Flexibel', 'Zinssatz ab 3.5%'], 'en' => ['Up to CHF 500K', '48h decision', 'Flexible', 'Rate from 3.5%'], 'es' => ['Hasta CHF 500K', 'Decisión 48h', 'Flexible', 'Tipo desde 3.5%']],
                'benefits' => ['fr' => ['Croissance', 'Flexibilité', 'Rapidité', 'Accompagnement'], 'de' => ['Wachstum', 'Flexibilität', 'Geschwindigkeit', 'Begleitung'], 'en' => ['Growth', 'Flexibility', 'Speed', 'Support'], 'es' => ['Crecimiento', 'Flexibilidad', 'Rapidez', 'Acompañamiento']],
            ],
            [
                'slug' => 'factoring',
                'category' => 'Entreprises',
                'segment' => 'business',
                'icon' => 'heroicon-o-document-check',
                'order' => 62,
                'title' => ['fr' => 'Affacturage / Factoring', 'de' => 'Factoring', 'en' => 'Factoring', 'es' => 'Factoraje'],
                'description' => ['fr' => 'Transformez vos créances en liquidités immédiates. Amélioration trésorerie, gestion recouvrement.', 'de' => 'Wandeln Sie Ihre Forderungen in sofortige Liquidität um. Liquiditätsverbesserung, Forderungsmanagement.', 'en' => 'Transform your receivables into immediate cash. Cash flow improvement, collection management.', 'es' => 'Transforme sus créditos en liquidez inmediata. Mejora de tesorería, gestión de cobros.'],
                'content' => ['fr' => '<h2>Votre trésorerie optimisée</h2><p>Le factoring vous permet de recevoir immédiatement le paiement de vos factures clients, sans attendre les délais de paiement.</p><h3>Fonctionnement</h3><ul><li>Avance jusqu\'à 90% des factures</li><li>Paiement sous 24h</li><li>Gestion recouvrement incluse</li><li>Protection contre impayés</li></ul><h3>Avantages</h3><p>Trésorerie améliorée, croissance financée, risque transféré, gestion administrative simplifiée</p>', 'de' => '<h2>Ihre optimierte Liquidität</h2><p>Factoring ermöglicht es Ihnen, die Zahlung Ihrer Kundenrechnungen sofort zu erhalten, ohne auf Zahlungsfristen warten zu müssen.</p><h3>Funktionsweise</h3><ul><li>Vorschuss bis 90% der Rechnungen</li><li>Zahlung innerhalb 24 Std.</li><li>Forderungsmanagement inklusive</li><li>Schutz vor Zahlungsausfällen</li></ul><h3>Vorteile</h3><p>Verbesserte Liquidität, finanziertes Wachstum, übertragenes Risiko, vereinfachte Verwaltung</p>', 'en' => '<h2>Your optimized cash flow</h2><p>Factoring allows you to receive payment of your customer invoices immediately, without waiting for payment terms.</p><h3>How it works</h3><ul><li>Advance up to 90% of invoices</li><li>Payment within 24h</li><li>Collection management included</li><li>Protection against non-payment</li></ul><h3>Benefits</h3><p>Improved cash flow, financed growth, transferred risk, simplified administration</p>', 'es' => '<h2>Su tesorería optimizada</h2><p>El factoraje le permite recibir el pago de sus facturas de clientes inmediatamente, sin esperar los plazos de pago.</p><h3>Funcionamiento</h3><ul><li>Anticipo hasta 90% de facturas</li><li>Pago en 24h</li><li>Gestión de cobros incluida</li><li>Protección contra impagos</li></ul><h3>Ventajas</h3><p>Tesorería mejorada, crecimiento financiado, riesgo transferido, administración simplificada</p>'],
                'features' => ['fr' => ['90% immédiat', 'Paiement 24h', 'Gestion recouvrement', 'Assurance-crédit'], 'de' => ['90% sofort', 'Zahlung 24 Std.', 'Forderungsmanagement', 'Kreditversicherung'], 'en' => ['90% immediate', '24h payment', 'Collection management', 'Credit insurance'], 'es' => ['90% inmediato', 'Pago 24h', 'Gestión cobros', 'Seguro crédito']],
                'benefits' => ['fr' => ['Liquidité immédiate', 'Croissance', 'Sécurité', 'Gain de temps'], 'de' => ['Sofortige Liquidität', 'Wachstum', 'Sicherheit', 'Zeitersparnis'], 'en' => ['Immediate cash', 'Growth', 'Security', 'Time saving'], 'es' => ['Liquidez inmediata', 'Crecimiento', 'Seguridad', 'Ahorro de tiempo']],
            ],
            [
                'slug' => 'leasing-equipement',
                'category' => 'Entreprises',
                'segment' => 'business',
                'icon' => 'heroicon-o-wrench',
                'order' => 63,
                'title' => ['fr' => 'Leasing Équipement', 'de' => 'Equipment-Leasing', 'en' => 'Equipment Leasing', 'es' => 'Leasing de Equipamiento'],
                'description' => ['fr' => 'Financez vos équipements professionnels. Préservez votre trésorerie, déductions fiscales optimales.', 'de' => 'Finanzieren Sie Ihre Geschäftsausrüstung. Schonen Sie Ihre Liquidität, optimale Steuerabzüge.', 'en' => 'Finance your professional equipment. Preserve your cash, optimal tax deductions.', 'es' => 'Financie su equipamiento profesional. Preserve su tesorería, deducciones fiscales óptimas.'],
                'content' => ['fr' => '<h2>Équipez-vous sans immobiliser</h2><p>Le leasing d\'équipement permet d\'acquérir vos machines, véhicules, matériel IT sans mobiliser votre trésorerie.</p><h3>Éligible</h3><ul><li>Machines industrielles</li><li>Matériel informatique</li><li>Véhicules utilitaires</li><li>Équipement médical</li><li>Matériel BTP</li></ul><h3>Avantages</h3><p>Durée 24-84 mois, déduction fiscale complète, option rachat fin contrat, renouvellement facile</p>', 'de' => '<h2>Ausrüstung ohne Kapitalbindung</h2><p>Equipment-Leasing ermöglicht den Erwerb Ihrer Maschinen, Fahrzeuge, IT-Ausrüstung ohne Liquiditätsbindung.</p><h3>Geeignet</h3><ul><li>Industriemaschinen</li><li>IT-Ausrüstung</li><li>Nutzfahrzeuge</li><li>Medizinische Ausrüstung</li><li>Bauausrüstung</li></ul><h3>Vorteile</h3><p>Laufzeit 24-84 Monate, vollständiger Steuerabzug, Kaufoption am Vertragsende, einfache Erneuerung</p>', 'en' => '<h2>Equip without capital tie-up</h2><p>Equipment leasing allows acquiring your machines, vehicles, IT equipment without tying up your cash.</p><h3>Eligible</h3><ul><li>Industrial machinery</li><li>IT equipment</li><li>Commercial vehicles</li><li>Medical equipment</li><li>Construction equipment</li></ul><h3>Benefits</h3><p>Duration 24-84 months, full tax deduction, purchase option end of contract, easy renewal</p>', 'es' => '<h2>Equípese sin inmovilizar</h2><p>El leasing de equipamiento permite adquirir sus máquinas, vehículos, material IT sin movilizar su tesorería.</p><h3>Elegible</h3><ul><li>Maquinaria industrial</li><li>Material informático</li><li>Vehículos utilitarios</li><li>Equipamiento médico</li><li>Material construcción</li></ul><h3>Ventajas</h3><p>Duración 24-84 meses, deducción fiscal completa, opción compra final contrato, renovación fácil</p>'],
                'features' => ['fr' => ['Tous équipements', 'Déduction 100%', 'Option rachat', 'Trésorerie préservée'], 'de' => ['Alle Ausrüstungen', 'Abzug 100%', 'Kaufoption', 'Geschonte Liquidität'], 'en' => ['All equipment', '100% deduction', 'Purchase option', 'Preserved cash'], 'es' => ['Todo equipamiento', 'Deducción 100%', 'Opción compra', 'Tesorería preservada']],
                'benefits' => ['fr' => ['Fiscalité optimale', 'Flexibilité', 'Équipement moderne', 'Croissance'], 'de' => ['Optimale Besteuerung', 'Flexibilität', 'Moderne Ausrüstung', 'Wachstum'], 'en' => ['Optimal taxation', 'Flexibility', 'Modern equipment', 'Growth'], 'es' => ['Fiscalidad óptima', 'Flexibilidad', 'Equipamiento moderno', 'Crecimiento']],
            ],
            [
                'slug' => 'commerce-international',
                'category' => 'Entreprises',
                'segment' => 'business',
                'icon' => 'heroicon-o-globe-alt',
                'order' => 64,
                'title' => ['fr' => 'Commerce International', 'de' => 'Internationaler Handel', 'en' => 'International Trade', 'es' => 'Comercio Internacional'],
                'description' => ['fr' => 'Lettres de crédit, garanties bancaires, financement import/export, couverture devises.', 'de' => 'Akkreditive, Bankgarantien, Import/Export-Finanzierung, Währungsabsicherung.', 'en' => 'Letters of credit, bank guarantees, import/export financing, currency hedging.', 'es' => 'Cartas de crédito, garantías bancarias, financiación import/export, cobertura divisas.'],
                'content' => ['fr' => '<h2>Développez à l\'international</h2><p>Nos solutions de commerce international sécurisent vos transactions et financent votre développement export.</p><h3>Services</h3><ul><li>Lettres de crédit documentaires</li><li>Encaissements documentaires</li><li>Garanties bancaires internationales</li><li>Financement pré/post-expédition</li><li>Couverture risque de change</li></ul><p>Réseau mondial de correspondants, expertise douanière, conseil export</p>', 'de' => '<h2>Expandieren Sie international</h2><p>Unsere internationalen Handelslösungen sichern Ihre Transaktionen und finanzieren Ihre Exportentwicklung.</p><h3>Services</h3><ul><li>Dokumentenakkreditive</li><li>Dokumenteninkasso</li><li>Internationale Bankgarantien</li><li>Vor/Nach-Versandfinanzierung</li><li>Wechselkursabsicherung</li></ul><p>Weltweites Korrespondentennetzwerk, Zollexpertise, Exportberatung</p>', 'en' => '<h2>Expand internationally</h2><p>Our international trade solutions secure your transactions and finance your export development.</p><h3>Services</h3><ul><li>Documentary letters of credit</li><li>Documentary collections</li><li>International bank guarantees</li><li>Pre/post-shipment financing</li><li>Foreign exchange hedging</li></ul><p>Global correspondent network, customs expertise, export advice</p>', 'es' => '<h2>Desarrolle internacionalmente</h2><p>Nuestras soluciones de comercio internacional aseguran sus transacciones y financian su desarrollo exportador.</p><h3>Servicios</h3><ul><li>Cartas de crédito documentarias</li><li>Cobranzas documentarias</li><li>Garantías bancarias internacionales</li><li>Financiación pre/post-expedición</li><li>Cobertura riesgo de cambio</li></ul><p>Red mundial de corresponsales, experiencia aduanera, asesoramiento exportador</p>'],
                'features' => ['fr' => ['LC documentaires', 'Garanties bancaires', 'Financement export', 'Couverture FX'], 'de' => ['Dokumentenakkreditive', 'Bankgarantien', 'Exportfinanzierung', 'FX-Absicherung'], 'en' => ['Documentary LC', 'Bank guarantees', 'Export financing', 'FX hedging'], 'es' => ['LC documentarias', 'Garantías bancarias', 'Financiación export', 'Cobertura FX']],
                'benefits' => ['fr' => ['Sécurité', 'Croissance internationale', 'Expertise', 'Réseau mondial'], 'de' => ['Sicherheit', 'Internationales Wachstum', 'Expertise', 'Weltweites Netzwerk'], 'en' => ['Security', 'International growth', 'Expertise', 'Global network'], 'es' => ['Seguridad', 'Crecimiento internacional', 'Experiencia', 'Red mundial']],
            ],
            [
                'slug' => 'cash-management',
                'category' => 'Entreprises',
                'segment' => 'business',
                'icon' => 'heroicon-o-chart-bar-square',
                'order' => 65,
                'title' => ['fr' => 'Cash Management', 'de' => 'Cash Management', 'en' => 'Cash Management', 'es' => 'Gestión de Tesorería'],
                'description' => ['fr' => 'Optimisez votre trésorerie. Centralisation, placement automatique, prévisions, reporting temps réel.', 'de' => 'Optimieren Sie Ihre Liquidität. Zentralisierung, automatische Anlage, Prognosen, Echtzeit-Reporting.', 'en' => 'Optimize your cash. Centralization, automatic investment, forecasts, real-time reporting.', 'es' => 'Optimice su tesorería. Centralización, colocación automática, previsiones, reporting tiempo real.'],
                'content' => ['fr' => '<h2>Trésorerie intelligente</h2><p>Notre solution de cash management automatise et optimise la gestion de votre trésorerie d\'entreprise.</p><h3>Fonctionnalités</h3><ul><li>Centralisation multi-comptes</li><li>Placement automatique excédents</li><li>Prévisions de trésorerie IA</li><li>Reporting temps réel</li><li>Gestion multi-entités</li><li>API bancaire complète</li></ul><p>Rémunération excédents, alertes personnalisées, intégration ERP/CRM</p>', 'de' => '<h2>Intelligente Liquidität</h2><p>Unsere Cash-Management-Lösung automatisiert und optimiert die Verwaltung Ihrer Unternehmensliquidität.</p><h3>Funktionen</h3><ul><li>Multi-Konto-Zentralisierung</li><li>Automatische Anlage von Überschüssen</li><li>KI-Liquiditätsprognosen</li><li>Echtzeit-Reporting</li><li>Multi-Entitäts-Verwaltung</li><li>Vollständige Banking-API</li></ul><p>Vergütung von Überschüssen, personalisierte Alarme, ERP/CRM-Integration</p>', 'en' => '<h2>Intelligent cash</h2><p>Our cash management solution automates and optimizes your corporate cash management.</p><h3>Features</h3><ul><li>Multi-account centralization</li><li>Automatic surplus investment</li><li>AI cash forecasts</li><li>Real-time reporting</li><li>Multi-entity management</li><li>Complete banking API</li></ul><p>Surplus remuneration, personalized alerts, ERP/CRM integration</p>', 'es' => '<h2>Tesorería inteligente</h2><p>Nuestra solución de gestión de tesorería automatiza y optimiza la gestión de su tesorería corporativa.</p><h3>Funcionalidades</h3><ul><li>Centralización multi-cuentas</li><li>Colocación automática excedentes</li><li>Previsiones tesorería IA</li><li>Reporting tiempo real</li><li>Gestión multi-entidades</li><li>API bancaria completa</li></ul><p>Remuneración excedentes, alertas personalizadas, integración ERP/CRM</p>'],
                'features' => ['fr' => ['Centralisation', 'Placement auto', 'Prévisions IA', 'API complète'], 'de' => ['Zentralisierung', 'Auto-Anlage', 'KI-Prognosen', 'Vollständige API'], 'en' => ['Centralization', 'Auto investment', 'AI forecasts', 'Complete API'], 'es' => ['Centralización', 'Colocación auto', 'Previsiones IA', 'API completa']],
                'benefits' => ['fr' => ['Optimisation', 'Automatisation', 'Vision 360°', 'Rentabilité'], 'de' => ['Optimierung', 'Automatisierung', '360°-Sicht', 'Rentabilität'], 'en' => ['Optimization', 'Automation', '360° view', 'Profitability'], 'es' => ['Optimización', 'Automatización', 'Visión 360°', 'Rentabilidad']],
            ],
            [
                'slug' => 'terminal-paiement',
                'category' => 'Entreprises',
                'segment' => 'business',
                'icon' => 'heroicon-o-device-tablet',
                'order' => 66,
                'title' => ['fr' => 'Terminaux de Paiement', 'de' => 'Zahlungsterminals', 'en' => 'Payment Terminals', 'es' => 'Terminales de Pago'],
                'description' => ['fr' => 'Solutions de paiement modernes. TPE fixes et mobiles, paiement sans contact, e-commerce intégré.', 'de' => 'Moderne Zahlungslösungen. Feste und mobile Terminals, kontaktloses Bezahlen, integriertes E-Commerce.', 'en' => 'Modern payment solutions. Fixed and mobile terminals, contactless payment, integrated e-commerce.', 'es' => 'Soluciones de pago modernas. TPV fijos y móviles, pago sin contacto, e-commerce integrado.'],
                'content' => ['fr' => '<h2>Acceptez tous les paiements</h2><p>Nos terminaux de paiement vous permettent d\'accepter toutes les cartes avec sécurité et simplicité.</p><h3>Solutions</h3><ul><li>TPE fixe: CHF 15/mois</li><li>TPE mobile: CHF 20/mois</li><li>Solution e-commerce: CHF 25/mois</li><li>Tous acceptent Visa, Mastercard, Maestro, Twint, Apple/Google Pay</li></ul><h3>Commission</h3><p>Cartes suisses: 1.2%, cartes étrangères: 2.5%, virement sous 2 jours</p>', 'de' => '<h2>Akzeptieren Sie alle Zahlungen</h2><p>Unsere Zahlungsterminals ermöglichen es Ihnen, alle Karten sicher und einfach zu akzeptieren.</p><h3>Lösungen</h3><ul><li>Festes Terminal: CHF 15/Monat</li><li>Mobiles Terminal: CHF 20/Monat</li><li>E-Commerce-Lösung: CHF 25/Monat</li><li>Alle akzeptieren Visa, Mastercard, Maestro, Twint, Apple/Google Pay</li></ul><h3>Kommission</h3><p>Schweizer Karten: 1.2%, ausländische Karten: 2.5%, Überweisung innerhalb 2 Tagen</p>', 'en' => '<h2>Accept all payments</h2><p>Our payment terminals allow you to accept all cards securely and simply.</p><h3>Solutions</h3><ul><li>Fixed terminal: CHF 15/month</li><li>Mobile terminal: CHF 20/month</li><li>E-commerce solution: CHF 25/month</li><li>All accept Visa, Mastercard, Maestro, Twint, Apple/Google Pay</li></ul><h3>Commission</h3><p>Swiss cards: 1.2%, foreign cards: 2.5%, transfer within 2 days</p>', 'es' => '<h2>Acepte todos los pagos</h2><p>Nuestros terminales de pago le permiten aceptar todas las tarjetas con seguridad y simplicidad.</p><h3>Soluciones</h3><ul><li>TPV fijo: CHF 15/mes</li><li>TPV móvil: CHF 20/mes</li><li>Solución e-commerce: CHF 25/mes</li><li>Todos aceptan Visa, Mastercard, Maestro, Twint, Apple/Google Pay</li></ul><h3>Comisión</h3><p>Tarjetas suizas: 1.2%, tarjetas extranjeras: 2.5%, transferencia en 2 días</p>'],
                'features' => ['fr' => ['Sans contact', 'Toutes cartes', 'E-commerce', 'Virement 2j'], 'de' => ['Kontaktlos', 'Alle Karten', 'E-Commerce', 'Überweisung 2T'], 'en' => ['Contactless', 'All cards', 'E-commerce', 'Transfer 2d'], 'es' => ['Sin contacto', 'Todas tarjetas', 'E-commerce', 'Transferencia 2d']],
                'benefits' => ['fr' => ['Plus de ventes', 'Sécurité', 'Simplicité', 'Commission faible'], 'de' => ['Mehr Verkäufe', 'Sicherheit', 'Einfachheit', 'Niedrige Kommission'], 'en' => ['More sales', 'Security', 'Simplicity', 'Low commission'], 'es' => ['Más ventas', 'Seguridad', 'Simplicidad', 'Comisión baja']],
            ],
            [
                'slug' => 'paiement-salaires',
                'category' => 'Entreprises',
                'segment' => 'business',
                'icon' => 'heroicon-o-users',
                'order' => 67,
                'title' => ['fr' => 'Paiement des Salaires', 'de' => 'Lohnzahlungen', 'en' => 'Payroll Payment', 'es' => 'Pago de Salarios'],
                'description' => ['fr' => 'Automatisez vos salaires. Import fichier, virements groupés, certificats, intégration RH.', 'de' => 'Automatisieren Sie Ihre Gehälter. Dateiimport, Sammelüberweisungen, Zertifikate, HR-Integration.', 'en' => 'Automate your payroll. File import, batch transfers, certificates, HR integration.', 'es' => 'Automatice sus salarios. Importación archivo, transferencias agrupadas, certificados, integración RR.HH.'],
                'content' => ['fr' => '<h2>Simplifiez vos salaires</h2><p>Notre solution de paiement des salaires automatise entièrement le processus et s\'intègre à votre système RH.</p><h3>Fonctionnalités</h3><ul><li>Import fichier salaires (CSV, XML)</li><li>Virements groupés automatiques</li><li>Génération certificats salaires</li><li>Intégration logiciels RH</li><li>Historique complet</li></ul><h3>Tarifs</h3><p>CHF 2.- par virement, service inclus gratuit jusqu\'à 10 employés</p>', 'de' => '<h2>Vereinfachen Sie Ihre Gehälter</h2><p>Unsere Lohnzahlungslösung automatisiert den gesamten Prozess und integriert sich in Ihr HR-System.</p><h3>Funktionen</h3><ul><li>Import Gehaltsdatei (CSV, XML)</li><li>Automatische Sammelüberweisungen</li><li>Generierung Lohnausweise</li><li>Integration HR-Software</li><li>Vollständiger Verlauf</li></ul><h3>Gebühren</h3><p>CHF 2.- pro Überweisung, Service kostenlos bis 10 Mitarbeiter</p>', 'en' => '<h2>Simplify your payroll</h2><p>Our payroll payment solution fully automates the process and integrates with your HR system.</p><h3>Features</h3><ul><li>Payroll file import (CSV, XML)</li><li>Automatic batch transfers</li><li>Salary certificate generation</li><li>HR software integration</li><li>Complete history</li></ul><h3>Fees</h3><p>CHF 2.- per transfer, service free up to 10 employees</p>', 'es' => '<h2>Simplifique sus salarios</h2><p>Nuestra solución de pago de salarios automatiza completamente el proceso y se integra con su sistema de RR.HH.</p><h3>Funcionalidades</h3><ul><li>Importación archivo salarios (CSV, XML)</li><li>Transferencias agrupadas automáticas</li><li>Generación certificados salarios</li><li>Integración software RR.HH.</li><li>Historial completo</li></ul><h3>Tarifas</h3><p>CHF 2.- por transferencia, servicio gratis hasta 10 empleados</p>'],
                'features' => ['fr' => ['Import auto', 'Virements groupés', 'Certificats', 'Intégration RH'], 'de' => ['Auto-Import', 'Sammelüberweisungen', 'Zertifikate', 'HR-Integration'], 'en' => ['Auto import', 'Batch transfers', 'Certificates', 'HR integration'], 'es' => ['Importación auto', 'Transferencias agrupadas', 'Certificados', 'Integración RR.HH.']],
                'benefits' => ['fr' => ['Gain de temps', 'Zéro erreur', 'Automatisation', 'Conformité'], 'de' => ['Zeitersparnis', 'Null Fehler', 'Automatisierung', 'Compliance'], 'en' => ['Time saving', 'Zero error', 'Automation', 'Compliance'], 'es' => ['Ahorro tiempo', 'Cero error', 'Automatización', 'Cumplimiento']],
            ],
            [
                'slug' => 'caisse-pension-entreprise',
                'category' => 'Entreprises',
                'segment' => 'business',
                'icon' => 'heroicon-o-building-office-2',
                'order' => 68,
                'title' => ['fr' => 'Caisse de Pension Entreprise', 'de' => 'Firmenpensionskasse', 'en' => 'Corporate Pension Fund', 'es' => 'Caja de Pensiones Empresa'],
                'description' => ['fr' => 'Solution LPP complète pour vos employés. Plans sur mesure, gestion déléguée, prestations compétitives.', 'de' => 'Komplette BVG-Lösung für Ihre Mitarbeiter. Maßgeschneiderte Pläne, delegierte Verwaltung, wettbewerbsfähige Leistungen.', 'en' => 'Complete pension solution for your employees. Customized plans, delegated management, competitive benefits.', 'es' => 'Solución LPP completa para sus empleados. Planes a medida, gestión delegada, prestaciones competitivas.'],
                'content' => ['fr' => '<h2>Protection optimale de vos employés</h2><p>Notre solution de prévoyance professionnelle offre des prestations attractives à vos employés tout en optimisant vos coûts.</p><h3>Prestations</h3><ul><li>Plans LPP sur-obligatoires</li><li>Taux de conversion compétitifs</li><li>Gestion administrative complète</li><li>Conseil prévoyance employés</li><li>Rendement attractif des capitaux</li></ul><p>Sans engagement de durée, affiliation simple, service dédié</p>', 'de' => '<h2>Optimaler Schutz Ihrer Mitarbeiter</h2><p>Unsere berufliche Vorsorgelösung bietet Ihren Mitarbeitern attraktive Leistungen bei gleichzeitiger Kostenoptimierung.</p><h3>Leistungen</h3><ul><li>Überobligatorische BVG-Pläne</li><li>Wettbewerbsfähige Umwandlungssätze</li><li>Vollständige Verwaltung</li><li>Vorsorgeberatung für Mitarbeiter</li><li>Attraktive Kapitalrendite</li></ul><p>Ohne Laufzeitverpflichtung, einfacher Beitritt, dedizierter Service</p>', 'en' => '<h2>Optimal protection for your employees</h2><p>Our occupational pension solution offers attractive benefits to your employees while optimizing your costs.</p><h3>Benefits</h3><ul><li>Super-mandatory pension plans</li><li>Competitive conversion rates</li><li>Complete administrative management</li><li>Employee pension advice</li><li>Attractive capital returns</li></ul><p>No commitment period, simple affiliation, dedicated service</p>', 'es' => '<h2>Protección óptima de sus empleados</h2><p>Nuestra solución de previsión profesional ofrece prestaciones atractivas a sus empleados optimizando sus costos.</p><h3>Prestaciones</h3><ul><li>Planes LPP sobre-obligatorios</li><li>Tipos de conversión competitivos</li><li>Gestión administrativa completa</li><li>Asesoramiento previsión empleados</li><li>Rendimiento atractivo de capitales</li></ul><p>Sin compromiso de duración, afiliación simple, servicio dedicado</p>'],
                'features' => ['fr' => ['Plans sur mesure', 'Gestion complète', 'Conseil employés', 'Rendement attractif'], 'de' => ['Maßgeschneiderte Pläne', 'Vollständige Verwaltung', 'Mitarbeiterberatung', 'Attraktive Rendite'], 'en' => ['Custom plans', 'Complete management', 'Employee advice', 'Attractive return'], 'es' => ['Planes a medida', 'Gestión completa', 'Asesoramiento empleados', 'Rendimiento atractivo']],
                'benefits' => ['fr' => ['Employés satisfaits', 'Coûts optimisés', 'Simplicité', 'Compétitivité'], 'de' => ['Zufriedene Mitarbeiter', 'Optimierte Kosten', 'Einfachheit', 'Wettbewerbsfähigkeit'], 'en' => ['Satisfied employees', 'Optimized costs', 'Simplicity', 'Competitiveness'], 'es' => ['Empleados satisfechos', 'Costos optimizados', 'Simplicidad', 'Competitividad']],
            ],
            [
                'slug' => 'conseil-entreprise',
                'category' => 'Entreprises',
                'segment' => 'business',
                'icon' => 'heroicon-o-presentation-chart-line',
                'order' => 69,
                'title' => ['fr' => 'Conseil aux Entreprises', 'de' => 'Unternehmensberatung', 'en' => 'Business Advisory', 'es' => 'Asesoramiento Empresarial'],
                'description' => ['fr' => 'Accompagnement stratégique global. Finance, fiscalité, croissance, transmission. Experts dédiés.', 'de' => 'Umfassende strategische Begleitung. Finanzen, Steuern, Wachstum, Nachfolge. Dedizierte Experten.', 'en' => 'Comprehensive strategic support. Finance, tax, growth, succession. Dedicated experts.', 'es' => 'Acompañamiento estratégico global. Finanzas, fiscalidad, crecimiento, transmisión. Expertos dedicados.'],
                'content' => ['fr' => '<h2>Votre partenaire business</h2><p>Notre service de conseil accompagne les dirigeants dans toutes les étapes de vie de leur entreprise.</p><h3>Domaines d\'expertise</h3><ul><li>Création et structuration</li><li>Financement croissance</li><li>Optimisation fiscale</li><li>Gestion trésorerie</li><li>Transmission/succession</li><li>Fusion-acquisition</li></ul><h3>Approche</h3><p>Conseiller dédié, vision 360°, réseau d\'experts (avocats, fiduciaires), accompagnement long terme</p>', 'de' => '<h2>Ihr Business-Partner</h2><p>Unser Beratungsservice begleitet Führungskräfte in allen Lebensphasen ihres Unternehmens.</p><h3>Fachgebiete</h3><ul><li>Gründung und Strukturierung</li><li>Wachstumsfinanzierung</li><li>Steueroptimierung</li><li>Liquiditätsverwaltung</li><li>Übertragung/Nachfolge</li><li>Fusion-Übernahme</li></ul><h3>Ansatz</h3><p>Dedizierter Berater, 360°-Sicht, Expertennetzwerk (Anwälte, Treuhänder), langfristige Begleitung</p>', 'en' => '<h2>Your business partner</h2><p>Our advisory service supports leaders at all stages of their company\'s life.</p><h3>Areas of expertise</h3><ul><li>Formation and structuring</li><li>Growth financing</li><li>Tax optimization</li><li>Cash management</li><li>Transfer/succession</li><li>Merger-acquisition</li></ul><h3>Approach</h3><p>Dedicated advisor, 360° view, expert network (lawyers, fiduciaries), long-term support</p>', 'es' => '<h2>Su socio empresarial</h2><p>Nuestro servicio de asesoramiento acompaña a los directivos en todas las etapas de vida de su empresa.</p><h3>Áreas de experiencia</h3><ul><li>Creación y estructuración</li><li>Financiación crecimiento</li><li>Optimización fiscal</li><li>Gestión tesorería</li><li>Transmisión/sucesión</li><li>Fusión-adquisición</li></ul><h3>Enfoque</h3><p>Asesor dedicado, visión 360°, red de expertos (abogados, fiduciarios), acompañamiento largo plazo</p>'],
                'features' => ['fr' => ['Conseiller dédié', 'Vision 360°', 'Réseau experts', 'Accompagnement long terme'], 'de' => ['Dedizierter Berater', '360°-Sicht', 'Expertennetzwerk', 'Langfristige Begleitung'], 'en' => ['Dedicated advisor', '360° view', 'Expert network', 'Long-term support'], 'es' => ['Asesor dedicado', 'Visión 360°', 'Red expertos', 'Acompañamiento largo plazo']],
                'benefits' => ['fr' => ['Croissance', 'Optimisation', 'Sérénité', 'Expertise pointue'], 'de' => ['Wachstum', 'Optimierung', 'Gelassenheit', 'Hohe Expertise'], 'en' => ['Growth', 'Optimization', 'Peace of mind', 'High expertise'], 'es' => ['Crecimiento', 'Optimización', 'Serenidad', 'Alta experiencia']],
            ],

        ];

        // Création des services
        foreach ($services as $serviceData) {
            Service::create([
                'slug' => $serviceData['slug'],
                'category' => $serviceData['category'],
                'segment' => $serviceData['segment'],
                'icon' => $serviceData['icon'],
                'order' => $serviceData['order'],
                'is_active' => true,
                'title' => $serviceData['title'],
                'description' => $serviceData['description'],
                'content' => $serviceData['content'],
                'features' => $serviceData['features'],
                'benefits' => $serviceData['benefits'],
            ]);
        }

        $this->command->info('✅ ' . count($services) . ' services bancaires créés avec succès!');
        $this->command->info('📝 Note: Il s\'agit d\'un échantillon. Les 50 autres services suivront le même format.');
    }
}
