<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\ArticleCategory;
use Carbon\Carbon;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        // Create categories
        $newsCategory = ArticleCategory::firstOrCreate(
            ['slug' => 'actualites'],
            [
                'name' => [
                    'fr' => 'Actualités',
                    'de' => 'Aktuelles',
                    'en' => 'News',
                    'es' => 'Noticias',
                ],
                'description' => [
                    'fr' => 'Dernières actualités de la banque',
                    'de' => 'Neuigkeiten der Bank',
                    'en' => 'Latest bank news',
                    'es' => 'Últimas noticias del banco',
                ],
            ]
        );

        // Article 1: E-Banking Launch
        Article::create([
            'slug' => 'nouveau-e-banking-mobile-banking-2025',
            'title' => [
                'fr' => 'Nouveau E-Banking et Mobile Banking : Lancement fin octobre 2025',
                'de' => 'Neues E-Banking und Mobile Banking: Einführung ab Ende Oktober 2025',
                'en' => 'New E-Banking and Mobile Banking: Launch end of October 2025',
                'es' => 'Nuevo E-Banking y Mobile Banking: Lanzamiento finales de octubre 2025',
            ],
            'excerpt' => [
                'fr' => 'Découvrez notre nouvelle plateforme bancaire digitale avec une interface modernisée et de nouvelles fonctionnalités.',
                'de' => 'Entdecken Sie unsere neue digitale Banking-Plattform mit modernisiertem Interface und neuen Funktionen.',
                'en' => 'Discover our new digital banking platform with a modernized interface and new features.',
                'es' => 'Descubra nuestra nueva plataforma bancaria digital con una interfaz modernizada y nuevas funcionalidades.',
            ],
            'content' => [
                'fr' => '<h2>Une nouvelle ère pour votre banque en ligne</h2><p>Acrevis Bank est fière d\'annoncer le lancement de son nouveau E-Banking et Mobile Banking à la fin du mois d\'octobre 2025. Cette mise à jour majeure apporte une expérience utilisateur complètement repensée.</p><h3>Principales nouveautés</h3><ul><li>Interface utilisateur moderne et intuitive</li><li>Authentification biométrique renforcée</li><li>Virements instantanés 24/7</li><li>Gestion des cartes en temps réel</li><li>Vue consolidée de tous vos comptes</li><li>Notifications personnalisables</li></ul><h3>Disponibilité</h3><p>Le nouveau E-Banking sera accessible via votre navigateur web, tandis que l\'application Mobile Banking sera disponible sur iOS et Android.</p>',
                'de' => '<h2>Eine neue Ära für Ihr Online-Banking</h2><p>Acrevis Bank freut sich, die Einführung ihres neuen E-Banking und Mobile Banking Ende Oktober 2025 bekanntzugeben. Dieses umfassende Update bringt eine völlig neu gestaltete Benutzererfahrung.</p><h3>Hauptneuigkeiten</h3><ul><li>Moderne und intuitive Benutzeroberfläche</li><li>Verstärkte biometrische Authentifizierung</li><li>Sofortüberweisungen 24/7</li><li>Kartenverwaltung in Echtzeit</li><li>Konsolidierte Ansicht aller Ihrer Konten</li><li>Anpassbare Benachrichtigungen</li></ul><h3>Verfügbarkeit</h3><p>Das neue E-Banking ist über Ihren Webbrowser zugänglich, während die Mobile Banking App für iOS und Android verfügbar sein wird.</p>',
                'en' => '<h2>A new era for your online banking</h2><p>Acrevis Bank is proud to announce the launch of its new E-Banking and Mobile Banking at the end of October 2025. This major update brings a completely redesigned user experience.</p><h3>Main features</h3><ul><li>Modern and intuitive user interface</li><li>Enhanced biometric authentication</li><li>Instant transfers 24/7</li><li>Real-time card management</li><li>Consolidated view of all your accounts</li><li>Customizable notifications</li></ul><h3>Availability</h3><p>The new E-Banking will be accessible via your web browser, while the Mobile Banking app will be available on iOS and Android.</p>',
                'es' => '<h2>Una nueva era para su banca en línea</h2><p>Acrevis Bank se enorgullece de anunciar el lanzamiento de su nuevo E-Banking y Mobile Banking a finales de octubre de 2025. Esta importante actualización trae una experiencia de usuario completamente rediseñada.</p><h3>Principales novedades</h3><ul><li>Interfaz moderna e intuitiva</li><li>Autenticación biométrica reforzada</li><li>Transferencias instantáneas 24/7</li><li>Gestión de tarjetas en tiempo real</li><li>Vista consolidada de todas sus cuentas</li><li>Notificaciones personalizables</li></ul><h3>Disponibilidad</h3><p>El nuevo E-Banking será accesible a través de su navegador web, mientras que la aplicación Mobile Banking estará disponible en iOS y Android.</p>',
            ],
            'featured_image' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=800&h=600&fit=crop',
            'category_id' => $newsCategory->id,
            'author_id' => 1,
            'segment' => 'both',
            'is_featured' => true,
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(5),
            'views' => 245,
        ]);

        // Article 2: Technical Insurance
        Article::create([
            'slug' => 'assurances-techniques-en-cours',
            'title' => [
                'fr' => 'Les assurances techniques sont en cours',
                'de' => 'Technische Versicherungen sind im Gange',
                'en' => 'Technical insurances are underway',
                'es' => 'Los seguros técnicos están en curso',
            ],
            'excerpt' => [
                'fr' => 'Nos partenariats avec les meilleures compagnies d\'assurance pour vous offrir une protection optimale.',
                'de' => 'Unsere Partnerschaften mit den besten Versicherungsgesellschaften für optimalen Schutz.',
                'en' => 'Our partnerships with the best insurance companies to offer you optimal protection.',
                'es' => 'Nuestras asociaciones con las mejores compañías de seguros para ofrecerle una protección óptima.',
            ],
            'content' => [
                'fr' => '<h2>Protection complète pour vos biens</h2><p>Acrevis Bank renforce son offre d\'assurances techniques en partenariat avec les leaders du secteur. Nous vous proposons désormais une gamme complète de solutions pour protéger vos biens.</p><h3>Assurances disponibles</h3><ul><li>Assurance habitation</li><li>Assurance véhicule</li><li>Protection juridique</li><li>Assurance responsabilité civile</li><li>Assurance voyage</li></ul><h3>Avantages clients</h3><p>En tant que client Acrevis Bank, bénéficiez de conditions préférentielles et d\'une gestion centralisée de tous vos contrats d\'assurance.</p>',
                'de' => '<h2>Vollständiger Schutz für Ihr Eigentum</h2><p>Acrevis Bank stärkt ihr Angebot an technischen Versicherungen in Partnerschaft mit den Branchenführern. Wir bieten Ihnen jetzt ein vollständiges Sortiment an Lösungen zum Schutz Ihres Eigentums.</p><h3>Verfügbare Versicherungen</h3><ul><li>Hausratversicherung</li><li>Fahrzeugversicherung</li><li>Rechtsschutz</li><li>Haftpflichtversicherung</li><li>Reiseversicherung</li></ul><h3>Kundenvorteile</h3><p>Als Acrevis Bank Kunde profitieren Sie von Vorzugskonditionen und zentraler Verwaltung aller Ihrer Versicherungsverträge.</p>',
                'en' => '<h2>Complete protection for your property</h2><p>Acrevis Bank strengthens its technical insurance offering in partnership with industry leaders. We now offer you a full range of solutions to protect your property.</p><h3>Available insurances</h3><ul><li>Home insurance</li><li>Vehicle insurance</li><li>Legal protection</li><li>Liability insurance</li><li>Travel insurance</li></ul><h3>Customer benefits</h3><p>As an Acrevis Bank customer, benefit from preferential conditions and centralized management of all your insurance contracts.</p>',
                'es' => '<h2>Protección completa para sus bienes</h2><p>Acrevis Bank refuerza su oferta de seguros técnicos en asociación con los líderes del sector. Ahora le ofrecemos una gama completa de soluciones para proteger sus bienes.</p><h3>Seguros disponibles</h3><ul><li>Seguro de hogar</li><li>Seguro de vehículo</li><li>Protección jurídica</li><li>Seguro de responsabilidad civil</li><li>Seguro de viaje</li></ul><h3>Ventajas para clientes</h3><p>Como cliente de Acrevis Bank, benefíciese de condiciones preferenciales y gestión centralizada de todos sus contratos de seguro.</p>',
            ],
            'featured_image' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=800&h=600&fit=crop',
            'category_id' => $newsCategory->id,
            'author_id' => 1,
            'segment' => 'both',
            'is_featured' => false,
            'is_published' => true,
            'published_at' => Carbon::now()->subDays(12),
            'views' => 189,
        ]);

        $this->command->info('✅ 2 articles créés avec succès!');
    }
}
