<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Career;
use Carbon\Carbon;

class CareerSeeder extends Seeder
{
    public function run(): void
    {
        $careers = [
            [
                'title' => [
                    'fr' => 'Conseiller(ère) clientèle privée',
                    'de' => 'Privatkundenberater(in)',
                    'en' => 'Private Banking Advisor',
                    'es' => 'Asesor(a) de banca privada',
                ],
                'slug' => 'conseiller-clientele-privee',
                'location' => 'St.Gallen',
                'department' => 'Banque Privée',
                'contract_type' => 'CDI',
                'workload' => '100%',
                'description' => [
                    'fr' => '<p>Nous recherchons un(e) conseiller(ère) clientèle privée expérimenté(e) pour rejoindre notre équipe à St.Gallen.</p><h3>Vos missions</h3><ul><li>Gestion d\'un portefeuille de clients privés fortunés</li><li>Conseil en placements et gestion de patrimoine</li><li>Développement de relations à long terme</li><li>Analyse des besoins financiers et proposition de solutions adaptées</li></ul>',
                    'de' => '<p>Wir suchen eine(n) erfahrene(n) Privatkundenberater(in) für unser Team in St.Gallen.</p><h3>Ihre Aufgaben</h3><ul><li>Verwaltung eines Portfolios vermögender Privatkunden</li><li>Anlageberatung und Vermögensverwaltung</li><li>Aufbau langfristiger Beziehungen</li><li>Analyse finanzieller Bedürfnisse und Vorschlag passender Lösungen</li></ul>',
                    'en' => '<p>We are seeking an experienced private banking advisor to join our team in St.Gallen.</p><h3>Your missions</h3><ul><li>Management of a portfolio of high-net-worth private clients</li><li>Investment advice and wealth management</li><li>Development of long-term relationships</li><li>Analysis of financial needs and proposal of appropriate solutions</li></ul>',
                    'es' => '<p>Buscamos un(a) asesor(a) de banca privada experimentado(a) para unirse a nuestro equipo en St.Gallen.</p><h3>Sus misiones</h3><ul><li>Gestión de una cartera de clientes privados de alto patrimonio</li><li>Asesoramiento en inversiones y gestión patrimonial</li><li>Desarrollo de relaciones a largo plazo</li><li>Análisis de necesidades financieras y propuesta de soluciones adecuadas</li></ul>',
                ],
                'requirements' => [
                    'fr' => '<ul><li>Formation bancaire CFC ou équivalent universitaire</li><li>Minimum 5 ans d\'expérience en gestion de fortune</li><li>Certificat SAQ ou CIIA un atout</li><li>Maîtrise de l\'allemand et de l\'anglais</li><li>Excellentes compétences relationnelles</li></ul>',
                    'de' => '<ul><li>Bankfachliche Grundausbildung EFZ oder gleichwertiger Universitätsabschluss</li><li>Mindestens 5 Jahre Erfahrung in der Vermögensverwaltung</li><li>SAQ- oder CIIA-Zertifikat von Vorteil</li><li>Beherrschung der deutschen und englischen Sprache</li><li>Ausgezeichnete Beziehungsfähigkeiten</li></ul>',
                    'en' => '<ul><li>Banking apprenticeship or equivalent university degree</li><li>Minimum 5 years experience in wealth management</li><li>SAQ or CIIA certificate an asset</li><li>Fluency in German and English</li><li>Excellent relationship skills</li></ul>',
                    'es' => '<ul><li>Formación bancaria o equivalente universitario</li><li>Mínimo 5 años de experiencia en gestión patrimonial</li><li>Certificado SAQ o CIIA una ventaja</li><li>Dominio del alemán e inglés</li><li>Excelentes habilidades relacionales</li></ul>',
                ],
                'benefits' => [
                    'fr' => '<ul><li>Salaire attractif avec bonus</li><li>Prestations sociales complètes (LPP, assurances)</li><li>Formation continue</li><li>Environnement de travail moderne</li><li>4 semaines de vacances minimum</li></ul>',
                    'de' => '<ul><li>Attraktives Gehalt mit Bonus</li><li>Vollständige Sozialleistungen (BVG, Versicherungen)</li><li>Weiterbildung</li><li>Modernes Arbeitsumfeld</li><li>Mindestens 4 Wochen Ferien</li></ul>',
                    'en' => '<ul><li>Attractive salary with bonus</li><li>Complete social benefits (pension, insurance)</li><li>Continuing education</li><li>Modern work environment</li><li>Minimum 4 weeks vacation</li></ul>',
                    'es' => '<ul><li>Salario atractivo con bonificación</li><li>Prestaciones sociales completas (pensión, seguros)</li><li>Formación continua</li><li>Ambiente de trabajo moderno</li><li>Mínimo 4 semanas de vacaciones</li></ul>',
                ],
                'published_at' => Carbon::now()->subDays(5),
                'expires_at' => Carbon::now()->addDays(60),
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => [
                    'fr' => 'Analyste Crédit Senior',
                    'de' => 'Senior Kreditanalyst(in)',
                    'en' => 'Senior Credit Analyst',
                    'es' => 'Analista de Crédito Senior',
                ],
                'slug' => 'analyste-credit-senior',
                'location' => 'Zürich',
                'department' => 'Risques & Crédits',
                'contract_type' => 'CDI',
                'workload' => '100%',
                'description' => [
                    'fr' => '<p>Rejoignez notre équipe de gestion des risques en tant qu\'analyste crédit senior.</p><h3>Responsabilités</h3><ul><li>Analyse approfondie des demandes de crédit commerciales</li><li>Évaluation de la solvabilité des entreprises</li><li>Rédaction de rapports d\'analyse détaillés</li><li>Suivi du portefeuille de crédits</li><li>Collaboration avec les équipes commerciales</li></ul>',
                    'de' => '<p>Werden Sie Teil unseres Risikomanagement-Teams als Senior Kreditanalyst(in).</p><h3>Verantwortlichkeiten</h3><ul><li>Eingehende Analyse von Gewerbekreditanträgen</li><li>Bewertung der Kreditwürdigkeit von Unternehmen</li><li>Erstellung detaillierter Analyseberichte</li><li>Überwachung des Kreditportfolios</li><li>Zusammenarbeit mit Vertriebsteams</li></ul>',
                    'en' => '<p>Join our risk management team as a senior credit analyst.</p><h3>Responsibilities</h3><ul><li>In-depth analysis of commercial credit requests</li><li>Assessment of company creditworthiness</li><li>Drafting detailed analysis reports</li><li>Monitoring of credit portfolio</li><li>Collaboration with sales teams</li></ul>',
                    'es' => '<p>Únase a nuestro equipo de gestión de riesgos como analista de crédito senior.</p><h3>Responsabilidades</h3><ul><li>Análisis en profundidad de solicitudes de crédito comercial</li><li>Evaluación de la solvencia de empresas</li><li>Redacción de informes de análisis detallados</li><li>Seguimiento de la cartera de créditos</li><li>Colaboración con equipos comerciales</li></ul>',
                ],
                'requirements' => [
                    'fr' => '<ul><li>Master en finance, économie ou équivalent</li><li>5-7 ans d\'expérience en analyse crédit</li><li>Excellente maîtrise de l\'analyse financière</li><li>Compétences avancées en Excel et outils d\'analyse</li><li>Allemand et anglais courants</li></ul>',
                    'de' => '<ul><li>Master in Finanzwesen, Wirtschaft oder gleichwertig</li><li>5-7 Jahre Erfahrung in Kreditanalyse</li><li>Ausgezeichnete Kenntnisse der Finanzanalyse</li><li>Fortgeschrittene Kenntnisse in Excel und Analysetools</li><li>Fließend Deutsch und Englisch</li></ul>',
                    'en' => '<ul><li>Master\'s degree in finance, economics or equivalent</li><li>5-7 years experience in credit analysis</li><li>Excellent command of financial analysis</li><li>Advanced skills in Excel and analysis tools</li><li>Fluent German and English</li></ul>',
                    'es' => '<ul><li>Máster en finanzas, economía o equivalente</li><li>5-7 años de experiencia en análisis de crédito</li><li>Excelente dominio del análisis financiero</li><li>Habilidades avanzadas en Excel y herramientas de análisis</li><li>Alemán e inglés fluidos</li></ul>',
                ],
                'benefits' => [
                    'fr' => '<ul><li>Package salarial compétitif</li><li>Télétravail partiel possible</li><li>Programme de formation continue</li><li>Assurance santé premium</li><li>Plan de participation aux bénéfices</li></ul>',
                    'de' => '<ul><li>Wettbewerbsfähiges Gehaltspaket</li><li>Teilweise Telearbeit möglich</li><li>Weiterbildungsprogramm</li><li>Premium-Krankenversicherung</li><li>Gewinnbeteiligungsplan</li></ul>',
                    'en' => '<ul><li>Competitive salary package</li><li>Partial remote work possible</li><li>Continuing education program</li><li>Premium health insurance</li><li>Profit-sharing plan</li></ul>',
                    'es' => '<ul><li>Paquete salarial competitivo</li><li>Teletrabajo parcial posible</li><li>Programa de formación continua</li><li>Seguro de salud premium</li><li>Plan de participación en beneficios</li></ul>',
                ],
                'published_at' => Carbon::now()->subDays(10),
                'expires_at' => Carbon::now()->addDays(45),
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => [
                    'fr' => 'Développeur(euse) Full Stack - Digital Banking',
                    'de' => 'Full Stack Entwickler(in) - Digital Banking',
                    'en' => 'Full Stack Developer - Digital Banking',
                    'es' => 'Desarrollador(a) Full Stack - Banca Digital',
                ],
                'slug' => 'developpeur-full-stack-digital',
                'location' => 'St.Gallen / Remote',
                'department' => 'IT & Innovation',
                'contract_type' => 'CDI',
                'workload' => '100%',
                'description' => [
                    'fr' => '<p>Participez à la révolution digitale bancaire en tant que développeur full stack.</p><h3>Le poste</h3><ul><li>Développement de notre plateforme e-banking nouvelle génération</li><li>Architecture et implémentation de solutions modernes</li><li>Collaboration avec les équipes produit et UX</li><li>Maintenance et optimisation des applications existantes</li><li>Veille technologique et innovation</li></ul>',
                    'de' => '<p>Nehmen Sie an der digitalen Bankrevolution als Full Stack Entwickler(in) teil.</p><h3>Die Stelle</h3><ul><li>Entwicklung unserer E-Banking-Plattform der nächsten Generation</li><li>Architektur und Implementierung moderner Lösungen</li><li>Zusammenarbeit mit Produkt- und UX-Teams</li><li>Wartung und Optimierung bestehender Anwendungen</li><li>Technologieüberwachung und Innovation</li></ul>',
                    'en' => '<p>Participate in the digital banking revolution as a full stack developer.</p><h3>The position</h3><ul><li>Development of our next-generation e-banking platform</li><li>Architecture and implementation of modern solutions</li><li>Collaboration with product and UX teams</li><li>Maintenance and optimization of existing applications</li><li>Technology watch and innovation</li></ul>',
                    'es' => '<p>Participe en la revolución bancaria digital como desarrollador(a) full stack.</p><h3>El puesto</h3><ul><li>Desarrollo de nuestra plataforma de e-banking de próxima generación</li><li>Arquitectura e implementación de soluciones modernas</li><li>Colaboración con equipos de producto y UX</li><li>Mantenimiento y optimización de aplicaciones existentes</li><li>Vigilancia tecnológica e innovación</li></ul>',
                ],
                'requirements' => [
                    'fr' => '<ul><li>Formation informatique (Bachelor/Master) ou autodidacte passionné</li><li>3+ ans d\'expérience en développement web</li><li>Maîtrise de Laravel, Vue.js/React, Tailwind CSS</li><li>Connaissance des standards de sécurité bancaire</li><li>Expérience avec Docker, Git, CI/CD</li><li>Anglais obligatoire, allemand un plus</li></ul>',
                    'de' => '<ul><li>Informatikausbildung (Bachelor/Master) oder leidenschaftlicher Autodidakt</li><li>3+ Jahre Erfahrung in Webentwicklung</li><li>Beherrschung von Laravel, Vue.js/React, Tailwind CSS</li><li>Kenntnisse von Banksicherheitsstandards</li><li>Erfahrung mit Docker, Git, CI/CD</li><li>Englisch erforderlich, Deutsch ein Plus</li></ul>',
                    'en' => '<ul><li>Computer science degree (Bachelor/Master) or passionate self-taught</li><li>3+ years experience in web development</li><li>Proficiency in Laravel, Vue.js/React, Tailwind CSS</li><li>Knowledge of banking security standards</li><li>Experience with Docker, Git, CI/CD</li><li>English required, German a plus</li></ul>',
                    'es' => '<ul><li>Formación informática (Bachelor/Master) o autodidacta apasionado</li><li>3+ años de experiencia en desarrollo web</li><li>Dominio de Laravel, Vue.js/React, Tailwind CSS</li><li>Conocimiento de estándares de seguridad bancaria</li><li>Experiencia con Docker, Git, CI/CD</li><li>Inglés obligatorio, alemán un plus</li></ul>',
                ],
                'benefits' => [
                    'fr' => '<ul><li>Salaire CHF 95\'000 - 130\'000 selon expérience</li><li>Télétravail jusqu\'à 80%</li><li>MacBook Pro + setup home office</li><li>Budget formation CHF 5\'000/an</li><li>Horaires flexibles</li><li>Équipe jeune et dynamique</li></ul>',
                    'de' => '<ul><li>Gehalt CHF 95\'000 - 130\'000 je nach Erfahrung</li><li>Telearbeit bis zu 80%</li><li>MacBook Pro + Home-Office-Setup</li><li>Weiterbildungsbudget CHF 5\'000/Jahr</li><li>Flexible Arbeitszeiten</li><li>Junges und dynamisches Team</li></ul>',
                    'en' => '<ul><li>Salary CHF 95,000 - 130,000 depending on experience</li><li>Remote work up to 80%</li><li>MacBook Pro + home office setup</li><li>Training budget CHF 5,000/year</li><li>Flexible hours</li><li>Young and dynamic team</li></ul>',
                    'es' => '<ul><li>Salario CHF 95,000 - 130,000 según experiencia</li><li>Teletrabajo hasta 80%</li><li>MacBook Pro + configuración home office</li><li>Presupuesto formación CHF 5,000/año</li><li>Horarios flexibles</li><li>Equipo joven y dinámico</li></ul>',
                ],
                'published_at' => Carbon::now()->subDays(3),
                'expires_at' => Carbon::now()->addDays(90),
                'is_active' => true,
                'order' => 3,
            ],
            [
                'title' => [
                    'fr' => 'Apprenti(e) Employé(e) de Commerce CFC',
                    'de' => 'Lernende(r) Kaufmann/Kauffrau EFZ',
                    'en' => 'Banking Apprentice',
                    'es' => 'Aprendiz de Empleado(a) de Comercio',
                ],
                'slug' => 'apprenti-employe-commerce',
                'location' => 'Bern',
                'department' => 'Formation',
                'contract_type' => 'Apprentissage',
                'workload' => '100%',
                'description' => [
                    'fr' => '<p>Démarrez votre carrière bancaire avec un apprentissage d\'employé de commerce CFC profil banque.</p><h3>Ton apprentissage</h3><ul><li>Formation complète en 3 ans</li><li>Rotation dans différents départements</li><li>Accompagnement par des formateurs expérimentés</li><li>Cours professionnels à l\'école de commerce</li><li>Possibilité de CFC avec maturité professionnelle</li></ul>',
                    'de' => '<p>Starte deine Bankenkarriere mit einer Lehre als Kaufmann/Kauffrau EFZ Profil Bank.</p><h3>Deine Lehre</h3><ul><li>Vollständige Ausbildung in 3 Jahren</li><li>Rotation in verschiedenen Abteilungen</li><li>Begleitung durch erfahrene Ausbilder</li><li>Berufsfachschule an der Handelsschule</li><li>Möglichkeit EFZ mit Berufsmaturität</li></ul>',
                    'en' => '<p>Start your banking career with a commercial apprenticeship in banking.</p><h3>Your apprenticeship</h3><ul><li>Complete 3-year training</li><li>Rotation through different departments</li><li>Supervision by experienced trainers</li><li>Professional courses at business school</li><li>Possibility of vocational baccalaureate</li></ul>',
                    'es' => '<p>Comience su carrera bancaria con un aprendizaje de empleado de comercio perfil banca.</p><h3>Tu aprendizaje</h3><ul><li>Formación completa en 3 años</li><li>Rotación en diferentes departamentos</li><li>Acompañamiento por formadores experimentados</li><li>Cursos profesionales en escuela de comercio</li><li>Posibilidad de título con madurez profesional</li></ul>',
                ],
                'requirements' => [
                    'fr' => '<ul><li>Fin de scolarité obligatoire réussie</li><li>Bonnes notes en mathématiques, allemand et français</li><li>Intérêt pour les chiffres et le contact client</li><li>Aisance avec l\'informatique</li><li>Personnalité ouverte et communicative</li></ul>',
                    'de' => '<ul><li>Erfolgreich abgeschlossene Schulbildung</li><li>Gute Noten in Mathematik, Deutsch und Französisch</li><li>Interesse an Zahlen und Kundenkontakt</li><li>Sicherheit im Umgang mit Informatik</li><li>Offene und kommunikative Persönlichkeit</li></ul>',
                    'en' => '<ul><li>Successfully completed compulsory education</li><li>Good grades in mathematics, German and French</li><li>Interest in numbers and customer contact</li><li>Comfortable with computers</li><li>Open and communicative personality</li></ul>',
                    'es' => '<ul><li>Escolaridad obligatoria completada con éxito</li><li>Buenas notas en matemáticas, alemán y francés</li><li>Interés por los números y el contacto con clientes</li><li>Comodidad con la informática</li><li>Personalidad abierta y comunicativa</li></ul>',
                ],
                'benefits' => [
                    'fr' => '<ul><li>Salaire selon recommandations de la branche</li><li>13ème salaire</li><li>5 semaines de vacances</li><li>Frais de transport pris en charge</li><li>Possibilité de poursuite après le CFC</li></ul>',
                    'de' => '<ul><li>Lohn gemäß Branchenempfehlungen</li><li>13. Monatslohn</li><li>5 Wochen Ferien</li><li>Übernahme der Transportkosten</li><li>Möglichkeit der Weiterbildung nach EFZ</li></ul>',
                    'en' => '<ul><li>Salary according to industry recommendations</li><li>13th month salary</li><li>5 weeks vacation</li><li>Transport costs covered</li><li>Possibility to continue after qualification</li></ul>',
                    'es' => '<ul><li>Salario según recomendaciones del sector</li><li>13º salario</li><li>5 semanas de vacaciones</li><li>Gastos de transporte cubiertos</li><li>Posibilidad de continuar después del título</li></ul>',
                ],
                'published_at' => Carbon::now()->subDays(15),
                'expires_at' => Carbon::now()->addMonths(4),
                'is_active' => true,
                'order' => 4,
            ],
        ];

        foreach ($careers as $careerData) {
            Career::create($careerData);
        }

        $this->command->info('✅ ' . count($careers) . ' offres d\'emploi créées avec succès!');
    }
}
